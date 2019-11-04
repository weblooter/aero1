<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("pre-h1", "КОНСУЛЬТАЦИИ ОНЛАЙН");
$APPLICATION->SetPageProperty("h1", "Задайте свой вопрос<br/>Ведрову Олегу Вячеславовичу");
$APPLICATION->SetTitle("Консультации");
?>
<? $APPLICATION->IncludeComponent('local.core:consult.section', '.default', [], false, ['HIDE_ICONS' => 'Y'])?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>