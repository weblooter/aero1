<?
$APPLICATION->SetTitle($arResult["META_TAGS"]["TITLE"]);
$APPLICATION->SetPageProperty("title", $arResult["META_TAGS"]["BROWSER_TITLE"]);
$APPLICATION->SetPageProperty("keywords", $arResult["META_TAGS"]["KEYWORDS"]);
$APPLICATION->SetPageProperty("description", $arResult["META_TAGS"]["DESCRIPTION"]);