<?

use Bitrix\Main\Application;

class AboutSerfComponent extends CBitrixComponent
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
            $rsElems = CIBlockElement::GetList(['SORT' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'about-serf'), 'ACTIVE' => 'Y', '!PREVIEW_PICTURE' => false], false, false, ['PREVIEW_PICTURE']);
            while ($ar = $rsElems->Fetch()) {
                $arItem = [];
                $arSrc = CFile::ResizeImageGet($ar['PREVIEW_PICTURE'], ['width' => 800, 'height' => 800], BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 100);
                if (!empty($arSrc['src'])) {
                    $arItem['BIG'] = $arSrc['src'];
                }
                $arSrc = CFile::ResizeImageGet($ar['PREVIEW_PICTURE'], ['width' => 400, 'height' => 800], BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 100);
                if (!empty($arSrc['src'])) {
                    $arItem['SMALL'] = $arSrc['src'];
                }
                if (!empty($arItem)) {
                    $arResult[] = $arItem;
                }
            }
            $obCache->endDataCache($arResult);
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
    }
}