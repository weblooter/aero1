<?

class FooterServiceMenuComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{
    public function executeComponent()
    {
        $this->fillResult();
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];

        $obCacheServices = \Bitrix\Main\Application::getInstance()
            ->getCache();
        if ($obCacheServices->startDataCache(60 * 60 * 24, __FILE__.'#'.__LINE__)) {
            $rsSections = \CIBlockSection::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'services'), 'ACTIVE' => 'Y'], false, ['ID', 'IBLOCK_ID', 'SECTION_PAGE_URL']);
            while ($ar = $rsSections->GetNext()) {
                $arResult['SERVICES'][$ar['ID']] = [
                    'NAME' => $ar['NAME'],
                    'SECTION_PAGE_URL' => $ar['SECTION_PAGE_URL'],
                    'CHILD' => []
                ];
            }
            $rsElems = \CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'services'), 'ACTIVE' => 'Y'], false, false, ['ID', 'IBLOCK_ID', 'DETAIL_PAGE_URL', 'NAME', 'IBLOCK_SECTION_ID']);
            while ($ar = $rsElems->GetNext()) {
                $arResult['SERVICES'][$ar['IBLOCK_SECTION_ID']]['CHILD'][] = [
                    'NAME' => $ar['NAME'],
                    'DETAIL_PAGE_URL' => $ar['DETAIL_PAGE_URL'],
                ];
            }

            $obCacheServices->endDataCache($arResult['SERVICES']);
        } else {
            $arResult['SERVICES'] = $obCacheServices->getVars();
        }

        $this->arResult = $arResult;
    }
}