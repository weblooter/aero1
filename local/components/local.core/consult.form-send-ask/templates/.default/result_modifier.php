<?
if ($arParams['SECTION_ID'] < 1) {
    $obCache = \Bitrix\Main\Application::getInstance()
        ->getCache();
    if ($obCache->startDataCache(60 * 60 * 24, __FILE__.__LINE__)) {
        $rsSections = \CIBlockSection::GetList(['SORT' => 'ASC'], ['DEPTH_LEVEL' => 1, 'ACTIVE' => 'Y', 'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult')], false, ['ID', 'NAME']);
        while ($ar = $rsSections->GetNext()) {
            $arResult['SELECT_OPTIONS'][] = [
                'ID' => $ar['ID'],
                'NAME' => $ar['NAME'],
            ];
        }
        $obCache->endDataCache($arResult);
    } else {
        $arResult = $obCache->getVars();
    }
}