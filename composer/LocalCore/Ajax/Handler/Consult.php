<?php

namespace Local\Core\Ajax\Handler;

/**
 * Class Consult
 *
 * @package Local\Core\Ajax\Handler\Consult
 */
class Consult
{
    public static function shortForm(\Bitrix\Main\HttpRequest $obRequest, \Local\Core\Inner\BxModified\HttpResponse $obResponse, $args)
    {
        $arResponse = [];

        try {
            if (empty($obRequest->getPost('NAME')) || empty($obRequest->getPost('PHONE'))) {
                throw new \Exception('Не полный данные!');
            }

            $strMsg = 'Заказан звонок.'.PHP_EOL;
            $strMsg .= 'Имя: '.$obRequest->getPost('NAME').PHP_EOL;
            $strMsg .= 'Телефон: '.$obRequest->getPost('PHONE').PHP_EOL;

            $el = new \CIBlockElement;
            $arLoadProductArray = [
                'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'system-consult-short-form'),
                'NAME' => date('Y-m-d H:i').' | '.$obRequest->getPost('NAME'),
                'PREVIEW_TEXT' => $strMsg,
                'PREVIEW_TEXT_TYPE' => 'text'
            ];

            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $obResponse->setSuccessAjaxResult(['ID' => $PRODUCT_ID]);

                \Local\Core\TriggerMail\Consult::shortForm(['MSG' => str_replace(PHP_EOL, '<br/>', $strMsg)]);
            } else {
                throw new \Exception($el->LAST_ERROR);
            }
        } catch (\Exception $e) {
            $obResponse->setErrorAjaxResult([], [$e->getMessage()]);
        }
    }
}