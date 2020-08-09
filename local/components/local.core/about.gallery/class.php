<?

use Bitrix\Main\Application;

class AboutGalleryComponent extends CBitrixComponent
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
        if ($obCache->startDataCache(60 * 60 * 24, __FILE__.__LINE__)) {
            $rsElems = CIBlockElement::GetList(['SORT' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'about-gallery'), 'ACTIVE' => 'Y', '!PREVIEW_PICTURE' => false], false, false, ['PREVIEW_PICTURE']);
            while ($ar = $rsElems->Fetch()) {
                $arSrc = CFile::ResizeImageGet($ar['PREVIEW_PICTURE'], ['width' => 900, 'height' => 600], BX_RESIZE_IMAGE_EXACT, false, false, false, 100);
                if (!empty($arSrc['src'])) {
                    $arResult[] = $arSrc['src'];
                }
            }
            $obCache->endDataCache($arResult);
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
    }
}