<?

class MainNewsComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{
    public function executeComponent()
    {
        if ($this->startResultCache(60 * 60 * 24 * 7)) {
            $this->fillResult();
            $this->endResultCache();
        }
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];
        try {

            $rsElems = \CIBlockElement::GetList(['ACTIVE_FROM' => 'DESC'],
                [
                    'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'useful_news'),
                    '!PREVIEW_PICTURE' => false,
                    'ACTIVE' => 'Y'
                ],
                false,
                ['nPageSize' => 10],
                [
                    'ID',
                    'IBLOCK_ID',
                    'NAME',
                    'PREVIEW_PICTURE',
                    'DETAIL_PAGE_URL'
                ]);

            if( $rsElems->SelectedRowsCount() < 1 )
            {
                throw new \Exception();
            }

            while ($ar = $rsElems->GetNext())
            {
                $arResult['ITEMS'][$ar['ID']] = $ar;
            }


            if( !empty( $arResult['ITEMS'] ) )
            {
                $rsElemMainPhotos = \Local\Core\Model\Bitrix\ElementPropertyTable::getList([
                    'filter' => [
                        'IBLOCK_ELEMENT_ID' => array_keys($arResult['ITEMS']),
                        'IBLOCK_PROPERTY_ID' => \Local\Core\Assistant\Iblock\ElementProperty::getIdByCode(
                            \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'useful_news'),
                            'MAIN_PAGE_PHOTO'
                        ),
                        '!VALUE' => false
                    ],
                    'select' => [
                        'ELEMENT_ID' => 'IBLOCK_ELEMENT_ID',
                        'VALUE'
                    ]
                ]);
                while ($ar = $rsElemMainPhotos->fetch())
                {

                    if( $ar['VALUE'] > 0 )
                    {
                        $ar['IMG'] = \CFile::ResizeImageGet($ar['VALUE'], ['width' => 250, 'height' => 450], false,false,false, 75);
                        $ar['IMG'] = $ar['IMG']['src'];
                        $arResult['ITEMS'][$ar['ELEMENT_ID']]['IMG'] = $ar['IMG'];
                    }
                }

                foreach ($arResult['ITEMS'] as &$arItem)
                {
                    if( empty($arItem['IMG']) )
                    {
                        if( $arItem['PREVIEW_PICTURE'] > 0 )
                        {
                            $arTmp['PREVIEW_PICTURE'] = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], ['width' => 250, 'height' => 450], false,false,false, 75);
                            $arItem['IMG'] = $arTmp['PREVIEW_PICTURE']['src'];
                        }
                    }
                }
                unlink($arItem);
            }

        } catch (\Exception $e) {
            $this->abortResultCache();
        }
        $this->arResult = $arResult;
    }
}