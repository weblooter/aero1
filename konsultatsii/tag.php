<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("pre-h1", "КОНСУЛЬТАЦИИ ОНЛАЙН");
$APPLICATION->SetTitle("Консультации");
?>
<? $APPLICATION->IncludeComponent('local.core:consult.section', '.default', [])?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>