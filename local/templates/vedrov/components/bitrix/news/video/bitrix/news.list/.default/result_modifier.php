<?
foreach ($arResult['ITEMS'] as &$arItem)
{
    if( $arItem['PREVIEW_PICTURE']['ID'] > 0 )
    {
        $ar = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], ['width' => 555, 'height' => 370], BX_RESIZE_IMAGE_EXACT, false, false, false, 75);
        $arItem['PREVIEW_PICTURE']['SRC'] = $ar['src'];
    }
}