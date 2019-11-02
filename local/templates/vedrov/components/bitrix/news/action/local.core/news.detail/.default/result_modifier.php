<?

use Local\Core\Text\Format;

$arResult['DETAIL_TEXT'] = (new Format\FormatCommon())->format($arResult['DETAIL_TEXT']);
if (mb_strtoupper($arResult['DETAIL_TEXT_TYPE']) == 'TEXT') {
    $arResult['DETAIL_TEXT'] = '<p>'.$arResult['DETAIL_TEXT'].'</p>';
}

$arResult["META_TAGS"]["BROWSER_TITLE"] = (new Format\FormatTrim((new Format\FormatStripTags())))->format($arResult["META_TAGS"]["BROWSER_TITLE"]);
$arResult["META_TAGS"]["DESCRIPTION"] = (new Format\FormatTrim((new Format\FormatStripTags(new Format\FormatCommon()))))->format(htmlspecialchars_decode($arResult["META_TAGS"]["DESCRIPTION"]));