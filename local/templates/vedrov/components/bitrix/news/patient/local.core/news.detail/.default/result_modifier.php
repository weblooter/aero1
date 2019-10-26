<?

use Local\Core\Text\Format;

$arResult['DETAIL_TEXT'] = (new Format\FormatCommon())->format($arResult['DETAIL_TEXT']);
if( mb_strtoupper($arResult['DETAIL_TEXT_TYPE']) == 'TEXT' )
{
    $arResult['DETAIL_TEXT'] = '<p>'.$arResult['DETAIL_TEXT'].'</p>';
}

$arResult = array_merge($arResult, \Local\Core\Assistant\Useful::getPrevNexPages($arParams['IBLOCK_ID'], $arResult['ID']));

if( !empty( $arResult['PROPERTIES']['PHOTOS']['VALUE'] ) )
{
    $arResult['PROPERTIES']['PHOTOS']['VALUE'] = array_map(function ($v){
        $arTmp = \CFile::ResizeImageGet($v, ['width' => 900, 'height' => 600], BX_RESIZE_IMAGE_PROPORTIONAL, false,false,false,75);
        return $arTmp['src'];
    }, $arResult['PROPERTIES']['PHOTOS']['VALUE']);
}


$arResult['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'] = (new Format\FormatCommon())->format($arResult['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT']);
if( mb_strtoupper($arResult['PROPERTIES']['REVIEW_TEXT']['VALUE']['TYPE']) == 'TEXT' )
{
    $arResult['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'] = '<p>'.$arResult['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'].'</p>';
}

$obOperationPropsClass = \Local\Core\HighloadBlock\Entity::getInstance(\Local\Core\HighloadBlock\Entity::Opetationprops);
$rsOpeationsProps = $obOperationPropsClass::getList([
    'filter' => [
        'UF_XML_ID' => $arResult['PROPERTIES']['OPERATION_PROPS']['VALUE']
    ],
    'select' => [
        '*'
    ]
]);
$arResult['PROPERTIES']['OPERATION_PROPS']['VALUE'] = array_combine($arResult['PROPERTIES']['OPERATION_PROPS']['VALUE'], $arResult['PROPERTIES']['OPERATION_PROPS']['VALUE']);
while ($ar = $rsOpeationsProps->fetch())
{
    $arResult['PROPERTIES']['OPERATION_PROPS']['VALUE'][ $ar['UF_XML_ID'] ] = [
        'NAME' => $ar['UF_NAME'],
        'IMG' => \CFile::GetPath($ar['UF_FILE']),
    ];
}
$arResult['PROPERTIES']['OPERATION_PROPS']['VALUE'] = array_values($arResult['PROPERTIES']['OPERATION_PROPS']['VALUE']);

$arResult["META_TAGS"]["BROWSER_TITLE"] = (new Format\FormatTrim((new Format\FormatStripTags())))->format($arResult["META_TAGS"]["BROWSER_TITLE"]);
$arResult["META_TAGS"]["DESCRIPTION"] = (new Format\FormatTrim((new Format\FormatStripTags(new Format\FormatCommon()))))->format(htmlspecialchars_decode($arResult["META_TAGS"]["DESCRIPTION"]));