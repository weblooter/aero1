<?
if( preg_match('/^\/uslugi\/([a-zA-Z0-9\-\_]+)\/([a-zA-Z0-9\-\_]+)\//', $_SERVER['REQUEST_URI']) === 1 )
{
    define('MAIN_PAGE', true);
}
define('DISABLE_BREADCRUMBS', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Услуги");

$obRequest = \Bitrix\Main\Application::getInstance()
    ->getContext()
    ->getRequest();
?>
<?if( empty( trim($obRequest->get('SECTION_CODE')) ) ):?>
    <? $APPLICATION->IncludeComponent('local.core:main.services', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
<?else:?>
    <? $APPLICATION->IncludeComponent('local.core:services', '.default', []);?>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>