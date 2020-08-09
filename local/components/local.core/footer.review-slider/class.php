<?

class FooterReviewSliderComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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

        $rsElems = CIBlockElement::GetList(
            ['SORT' => 'ASC'],
            [
                'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'review_slider'),
                'ACTIVE' => 'Y',
                '!PREVIEW_PICTURE' => false
            ],
            false,
            false,
            [
                'ID',
                'IBLOCK_ID',
                'PREVIEW_PICTURE',
                'PROPERTY_LINK'
            ]
        );
        if ($rsElems->SelectedRowsCount() < 1) {
            $this->abortResultCache();
        } else {
            while ($ar = $rsElems->Fetch()) {
                $ar['PROPERTY_LINK_VALUE'] = $ar['PROPERTY_LINK_VALUE'] ?? 'javascript:void(0)';
                $ar['PREVIEW_PICTURE'] = CFile::ResizeImageGet($ar['PREVIEW_PICTURE'], ['width' => 300, 'height' => 50], BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 75);
                $ar['PREVIEW_PICTURE'] = $ar['PREVIEW_PICTURE']['src'];
                $arResult['ITEMS'][] = $ar;
            }
        }

        $this->arResult = $arResult;
    }
}