<?php

if (
    (int)$arResult['ITEM']['PROPERTIES']['ROOT_OPERATION']['VALUE'] > 0
    && (int)$arResult['ITEM']['PROPERTIES']['ROOT_OPERATION']['VALUE'] !== (int)$arResult['OPERATION_ID']
) {
    $rsRootOperation = CIBlockElement::GetList(
        [],
        [
            'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'services'),
            'ID' => $arResult['ITEM']['PROPERTIES']['ROOT_OPERATION']['VALUE']
        ],
        false,
        false,
        [
            'IBLOCK_ID',
            'ID',
            'DETAIL_PAGE_URL',
        ]
    );
    $a = $rsRootOperation->GetNext();
    if (!empty($a['DETAIL_PAGE_URL'])) {
        LocalRedirect($a['DETAIL_PAGE_URL'].'review/'.$arResult['ITEM']['ID'].'/');
    }
}