<?

use Bitrix\Main\Application;
use Local\Core\Exception\Component\Services;

class ServicesContactsComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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
            $arResult = $obServiceComponent::extractTextBlocks($arData, 'CONTACTS');

            $arResult['FB_TITLE'] = $arData['PROPERTIES']['CONTACTS_FB_TITLE']['VALUE'];
            $arResult['FB_HEADER'] = $arData['PROPERTIES']['CONTACTS_FB_HEADER']['VALUE'];

            if (!empty($arData['PROPERTIES']['CONTACTS_PHOTOS']['VALUE'])) {
                foreach ($arData['PROPERTIES']['CONTACTS_PHOTOS']['VALUE'] as $intId) {
                    $arTmp = CFile::ResizeImageGet($intId, ['width' => 900, 'height' => 600], BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 75);
                    $arResult['PHOTO'][] = $arTmp['src'];
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