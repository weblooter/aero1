<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("h1", "Стоимость проведения операций");
$APPLICATION->SetPageProperty("pre-h1", "ЦЕНЫ");
$APPLICATION->SetTitle("Цены");
?>
<? $APPLICATION->IncludeComponent('local.core:prices.index', '.default', []); ?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>