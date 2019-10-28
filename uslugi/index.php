<?
define('MAIN_PAGE', true);
define('DISABLE_BREADCRUMBS', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Услуги");
?>
<? $APPLICATION->IncludeComponent('local.core:services', '.default', []);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>