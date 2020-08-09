<?

class MainPatientsComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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
            $rsElems = CIBlockElement::GetList(
                ['ACTIVE_FROM' => 'DESC'],
                [
                    'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'useful_patient'),
                    '!PREVIEW_PICTURE' => false,
                    'ACTIVE' => 'Y'
                ],
                false,
                ['nPageSize' => 10],
                [
                    'ID',
                    'IBLOCK_ID',
                    'PREVIEW_PICTURE',
                    'DETAIL_PAGE_URL'
                ]
            );

            if ($rsElems->SelectedRowsCount() < 1) {
                throw new Exception();
            }

            while ($ar = $rsElems->GetNext()) {
                if ($ar['PREVIEW_PICTURE'] > 0) {
                    $ar['PREVIEW_PICTURE'] = CFile::ResizeImageGet($ar['PREVIEW_PICTURE'], ['width' => 510, 'height' => 340], false, false, false, 75);
                    $ar['PREVIEW_PICTURE'] = $ar['PREVIEW_PICTURE']['src'];
                }

                $arResult['ITEMS'][] = $ar;
            }
        } catch (Exception $e) {
            $this->abortResultCache();
        }
        $this->arResult = $arResult;
    }
}