<?

use Local\Core\Text\Format;

foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['PREVIEW_TEXT'] = (new Format\FormatCommon())->format($arItem['PREVIEW_TEXT']);
    if (mb_strtoupper($arItem['PREVIEW_TEXT_TYPE']) == 'TEXT') {
        $arItem['PREVIEW_TEXT'] = '<p>'.$arItem['PREVIEW_TEXT'].'</p>';
    }

    $arItem['PROPERTIES']['PHOTOS']['VALUE'] = array_map(function ($v)
        {
            $arTmp = [
                'BIG' => \CFile::ResizeImageGet($v, ['width' => 600, 'height' => 400], BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 75),
                'THUMB' => \CFile::ResizeImageGet($v, ['width' => 75, 'height' => 50], BX_RESIZE_IMAGE_EXACT, false, false, false, 75)
            ];
            $arTmp['BIG'] = $arTmp['BIG']['src'];
            $arTmp['THUMB'] = $arTmp['THUMB']['src'];
            return $arTmp;
        }, $arItem['PROPERTIES']['PHOTOS']['VALUE']);

    if(
        !empty($arItem['PROPERTIES']['VIDEO_PREVIEW']['VALUE'])
        && !empty($arItem['PROPERTIES']['VIDEO']['VALUE'])
    ) {

        $arItem['PROPERTIES']['VIDEO_PREVIEW']['VALUE'] = array_map(function ($v)
            {
                $arTmp = [
                    'BIG' => \CFile::ResizeImageGet($v, ['width' => 600, 'height' => 400], BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 75),
                    'THUMB' => \CFile::ResizeImageGet($v, ['width' => 75, 'height' => 50], BX_RESIZE_IMAGE_EXACT, false, false, false, 75)
                ];
                $arTmp['BIG'] = $arTmp['BIG']['src'];
                $arTmp['THUMB'] = $arTmp['THUMB']['src'];
                return $arTmp;
            }, $arItem['PROPERTIES']['VIDEO_PREVIEW']['VALUE']);
    }
    else {
        $arItem['PROPERTIES']['VIDEO_PREVIEW']['VALUE'] = [];
    }
}
unset($arItem);

$obOperationPropsClass = \Local\Core\HighloadBlock\Entity::getInstance(\Local\Core\HighloadBlock\Entity::Opetationprops);
$rsOperationsProps = $obOperationPropsClass::getList([
    'select' => [
        '*'
    ]
]);
while ($ar = $rsOperationsProps->fetch()) {
    $arResult['OPERATION_PROPS'][$ar['UF_XML_ID']] = [
        'NAME' => $ar['UF_NAME'],
        'IMG' => \CFile::GetPath($ar['UF_FILE']),
    ];
}