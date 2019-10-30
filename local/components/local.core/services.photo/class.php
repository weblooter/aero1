<?

use Local\Core\Exception\Component\Services;
use Local\Core\Text\Format;

class ServicesPhotoComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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
            $arResult = $obServiceComponent::extractTextBlocks($arData, 'PHOTO');

            if (!empty($arData['PROPERTIES']['PHOTO_PHOTOS']['VALUE'])) {

                $rsElems = \CIBlockElement::GetList(['ACTIVE_FROM' => 'DESC', 'SORT' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'workphoto'), 'ACTIVE' => 'Y', 'ID' => $arData['PROPERTIES']['PHOTO_PHOTOS']['VALUE']]);
                while ($obElem = $rsElems->GetNextElement()) {
                    $arElem = $obElem->GetFields();
                    $arElem['PROPERTIES'] = $obElem->GetProperties();

                    $arElem['PREVIEW_TEXT'] = (new Format\FormatCommon())->format($arElem['PREVIEW_TEXT']);
                    if (mb_strtoupper($arElem['PREVIEW_TEXT_TYPE']) == 'TEXT') {
                        $arElem['PREVIEW_TEXT'] = '<p>'.$arElem['PREVIEW_TEXT'].'</p>';
                    }

                    $arElem['PROPERTIES']['PHOTOS']['VALUE'] = array_map(function ($v)
                        {
                            $arTmp = [
                                'BIG' => \CFile::ResizeImageGet($v, ['width' => 600, 'height' => 400], BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 75),
                                'THUMB' => \CFile::ResizeImageGet($v, ['width' => 75, 'height' => 50], BX_RESIZE_IMAGE_EXACTfalse, false, false, 75)
                            ];
                            $arTmp['BIG'] = $arTmp['BIG']['src'];
                            $arTmp['THUMB'] = $arTmp['THUMB']['src'];
                            return $arTmp;
                        }, $arElem['PROPERTIES']['PHOTOS']['VALUE']);

                    $arResult['ITEMS'][] = $arElem;
                }

                $obOperationPropsClass = \Local\Core\HighloadBlock\Entity::getInstance(\Local\Core\HighloadBlock\Entity::Opetationprops);
                $rsOperationsProps = $obOperationPropsClass::getList([
                    'select' => [
                        '*'
                    ]
                ]);
                while ($ar = $rsOperationsProps->fetch()) {
                    $arResult['OPERATION_PROPS'][$ar['UF_XML_ID']] = [
                        'NAME' => $ar['UF_NAME'],
                        'IMG' => \CFile::GetPath($ar['UF_FILE']),
                    ];
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