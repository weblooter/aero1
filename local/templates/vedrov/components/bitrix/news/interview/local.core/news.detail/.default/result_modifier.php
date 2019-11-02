<?

use Local\Core\Text\Format;

$arResult['DETAIL_TEXT'] = (new Format\FormatCommon())->format($arResult['DETAIL_TEXT']);
if (mb_strtoupper($arResult['DETAIL_TEXT_TYPE']) == 'TEXT') {
    $arResult['DETAIL_TEXT'] = '<p>'.$arResult['DETAIL_TEXT'].'</p>';
}

$arResult = array_merge($arResult, \Local\Core\Assistant\Useful::getPrevNexPages($arParams['IBLOCK_ID'], $arResult['ID']));

if ($arResult['PROPERTIES']['START_LOGO_FILE']['VALUE'] > 0) {
    $arTmp = \CFile::ResizeImageGet($arResult['PROPERTIES']['START_LOGO_FILE']['VALUE'], ['width' => 250, 'height' => 100], BX_RESIZE_IMAGE_PROPORTIONAL, false, false, 75);
    $arResult['PROPERTIES']['START_LOGO_FILE']['VALUE'] = $arTmp['src'];
}
if ($arResult['PROPERTIES']['FAQ_USER_PHOTO']['VALUE'] > 0) {
    $arTmp = \CFile::ResizeImageGet($arResult['PROPERTIES']['FAQ_USER_PHOTO']['VALUE'], ['width' => 128, 'height' => 128], BX_RESIZE_IMAGE_EXACT, false, false, 75);
    $arResult['PROPERTIES']['FAQ_USER_PHOTO']['VALUE'] = $arTmp['src'];
}


$arResult['PROPERTIES']['START_TEXT']['VALUE']['TEXT'] = (new Format\FormatCommon())->format($arResult['PROPERTIES']['START_TEXT']['VALUE']['TEXT']);
if (mb_strtoupper($arResult['PROPERTIES']['START_TEXT']['VALUE']['TYPE']) == 'TEXT') {
    $arResult['PROPERTIES']['START_TEXT']['VALUE']['TEXT'] = '<p>'.$arResult['PROPERTIES']['START_TEXT']['VALUE']['TEXT'].'</p>';
}

$arResult['PROPERTIES']['FAQ_TEXT']['VALUE'] = array_map(function ($v)
    {
        $v['TEXT'] = htmlspecialchars_decode($v['TEXT']);
        $v['TEXT'] = (new Format\FormatCommon())->format($v['TEXT']);
        if (mb_strtoupper($v['TYPE']) == 'TEXT') {
            $v['TEXT'] = '<p>'.$v['TEXT'].'</p>';
        }
        return $v;
    }, $arResult['PROPERTIES']['FAQ_TEXT']['VALUE']);

$arResult["META_TAGS"]["BROWSER_TITLE"] = (new Format\FormatTrim((new Format\FormatStripTags())))->format($arResult["META_TAGS"]["BROWSER_TITLE"]);
$arResult["META_TAGS"]["DESCRIPTION"] = (new Format\FormatTrim((new Format\FormatStripTags(new Format\FormatCommon()))))->format(htmlspecialchars_decode($arResult["META_TAGS"]["DESCRIPTION"]));