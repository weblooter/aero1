<?

use Local\Core\Exception\Component\Services;
use Local\Core\Text\Format;

class ServicesVideoComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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
            $arResult = $obServiceComponent::extractTextBlocks($arData, 'VIDEO');

            if (!empty($arData['PROPERTIES']['VIDEO_VIDEOS']['VALUE'])) {
                foreach ($arData['PROPERTIES']['VIDEO_VIDEOS']['VALUE'] as $arVideoSnippet) {
                    if (!empty((new Format\FormatTrim(new Format\FormatStripTags()))->format(htmlspecialchars_decode($arVideoSnippet['TEXT'])))) {
                        $arResult['ITEMS'][] = (new Format\FormatSnippetServiceVideo())->format($arVideoSnippet['TEXT']);
                    }
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