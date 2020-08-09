<?

use Bitrix\Main\Application;
use Local\Core\Exception\Component\Services;
use Local\Core\Text\Format;

class ServicesReviewComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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
            $arResult = $obServiceComponent::extractTextBlocks($arData, 'REVIEW');

            if (!empty($arData['PROPERTIES']['REVIEW_REVIEWS']['VALUE'])) {
                $rsElems = CIBlockElement::GetList(
                    ['ACTIVE_FROM' => 'DESC', 'SORT' => 'ASC'],
                    [
                        'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'useful_patient'),
                        'ACTIVE' => 'Y',
                        'ID' => $arData['PROPERTIES']['REVIEW_REVIEWS']['VALUE']
                    ]
                );
                while ($obElem = $rsElems->GetNextElement()) {
                    $arElem = $obElem->GetFields();
                    $arElem['PROPERTIES'] = $obElem->GetProperties();

                    $arElem['DETAIL_PAGE_URL'] = $arData['DETAIL_PAGE_URL'].'review/'.$arElem['ID'].'/';

                    if (!empty((new Format\FormatTrim(new Format\FormatStripTags()))->format(htmlspecialchars_decode($arElem['PROPERTIES']['REVIEW_TEXT_SERVICE']['VALUE']['TEXT'])))) {
                        $arElem['REVIEW_TEXT'] = (new Format\FormatCommon())->format(htmlspecialchars_decode($arElem['PROPERTIES']['REVIEW_TEXT_SERVICE']['VALUE']['TEXT']));
                        if (mb_strtoupper($arElem['PROPERTIES']['REVIEW_TEXT_SERVICE']['VALUE']['TYPE']) == 'TEXT') {
                            $arElem['REVIEW_TEXT'] = '<p>'.$arElem['REVIEW_TEXT'].'</p>';
                        }
                    } else {
                        $arElem['REVIEW_TEXT'] = (new Format\FormatCommon())->format(htmlspecialchars_decode($arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT']));
                        if (mb_strtoupper($arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TYPE']) == 'TEXT') {
                            $arElem['REVIEW_TEXT'] = '<p>'.$arElem['REVIEW_TEXT'].'</p>';
                        }
                    }

                    if (!empty($arElem['PROPERTIES']['PHOTOS']['VALUE'])) {
                        $arElem['PROPERTIES']['PHOTOS']['VALUE'] = array_map(
                            function ($v)
                                {
                                    $arTmp = CFile::ResizeImageGet($v, ['width' => 100, 'height' => 65], BX_RESIZE_IMAGE_EXACT, false, false, false, 75);
                                    return $arTmp['src'];
                                },
                            $arElem['PROPERTIES']['PHOTOS']['VALUE']
                        );
                    }

                    $arResult['ITEMS'][] = $arElem;
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