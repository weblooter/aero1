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
            $rsUser = \Bitrix\Main\UserTable::getList([
                'filter' => [
                    'ID' => $arResult['ITEM']['PROPERTY_CONSULTANT_VALUE']
                ],
                'select' => [
                    'ID',
                    'LAST_NAME',
                    'NAME',
                    'SECOND_NAME',
                    'WORK_POSITION',
                    'PERSONAL_PHOTO',
                ]
            ]);
            while ($ar = $rsUser->fetch()) {
                $arImage = \CFile::ResizeImageGet($ar['PERSONAL_PHOTO'], ['width' => 128, 'height' => 128], BX_RESIZE_IMAGE_EXACT, false, false, false, 75);
                $arResult['USER'][$ar['ID']] = [
                    'FIO' => $ar['LAST_NAME'].' '.substr($ar['NAME'], 0, 1).'. '.substr($ar['SECOND_NAME'], 0, 1).'.',
                    'IMG' => $arImage['src'],
                    'WORK_POSITION' => $ar['WORK_POSITION']
                ];
            }
        }

        # tags
        $rsElemSections = \CIBlockElement::GetElementGroups($arResult['ITEM']['ID'], false, ['ID']);
        while ($ar = $rsElemSections->Fetch()) {
            $arResult['ITEM']['SECTIONS'][] = $ar['ID'];
        }

        $intMainSection = 0;
        $rsSectionChain = \CIBlockSection::GetNavChain(\Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'), $arResult['ITEM']['SECTIONS'][0], ['ID', 'NAME', 'IBLOCK_ID', 'SECTION_PAGE_URL']);
        while ($ar = $rsSectionChain->GetNext()) {
            $intMainSection = $ar['ID'];
            $arResult['ITEM']['MAIN_SECTION'] = $ar;
            break;
        }

        $rsSections = \CIBlockSection::GetList([], [
            'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
            'SECTION_ID' => $intMainSection,
        ], false, ['ID', 'NAME', 'IBLOCK_ID', 'SECTION_PAGE_URL']);
        while ($ar = $rsSections->GetNext()) {
            $arResult['TAGS'][$ar['ID']] = [
                'NAME' => $ar['NAME'],
                'SECTION_PAGE_URL' => $ar['SECTION_PAGE_URL'],
            ];
        }

        $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
            $arResult['ITEM']["IBLOCK_ID"],
            $arResult['ITEM']["ID"]
        );
        $arResult['SEO'] = $ipropValues->getValues();

        $this->arResult = $arResult;
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
        $GLOBALS['APPLICATION']->SetTitle(htmlspecialchars_decode($this->arResult['SEO']['ELEMENT_META_TITLE']));
        $GLOBALS['APPLICATION']->SetPageProperty('title', htmlspecialchars_decode($this->arResult['SEO']['ELEMENT_META_TITLE']));
        $GLOBALS['APPLICATION']->SetPageProperty('description', (new Local\Core\Text\Format\FormatStripTags())->format($this->arResult['SEO']['ELEMENT_META_DESCRIPTION']));
        $GLOBALS['APPLICATION']->SetPageProperty('keywords', htmlspecialchars_decode($this->arResult['SEO']['ELEMENT_META_KEYWORDS']));
    }
}