<?

class ServicesSectionComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{
    public function executeComponent()
    {
        try
        {
            $this->fillResult();
        }
        catch (\Exception $e)
        {
            $this->_show404Page();
        }
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];

        $obCache = \Bitrix\Main\Application::getInstance()
            ->getCache();
        $obRequest = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

        if ($obCache->startDataCache(60 * 60 * 24, __FILE__.__LINE__.'#'.$obRequest->get('SECTION_CODE'))) {

            $rsSections = \CIBlockSection::GetList([],
                [
                    'CODE' => $obRequest->get('SECTION_CODE'),
                    'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'services'),
                    'ACTIVE' => 'Y',
                ],
                false,
                ['ID', 'NAME']);
            if( $rsSections->SelectedRowsCount() < 1 )
            {
                throw new \Exception();
            }
            $arSection = $rsSections->GetNext();
            $arResult['SECTION'] = $arSection;

            $rsElems = \CIBlockElement::GetList(
                [
                    'SORT' => 'ASC'
                ],
                [
                    'ACTIVE' => 'Y',
                    'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'services'),
                    'IBLOCK_SECTION_ID' => $arSection['ID'],
                ],
                false,
                false,
                [
                    'ID',
                    'IBLOCK_ID',
                    'NAME',
                    'DETAIL_PAGE_URL',
                    'PREVIEW_TEXT',
                    'PREVIEW_PICTURE',
                ]
            );
            while ($ar = $rsElems->GetNext()) {
                $arImg = ['src' => ''];
                if ($ar['PREVIEW_PICTURE'] > 0) {
                    $arImg = \CFile::ResizeImageGet($ar['PREVIEW_PICTURE'], ['width' => 350, 'height' => 350], BX_RESIZE_IMAGE_EXACT, false, false, false, 75);
                }
                $arResult['ITEMS'][] = [
                    'NAME' => $ar['NAME'],
                    'IMG' => $arImg['src'],
                    'DETAIL_PAGE_URL' => $ar['DETAIL_PAGE_URL'],
                    'DESC' => ( new Local\Core\Text\Format\FormatCommon() )->format($ar['PREVIEW_TEXT']),
                ];
            }

            $obCache->endDataCache($arResult);
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
    }
}