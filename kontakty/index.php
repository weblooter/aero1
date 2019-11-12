<?
define('MAIN_PAGE', true);
define('DISABLE_BREADCRUMBS', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("pre-h1", "Контакты");
$APPLICATION->SetPageProperty("h1", "ЦЕНТР ПЛАСТИЧЕСКОЙ ХИРУРГИИ ЭТАЛОН");
$APPLICATION->SetTitle("Контакты");

?>
<? $APPLICATION->IncludeComponent('local.core:contacts.header', '.default', [])?>
<?include './_index.php'?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>