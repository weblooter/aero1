<?

use Local\Core\Exception\Component\Services;

class ServicesPriceComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{
    public function executeComponent()
    {
        $this->fillResult();
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];

        if (empty($this->arParams['DATA'])) {
            throw new Services\ExceptionEmptyData();
        }


        $arData = &$this->arParams['DATA']['MAIN']['ELEMENT'];

        $obCache = \Bitrix\Main\Application::getInstance()
            ->getCache();
        if ($obCache->startDataCache(60 * 60 * 24, __FILE__.'#'.$arData['ID'])) {
            /** @var $obServiceComponent \ServicesComponent */
            $obServiceComponent = \CBitrixComponent::includeComponentClass('local.core:services');
            $arResult = $obServiceComponent::extractTextBlocks($arData, 'PRICE');

            if (!empty($arData['PROPERTIES']['PRICE_PRICES']['VALUE'])) {
                # elems
                $rsElems = \CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'prices'), 'ACTIVE' => 'Y', 'ID' => $arData['PROPERTIES']['PRICE_PRICES']['VALUE']], false, false, ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_TEXT', 'IBLOCK_SECTION_ID']);
                while ($ob = $rsElems->GetNextElement()) {
                    $arElem = $ob->GetFields();
                    $arElem['PROPERTIES'] = $ob->GetProperties();

                    $arElem['PREVIEW_TEXT'] = (new \Local\Core\Text\Format\FormatCommon())->format($arElem['PREVIEW_TEXT']);
                    if (mb_strtoupper($arElem['PREVIEW_TEXT_TYPE']) == 'TEXT') {
                        $arElem['PREVIEW_TEXT'] = '<p>'.$arElem['PREVIEW_TEXT'].'</p>';
                    }
                    $arResult['ITEMS'][$arElem['IBLOCK_SECTION_ID']][$arElem['ID']] = $arElem;
                }

                # sections
                $rsSections = \CIBlockSection::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'prices'), 'ACTIVE' => 'Y', 'ID' => array_keys($arResult['ITEMS'])], false, ['ID', 'NAME']);
                while ($ar = $rsSections->Fetch()) {
                    $arResult['SECTIONS'][$ar['ID']] = $ar;
                }

            }

            $arResult['ABOUT_OPERATION'] = $arData['DETAIL_PAGE_URL'];
            $obCache->endDataCache($arResult);
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
    }
}