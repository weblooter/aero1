<?

class AboutHistoryComponent extends \CBitrixComponent
{
    public function executeComponent()
    {
        $this->fillResult();
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];

        $obCache = \Bitrix\Main\Application::getInstance()
            ->getCache();
        if ($obCache->startDataCache(60 * 60 * 24, __FILE__.__LINE__)) {
            $rsSections = \CIBlockSection::GetList(['SORT' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'about-history'), 'ACTIVE' => 'Y'], false, ['ID', 'CODE', 'NAME']);
            while ($ar = $rsSections->Fetch()) {
                $arResult[$ar['ID']] = [
                    'NAME' => $ar['NAME'],
                    'CODE' => $ar['CODE'],
                    'ITEMS' => []
                ];
            }

            $rsElems = \CIBlockElement::GetList(['SORT' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'about-history'), 'ACTIVE' => 'Y'], false, false, ['NAME', 'IBLOCK_SECTION_ID', 'PREVIEW_TEXT']);
            while ($ar = $rsElems->Fetch()) {
                $arResult[$ar['IBLOCK_SECTION_ID']]['ITEMS'][] = [
                    'NAME' => $ar['NAME'],
                    'PREVIEW_TEXT' => $ar['PREVIEW_TEXT']
                ];
            }
            $obCache->endDataCache($arResult);
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
    }
}