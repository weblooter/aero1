<?
$arResult['DETAIL_TEXT'] = (new \Local\Core\Text\Format\FormatCommon())->format($arResult['DETAIL_TEXT']);

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
while ($ar = $rsElems->GetNext())
{
    if( $ar['ID'] < $arResult['ID'] )
    {
        $arResult['PREV'] = $ar['DETAIL_PAGE_URL'];
        break;
    }
    elseif( $ar['ID'] > $arResult['ID'] )
    {
        $arResult['NEXT'] = $ar['DETAIL_PAGE_URL'];
    }
}