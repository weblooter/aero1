<?

use Local\Core\Text\Format;

class MainSlideComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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
            $rsElem = CIBlockElement::GetList(
                ['SORT' => 'ASC'],
                [
                    'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'main_slider'),
                    'ACTIVE' => 'Y'
                ],
                false,
                false,
                [
                    'ID',
                    'NAME',
                    'PREVIEW_TEXT',
                    'PROPERTY_SLIDE_NAME',
                    'PROPERTY_LINK',
                    'PROPERTY_LINK_TEXT'
                ]
            );
            if ($rsElem->SelectedRowsCount() < 1) {
                throw new Exception();
            }

            while ($ar = $rsElem->GetNext()) {
                $arResult['ITEMS'][] = [
                    'NAME' => $ar['NAME'],
                    'PREVIEW_TEXT' => (new Format\FormatTrim(new Format\FormatStripTags()))->format($ar['PREVIEW_TEXT']),
                    'LINK' => $ar['PROPERTY_LINK_VALUE'],
                    'LINK_TEXT' => $ar['PROPERTY_LINK_TEXT_VALUE'],
                    'SLIDE_NAME' => $ar['PROPERTY_SLIDE_NAME_VALUE'],
                ];
            }
        } catch (Exception $e) {
            $this->abortResultCache();
        }

        $this->arResult = $arResult;
    }
}