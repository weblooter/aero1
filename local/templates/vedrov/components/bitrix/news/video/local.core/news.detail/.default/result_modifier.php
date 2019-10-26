<?

use Local\Core\Text\Format;

$arResult['DETAIL_TEXT'] = (new Format\FormatCommon())->format($arResult['DETAIL_TEXT']);

$arResult = array_merge($arResult, \Local\Core\Assistant\Useful::getPrevNexPages($arParams['IBLOCK_ID'], $arResult['ID']));

$arResult["META_TAGS"]["BROWSER_TITLE"] = (new Format\FormatTrim((new Format\FormatStripTags())))->format($arResult["META_TAGS"]["BROWSER_TITLE"]);
$arResult["META_TAGS"]["DESCRIPTION"] = (new Format\FormatTrim((new Format\FormatStripTags(new Format\FormatCommon()))))->format(htmlspecialchars_decode($arResult["META_TAGS"]["DESCRIPTION"]));