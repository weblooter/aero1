<?

use Bitrix\Main\Application;
use Local\Core\Text\Format\FormatCommon;

class PricesIndexComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{
    public function executeComponent()
    {
        $this->fillResult();
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];

        $obCache = Application::getInstance()
            ->getCache();

        if ($obCache->startDataCache(60 * 60 * 24, __FILE__.'#'.__LINE__)) {
            # sections
            $rsSections = CIBlockSection::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'prices'), 'ACTIVE' => 'Y'], false, ['ID', 'NAME']);
            while ($ar = $rsSections->Fetch()) {
                $arResult['SECTIONS'][$ar['ID']] = $ar;
            }

            # elems
            $rsElems = CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'prices'), 'ACTIVE' => 'Y', 'SECTION_ID' => array_keys($arResult['SECTIONS'])], false, false, ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_TEXT', 'IBLOCK_SECTION_ID']);

            $arOperations = [];

            while ($ob = $rsElems->GetNextElement()) {
                $arElem = $ob->GetFields();
                $arElem['PROPERTIES'] = $ob->GetProperties();

                $arElem['PREVIEW_TEXT'] = (new FormatCommon())->format($arElem['PREVIEW_TEXT']);
                if (mb_strtoupper($arElem['PREVIEW_TEXT_TYPE']) == 'TEXT') {
                    $arElem['PREVIEW_TEXT'] = '<p>'.$arElem['PREVIEW_TEXT'].'</p>';
                }

                if ($arElem['PROPERTIES']['OPERATION']['VALUE'] > 0) {
                    $arOperations[$arElem['PROPERTIES']['OPERATION']['VALUE']] = $arElem['PROPERTIES']['OPERATION']['VALUE'];
                }
                $arResult['ITEMS'][$arElem['IBLOCK_SECTION_ID']][$arElem['ID']] = $arElem;
            }

            # operations
            if (!empty($arOperations)) {
                $rsElems = CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'services'), 'ACTIVE' => 'Y', 'ID' => $arOperations], false, false, ['ID', 'IBLOCK_ID', 'DETAIL_PAGE_URL']);
                while ($ar = $rsElems->GetNext()) {
                    $arResult['OPERATIONS'][$ar['ID']] = $ar['DETAIL_PAGE_URL'];
                }
            }

            $obCache->endDataCache($arResult);
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
    }
}