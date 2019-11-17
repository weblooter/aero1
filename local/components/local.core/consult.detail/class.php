<?

class ConsultDetailComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{
    public function executeComponent()
    {
        if ($this->is404()) {
            $this->_show404Page();
        }

        $this->fillResult();
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];

        $obRequest = \Bitrix\Main\Application::getInstance()
            ->getContext()
            ->getRequest();

        $obCache = \Bitrix\Main\Application::getInstance()
            ->getCache();
        if ($obCache->startDataCache(60 * 60 * 24, __FILE__.__LINE__.'#'.$obRequest->get('ELEMENT_ID'))) {
            # elem
            $rsElem = \CIBlockElement::GetList([], [
                'ID' => $obRequest->get('ELEMENT_ID'),
                'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                'SECTION_CODE' => $obRequest->get('SECTION_CODE'),
                'INCLUDE_SUBSECTIONS' => 'Y'
            ], false, false, [
                'ID',
                'IBLOCK_ID',
                'ACTIVE_FROM',
                'NAME',
                'PREVIEW_TEXT',
                'PREVIEW_TEXT_TYPE',
                'DETAIL_TEXT',
                'DETAIL_TEXT_TYPE',
                'PROPERTY_ASKER_NAME',
                'PROPERTY_CONSULTANT',
            ]);
            $arResult['ITEM'] = $rsElem->GetNext();

            # user
            if ($arResult['ITEM']['PROPERTY_CONSULTANT_VALUE'] > 0) {
                $arResult['USER'] = \Local\Core\Assistant\Consult::getConsultantsData([$arResult['ITEM']['PROPERTY_CONSULTANT_VALUE']]);
            }

            # tags
            $rsElemSections = \CIBlockElement::GetElementGroups($arResult['ITEM']['ID'], false, ['ID']);
            while ($ar = $rsElemSections->Fetch()) {
                $arResult['ITEM']['SECTIONS'][] = $ar['ID'];
            }

            $intMainSection = 0;
            $rsSectionChain = \CIBlockSection::GetNavChain(\Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'), $arResult['ITEM']['SECTIONS'][0], ['ID', 'NAME', 'IBLOCK_ID', 'SECTION_PAGE_URL', 'UF_OPERATION']);
            while ($ar = $rsSectionChain->GetNext()) {
                $intMainSection = $ar['ID'];
                $arResult['ITEM']['MAIN_SECTION'] = $ar;
                break;
            }

            $rsSections = \CIBlockSection::GetList([], [
                'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                'SECTION_ID' => $intMainSection,
            ], false, ['ID', 'NAME', 'IBLOCK_ID', 'SECTION_PAGE_URL', 'UF_OPERATION']);
            while ($ar = $rsSections->GetNext()) {
                $arResult['TAGS'][$ar['ID']] = [
                    'NAME' => $ar['NAME'],
                    'SECTION_PAGE_URL' => $ar['SECTION_PAGE_URL'],
                ];
            }

            # operation
            $intOperationId = 0;
            $rsSections = \CIBlockSection::GetList([], [
                'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                'ID' => $intMainSection,
            ], false, ['ID', 'IBLOCK_ID', 'UF_OPERATION']);
            while ($ar = $rsSections->GetNext()) {
                $intOperationId = $ar['UF_OPERATION'];
            }

            if ($intOperationId > 0) {
                $rsElems = \CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'services'), 'ACTIVE' => 'Y', 'ID' => $intOperationId], false, false, ['ID', 'IBLOCK_ID', 'DETAIL_PAGE_URL']);
                while ($ar = $rsElems->GetNext()) {
                    $arResult['OPERATION'] = $ar['DETAIL_PAGE_URL'];
                }
            }

            # seo
            $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
                $arResult['ITEM']["IBLOCK_ID"],
                $arResult['ITEM']["ID"]
            );
            $arResult['SEO'] = $ipropValues->getValues();

            $obCache->endDataCache($arResult);
            $this->arResult = $arResult;
        } else {
            $this->arResult = $obCache->getVars();
        }
        $this->setSeo();
    }

    protected function is404()
    {
        $return = false;

        $obRequest = \Bitrix\Main\Application::getInstance()
            ->getContext()
            ->getRequest();

        if (!empty($obRequest->get('TAG_CODE'))) {
            \LocalRedirect(str_replace($obRequest->get('TAG_CODE').'/', '', $obRequest->getRequestUri()), true, '301 Moved permanently');
        }

        try {
            if ($obRequest->get('ELEMENT_ID') < 1 || empty(trim($obRequest->get('SECTION_CODE')))) {
                throw new \Exception();
            }

            $rsElem = \CIBlockElement::GetList([], [
                'ID' => $obRequest->get('ELEMENT_ID'),
                'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                'SECTION_CODE' => $obRequest->get('SECTION_CODE'),
                'INCLUDE_SUBSECTIONS' => 'Y'
            ], false, false, ['ID']);
            if ($rsElem->SelectedRowsCount() < 1) {
                throw new \Exception();
            }

        } catch (\Exception $e) {
            $return = true;
        }

        return $return;
    }

    protected function setSeo()
    {
        $GLOBALS['APPLICATION']->SetPageProperty('h1', htmlspecialchars_decode($this->arResult['SEO']['ELEMENT_PAGE_TITLE']));
        $GLOBALS['APPLICATION']->AddChainItem($this->arResult['ITEM']['MAIN_SECTION']['NAME'], $this->arResult['ITEM']['MAIN_SECTION']['SECTION_PAGE_URL']);
        $GLOBALS['APPLICATION']->AddChainItem($this->arResult['ITEM']['NAME']);

        $strTitle = 'Вопрос №'.$this->arResult['ITEM']['ID'].' по тематике '.$this->arResult['ITEM']['MAIN_SECTION']['NAME'].' | Хирург Ведров О. В. | Консультация online';

        $GLOBALS['APPLICATION']->SetTitle(htmlspecialchars_decode($strTitle));
        $GLOBALS['APPLICATION']->SetPageProperty('title', htmlspecialchars_decode($strTitle));

        $strDescr = $this->arResult['ITEM']['MAIN_SECTION']['NAME'].' - ответ на вопрос «'.( mb_strimwidth( (new Local\Core\Text\Format\FormatStripTags())->format($this->arResult['SEO']['ELEMENT_META_DESCRIPTION']), 0, 150, '...') ).'». Отвечает пластический хирург Ведров О. В.';

        $GLOBALS['APPLICATION']->SetPageProperty('description', $strDescr);
        $GLOBALS['APPLICATION']->SetPageProperty('keywords', htmlspecialchars_decode($this->arResult['SEO']['ELEMENT_META_KEYWORDS']));
    }
}