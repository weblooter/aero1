<?
$arSections = []; $LastSection = null; $LastSection = [];
foreach ($arResult as $arSect) {
    global $LastSection;
    if( $arSect['DEPTH_LEVEL'] == 1 ){
        $arSections[ $arSect['LINK'] ] = $arSect;
        $LastSection[ $arSect['DEPTH_LEVEL'] ] =& $arSections[ $arSect['LINK'] ];
    }else{
        $LastSection[ $arSect['DEPTH_LEVEL']-1 ]['CHILDS'][ $arSect['LINK'] ] = $arSect;
        $LastSection[ $arSect['DEPTH_LEVEL'] ] =& $LastSection[ $arSect['DEPTH_LEVEL']-1 ]['CHILDS'][ $arSect['LINK'] ];
    }
}

$arResult = $arSections;

$arResult = array_chunk($arResult, ceil(sizeof($arResult) / 2));