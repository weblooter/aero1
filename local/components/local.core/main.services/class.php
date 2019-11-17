<?

class MainServicesComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{
    public function executeComponent()
    {
        if( $this->startResultCache(60*60*24*7) )
        {
            $this->fillResult();
            $this->endResultCache();
        }
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];

        try
        {
            $rsSections = \CIBlockSection::GetList(['SORT' => 'ASC'],
                [
                    'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'services'),
                    'ACTIVE' => 'Y'
                ],
                false,
                [
                    '*',
                    'UF_*'
                ]);
            if( $rsSections->SelectedRowsCount() < 1 )
            {
                throw new \Exception();
            }

            $arSections = [];

            while ($ar = $rsSections->GetNext())
            {
                $arSections[$ar['ID']] = [
                    'NAME' => ( !empty($ar['UF_MAIN_NAME']) ? $ar['UF_MAIN_NAME'] : $ar['NAME'] ),
                    'PICTURE' => ( $ar['UF_MAIN_IMG'] > 0 ? \CFile::GetPath($ar['UF_MAIN_IMG']) : '' ),
                    'LINK' => $ar['SECTION_PAGE_URL'],
                    'ITEMS' => []
                ];
            }

            $rsElems = \CIBlockElement::GetList(['SORT' => 'ASC'],
                [
                    'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'services'),
                    'ACTIVE' => 'Y',
                    '!PROPERTY_SHOW_ON_INDEX' => false
                ],
                false,
                false,
                [
                    'ID',
                    'IBLOCK_ID',
                    'IBLOCK_SECTION_ID',
                    'NAME',
                    'DETAIL_PAGE_URL'
                ]);
            if( $rsElems->SelectedRowsCount() < 1 )
            {
                throw new \Exception();
            }
            while ($ar = $rsElems->GetNext())
            {
                $arSections[ $ar['IBLOCK_SECTION_ID'] ]['ITEMS'][] = [
                    'NAME' => $ar['NAME'],
                    'DETAIL_PAGE_URL' => $ar['DETAIL_PAGE_URL'],
                ];
            }

            $arResult['ITEMS'] = $arSections;
            unset($arSections);
        }
        catch (\Exception $e)
        {
            $this->abortResultCache();
        }

        $this->arResult = $arResult;
    }
}