<?

use Local\Core\Exception\Component\Services;
use Local\Core\Text\Format;

class ServicesReviewDetailComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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

        if ($this->arParams['REVIEW_ID'] < 1) {
            throw new Services\ExceptionEmptyReviewId();
        }

        $arData = &$this->arParams['DATA']['MAIN']['ELEMENT'];

        $obCache = \Bitrix\Main\Application::getInstance()
            ->getCache();
        if ($obCache->startDataCache(60 * 60 * 24, __FILE__.'#'.$arData['ID'].'#'.$this->arParams['REVIEW_ID'])) {
            /** @var $obServiceComponent \ServicesComponent */
            $obServiceComponent = \CBitrixComponent::includeComponentClass('local.core:services');
            $arResult = $obServiceComponent::extractTextBlocks($arData, 'REVIEW');

            if ($this->arParams['REVIEW_ID'] > 0) {

                $rsElems = \CIBlockElement::GetList(['ACTIVE_FROM' => 'DESC', 'SORT' => 'ASC'],
                    [
                        'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'useful_patient'),
                        'ACTIVE' => 'Y',
                        'ID' => $this->arParams['REVIEW_ID']
                    ]);
                while ($obElem = $rsElems->GetNextElement()) {
                    $arElem = $obElem->GetFields();
                    $arElem['PROPERTIES'] = $obElem->GetProperties();

                    $arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'] = (new Format\FormatCommon())->format(htmlspecialchars_decode($arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT']));
                    if (mb_strtoupper($arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TYPE']) == 'TEXT') {
                        $arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'] = '<p>'.$arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'].'</p>';
                    }

                    if (!empty($arElem['PROPERTIES']['PHOTOS']['VALUE'])) {
                        $arElem['PROPERTIES']['PHOTOS']['VALUE'] = array_map(function ($v)
                            {
                                $arTmp = \CFile::ResizeImageGet($v, ['width' => 900, 'height' => 600], BX_RESIZE_IMAGE_EXACT, false, false, false, 75);
                                return $arTmp['src'];
                            }, $arElem['PROPERTIES']['PHOTOS']['VALUE']);
                    }
                    
                    $arResult['ITEM'] = $arElem;
                }

            }

            $arResult['ABOUT_OPERATION'] = $arData['DETAIL_PAGE_URL'];

            $obCache->endDataCache($arResult);
        } else {
            $arResult = $obCache->getVars();
        }

        \Local\Core\Register\ServicesComponent::setH1($arResult['ITEM']['PROPERTIES']['SERVICE_SEO_H1']['VALUE']);
        \Local\Core\Register\ServicesComponent::setAfterH1($arResult['ITEM']['PROPERTIES']['SERVICE_SEO_AFTER_H1']['VALUE']);
        \Local\Core\Register\ServicesComponent::setTitle($arResult['ITEM']['PROPERTIES']['SERVICE_SEO_TITLE']['VALUE']);
        \Local\Core\Register\ServicesComponent::setDescription($arResult['ITEM']['PROPERTIES']['SERVICE_SEO_DESCRIPTION']['VALUE']);
        \Local\Core\Register\ServicesComponent::setKeyword($arResult['ITEM']['PROPERTIES']['SERVICE_SEO_KEYWORDS']['VALUE']);

        $this->arResult = $arResult;
    }
}