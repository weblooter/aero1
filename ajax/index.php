<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Local\Core\Ajax\Exception;

$app = \Bitrix\Main\Application::getInstance();

$obRequest = $app->getContext()
    ->getRequest();
$obResponse = new \Local\Core\Inner\BxModified\HttpResponse();

try {
    if (!check_bitrix_sessid()) {
        throw new \Exception('Доступ запрещен');
    }

    $arRoutes = include __DIR__.'/routes.php';

    foreach ($arRoutes as $strRouteKey => $arRoute) {

        if (empty($arRoute['path'])) {
            throw new Exception\StructurePathNotExistException($strRouteKey);
        }

        $strRegex = '/^\/ajax'.addcslashes($arRoute['path'], '/').'/';
        if (!empty($arRoute['args'])) {
            $arReplace = [];
            foreach ($arRoute['args'] as $k => $v) {
                $arReplace['{'.$k.'}'] = $v;
            }
            $strRegex = str_replace(array_keys($arReplace), array_values($arReplace), $strRegex);
        }

        if (preg_match($strRegex, $obRequest->getRequestUri(), $arMatches) === 1) {
            $isContinue = false;
            if (!empty($arRoute['methods']) && is_array($arRoute['methods'])) {
                $isContinue = !in_array($obRequest->getRequestMethod(), $arRoute['methods']);
            }

            if ($isContinue) {
                continue;
            }

            unset($arMatches[0]);
            $arParams = [];
            if (!empty($arRoute['args'])) {
                $arParams = array_combine(array_keys($arRoute['args']), $arMatches);
            }

            if (empty($arRoute['handler'])) {
                throw new Exception\StructureHandlerNotExistException($strRouteKey);
            }

            list($strClass, $strMethod) = explode('::', $arRoute['handler']);
            if (empty($strClass) || empty($strMethod) || !class_exists($strClass) || !method_exists($strClass, $strMethod)) {
                throw new Exception\MethodNotExistException($strRouteKey);
            }

            $strClass::$strMethod($obRequest, $obResponse, $arParams);

            $GLOBALS['APPLICATION']->RestartBuffer();
            $obResponse->send();
            die();
        }
    }

    throw new Exception\RouteNotFoundException();

} catch (\Throwable $e) {
    $GLOBALS['APPLICATION']->RestartBuffer();
    ( \Local\Core\Inner\Logger::getInstance('/ajax/index.php') )->addAlert('Возникла ошибка при аякс запросе.', ['get_class($e)' => get_class($e), '$e->getMessage()' => $e->getMessage()]);
    $obResponse->setContentJson(
        ["error" => 'Exception: '.get_class($e).'; Error: '.$e->getMessage()],
        405
    );
    $obResponse->send();
    die();
}
