<?

use Bitrix\Main\Application;

class ConsultIndexComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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
            $rsSections = CIBlockSection::GetList(['SORT' => 'ASC'], ['DEPTH_LEVEL' => 1, 'ACTIVE' => 'Y', 'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult')], false, ['ID', 'IBLOCK_ID', 'CODE', 'NAME', 'PICTURE', 'SECTION_PAGE_URL', 'UF_PREVIEW_TEXT']);
            while ($ar = $rsSections->GetNext()) {
                $arImg = ['src' => ''];
                if ($ar['PICTURE'] > 0) {
                    $arImg = CFile::ResizeImageGet($ar['PICTURE'], ['width' => 350, 'height' => 350], BX_RESIZE_IMAGE_EXACT, false, false, false, 75);
                }

                $arResult['ITEMS'][] = [
                    'NAME' => $ar['NAME'],
                    'IMG' => $arImg['src'],
                    'SECTION_PAGE_URL' => $ar['SECTION_PAGE_URL'],
                    'DESC' => $ar['UF_PREVIEW_TEXT'],
                ];
            }

            $obCache->endDataCache($arResult);
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
    }
}