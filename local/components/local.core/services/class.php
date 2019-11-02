<?

use Local\Core\Exception\Component\Services;
use Local\Core\Text\Format;

class ServicesComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{

    public function executeComponent()
    {
        if ($this->is404()) {
            $this->_show404Page();
        }

        try {
            $this->includeComponentTemplate($this->componentTemplate);
        } catch (Services\ExceptionEmptyData $e) {
            $this->_show404Page();
        }

        $GLOBALS['APPLICATION']->IncludeComponent('local.core:services.header', '.default', ['DATA' => $this->arResult, 'ACTIVE' => $this->componentTemplate]);
        $this->fillMetaSeo();
    }

    protected $componentTemplate = 'index';

    /**
     * @throws Services\Exception404
     * @throws \Bitrix\Main\SystemException
     */
    protected function fillResult()
    {
        $arResult = [];

        $obRequest = \Bitrix\Main\Application::getInstance()
            ->getContext()
            ->getRequest();

        $obCache = \Bitrix\Main\Application::getInstance()
            ->getCache();

        if ($obCache->startDataCache(60 * 60 * 24, __FILE__.'#'.$obRequest->get('SECTION_CODE').'#'.$obRequest->get('ELEMENT_CODE'))) {
            # section
            $rsSection = \CIBlockSection::GetList([], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'services'), 'CODE' => $obRequest->get('SECTION_CODE'), 'ACTIVE' => 'Y'], false, ['ID', 'NAME']);
            if ($rsSection->SelectedRowsCount() < 1) {
                throw new Services\Exception404();
            }
            $arResult['MAIN']['SECTION'] = $rsSection->Fetch();

            # element
            $rsElement = \CIBlockElement::GetList([], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'services'), 'IBLOCK_SECTION_ID' => $arResult['MAIN']['SECTION']['ID'], 'ACTIVE' => 'Y', 'CODE' => $obRequest->get('ELEMENT_CODE')]);
            if ($rsElement->SelectedRowsCount() < 1) {
                throw new Services\Exception404();
            }
            $obElem = $rsElement->GetNextElement();
            $arResult['MAIN']['ELEMENT'] = $obElem->GetFields();
            $arResult['MAIN']['ELEMENT']['PROPERTIES'] = $obElem->GetProperties();

            # seo
            $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
                $arResult['MAIN']['ELEMENT']["IBLOCK_ID"],
                $arResult['MAIN']['ELEMENT']["ID"]
            );
            $arResult['MAIN']['SEO'] = $ipropValues->getValues();

            $obCache->endDataCache($arResult);
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
        unset($arResult);
    }

    /**
     * @return bool
     * @throws \Bitrix\Main\SystemException
     */
    protected function is404()
    {
        $boolIs404 = false;

        $obRequest = \Bitrix\Main\Application::getInstance()
            ->getContext()
            ->getRequest();

        try {
            $this->fillResult();

            if (empty($this->arResult)) {
                throw new Services\Exception404();
            }

            if (!empty(trim($obRequest->get('PAGE_TAB')))) {
                $this->componentTemplate = trim($obRequest->get('PAGE_TAB'));
            }

        } catch (Services\Exception404 $e) {
            $boolIs404 = true;
        }

        return $boolIs404;
    }

    /**
     * @return array
     */
    protected function extractSeo()
    {
        return [
            'TITLE' => \Local\Core\Register\ServicesComponent::getTitle() ?? $this->arResult['MAIN']['ELEMENT']['PROPERTIES'][mb_strtoupper($this->componentTemplate).'_TITLE']['VALUE'],
            'DESCRIPTION' => \Local\Core\Register\ServicesComponent::getDescription() ?? $this->arResult['MAIN']['ELEMENT']['PROPERTIES'][mb_strtoupper($this->componentTemplate).'_DESCRIPTION']['VALUE'],
            'KEYWORDS' => \Local\Core\Register\ServicesComponent::getKeyword() ?? $this->arResult['MAIN']['ELEMENT']['PROPERTIES'][mb_strtoupper($this->componentTemplate).'_KEYWORDS']['VALUE'],
        ];
    }

    protected function fillMetaSeo()
    {
        $arSeo = $this->extractSeo();
        $GLOBALS['APPLICATION']->SetTitle($arSeo['TITLE']);
        $GLOBALS['APPLICATION']->SetPageProperty('title', $arSeo['TITLE']);
        $GLOBALS['APPLICATION']->SetPageProperty('description', $arSeo['DESCRIPTION']);
        $GLOBALS['APPLICATION']->SetPageProperty('keywords', $arSeo['KEYWORDS']);
    }

    /**
     * Извлекает текстовые блоки для дочерних компонентов типа services.price
     *
     * @param $arData
     * @param $action
     *
     * @return array
     */
    public static function extractTextBlocks(&$arData, $action)
    {
        $arResult = [
            'FIRST_BLOCK' => '',
            'SECOND_BLOCK' => '',
        ];

        if (!empty((new Format\FormatTrim(new Format\FormatStripTags(new Format\FormatNewLine())))->format(htmlspecialchars_decode($arData['PROPERTIES'][$action.'_FIRST_BLOCK']['VALUE']['TEXT'])))) {
            $arResult['FIRST_BLOCK'] = (new Format\FormatCommon())->format(htmlspecialchars_decode($arData['PROPERTIES'][$action.'_FIRST_BLOCK']['VALUE']['TEXT']));
            if (mb_strtoupper($arData['PROPERTIES'][$action.'_FIRST_BLOCK']['VALUE']['TYPE']) === 'TEXT') {
                $arResult['FIRST_BLOCK'] = '<p>'.$arResult['FIRST_BLOCK'].'</p>';
            }
        }

        if (!empty((new Format\FormatTrim(new Format\FormatStripTags(new Format\FormatNewLine())))->format(htmlspecialchars_decode($arData['PROPERTIES'][$action.'_SECOND_BLOCK']['VALUE']['TEXT'])))) {
            $arResult['SECOND_BLOCK'] = (new Format\FormatCommon())->format(htmlspecialchars_decode($arData['PROPERTIES'][$action.'_SECOND_BLOCK']['VALUE']['TEXT']));
            if (mb_strtoupper($arData['PROPERTIES'][$action.'_SECOND_BLOCK']['VALUE']['TYPE']) === 'TEXT') {
                $arResult['SECOND_BLOCK'] = '<p>'.$arResult['SECOND_BLOCK'].'</p>';
            }
        }

        return $arResult;
    }
}