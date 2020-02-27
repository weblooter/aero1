<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Консультации");
$APPLICATION->SetPageProperty("pre-h1", "КОНСУЛЬТАЦИИ ОНЛАЙН");
$APPLICATION->SetTitle("Все вопросы и ответы по тегу #отеки в операции увеличения груди");
?>
<? $APPLICATION->IncludeComponent('local.core:consult.section', '.default', [], false, ['HIDE_ICONS' => 'Y'])?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>