<?

use Local\Core\Text\Format;

$arResult['DETAIL_TEXT'] = (new Format\FormatCommon())->format($arResult['DETAIL_TEXT']);

$rsElems = \CIBlockElement::GetList(
    ['ACTIVE_FROM' => 'DESC', 'SORT' => 'ASC'],
    [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ACTIVE' => 'Y'
    ],
    false,
    false,
    ['ID', 'IBLOCK_ID', 'DETAIL_PAGE_URL']
);
while ($ar = $rsElems->GetNext()) {
    if ($ar['ID'] < $arResult['ID']) {
        $arResult['PREV'] = $ar['DETAIL_PAGE_URL'];
        break;
    } elseif ($ar['ID'] > $arResult['ID']) {
        $arResult['NEXT'] = $ar['DETAIL_PAGE_URL'];
    }
}

$arResult["META_TAGS"]["BROWSER_TITLE"] = (new Format\FormatTrim((new Format\FormatStripTags())))->format($arResult["META_TAGS"]["BROWSER_TITLE"]);
$arResult["META_TAGS"]["DESCRIPTION"] = (new Format\FormatTrim((new Format\FormatStripTags(new Format\FormatCommon()))))->format(htmlspecialchars_decode($arResult["META_TAGS"]["DESCRIPTION"]));