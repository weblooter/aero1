<?

use Bitrix\Main\Application;
use Local\Core\Exception\Component\Services;
use Local\Core\Text\Format\FormatCommon;

class ServicesActionComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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

        $obCache = Application::getInstance()
            ->getCache();
        if ($obCache->startDataCache(60 * 60 * 24, __FILE__.'#'.$arData['ID'])) {
            /** @var $obServiceComponent ServicesComponent */
            $obServiceComponent = CBitrixComponent::includeComponentClass('local.core:services');
            $arResult = $obServiceComponent::extractTextBlocks($arData, 'ACTION');

            if (!empty($arData['PROPERTIES']['ACTION_ACTIONS']['VALUE'])) {
                $rsElems = CIBlockElement::GetList(['ACTIVE_FROM' => 'DESC', 'SORT' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'akcii'), 'ACTIVE' => 'Y', 'ID' => $arData['PROPERTIES']['ACTION_ACTIONS']['VALUE']], false, false, ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL', 'PREVIEW_TEXT']);
                while ($ar = $rsElems->GetNext()) {
                    if ($ar['PREVIEW_PICTURE'] > 0) {
                        $arImg = CFile::ResizeImageGet($ar['PREVIEW_PICTURE'], ['width' => 300, 'height' => 300], BX_RESIZE_IMAGE_EXACT);
                        $ar['PREVIEW_PICTURE'] = $arImg['src'];
                    }

                    $ar['PREVIEW_TEXT'] = (new FormatCommon())->format($ar['PREVIEW_TEXT']);
                    if (mb_strtoupper($ar['PREVIEW_TEXT_TYPE']) == 'TEXT') {
                        $ar['PREVIEW_TEXT'] = '<p>'.$ar['PREVIEW_TEXT'].'</p>';
                    }
                    $arResult['ITEMS'][] = $ar;
                }

                $arResult['ABOUT_OPERATION'] = $arData['DETAIL_PAGE_URL'];
            }

            $obCache->endDataCache($arResult);
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
    }
}