<?

use Local\Core\Text\Format;

class ConsultSectionComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{
    const MODE_SECTION = 'SEC';
    const MODE_TAG = 'TAG';

    protected $arMainSectionData = [];
    protected $arTagData = [];
    protected $_mode = null;

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
        # section & main section
        $arResult = [
            'MODE' => $this->_mode,
            'MAIN_SECTION' => $this->arMainSectionData
        ];
        switch ($this->_mode) {
            case self::MODE_SECTION:
                $arResult['SECTION'] = $this->arMainSectionData;
                break;
            case self::MODE_TAG:
                $arResult['SECTION'] = $this->arTagData;
                break;
        }
        $obRequest = \Bitrix\Main\Application::getInstance()
            ->getContext()
            ->getRequest();


        $nav = new \Bitrix\Main\UI\PageNavigation("nav-consult");
        $nav->allowAllRecords(true)
            ->setPageSize(20)
            ->initFromUri();


        # cache
        $obCache = \Bitrix\Main\Application::getInstance()
            ->getCache();
        if ($obCache->startDataCache(60 * 60 * 24, __FILE__.__LINE__.'#'.$obRequest->get('SECTION_CODE').'#'.$obRequest->get('TAG_CODE').'#'.$nav->getCurrentPage())) {
            # section seo
            $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
                \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                $arResult['SECTION']['ID']
            );
            $arResult['SECTION']["SEO_VALUES"] = $ipropValues->getValues();

            # tag mode format
            if ($this->_mode === self::MODE_TAG) {
                $arResult['SECTION']['DESCRIPTION'] = (new Format\FormatConsult())->format($arResult['SECTION']['DESCRIPTION']);
                $arResult['SECTION']['SEO_VALUES']['SECTION_META_DESCRIPTION'] = (new Format\FormatTrim(new Format\FormatStripTags((new Format\FormatConsult()))))->format($arResult['SECTION']['DESCRIPTION']);

                if ($arResult['SECTION']['UF_VIDEO_IMG'] > 0) {
                    $arResult['SECTION']['UF_VIDEO_IMG'] = \CFile::ResizeImageGet($arResult['SECTION']['UF_VIDEO_IMG'], ['width' => 570, 'height' => 570], BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 75);
                    $arResult['SECTION']['UF_VIDEO_IMG'] = $arResult['SECTION']['UF_VIDEO_IMG']['src'];
                }
            }


            # tags
            $rsTags = \CIBlockSection::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'), 'SECTION_ID' => $this->arMainSectionData['ID'], 'ACTIVE' => 'Y'], ['CNT_ACTIVE' => 'Y'], [
                'ID',
                'IBLOCK_ID',
                'NAME',
                'CODE',
                'SECTION_PAGE_URL'
            ]);
            while ($ar = $rsTags->GetNext()) {
                if ($ar['ELEMENT_CNT'] > 0) {
                    $arResult['TAG'][$ar['ID']] = [
                        'NAME' => $ar['NAME'],
                        'SECTION_PAGE_URL' => $ar['SECTION_PAGE_URL'],
                    ];
                }
            }

            # elems
            $rsElems = \CIBlockElement::GetList(['ACTIVE_FROM' => 'DESC', 'ID' => 'DESC'], [
                'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                'SECTION_ID' => $arResult['SECTION']['ID'],
                'INCLUDE_SUBSECTIONS' => 'Y',
                'ACTIVE' => 'Y',
                '!DETAIL_TEXT' => false
            ], false, [
                'nPageSize' => $nav->getLimit(),
                'iNumPage' => (($nav->getOffset() / $nav->getLimit()) + 1)
            ], [
                'ID',
                'IBLOCK_ID',
                'NAME',
                'PREVIEW_TEXT',
                'DETAIL_TEXT',
                'PROPERTY_CONSULTANT',
                'PROPERTY_ASKER_NAME'
            ]);
            $nav->setRecordCount($rsElems->SelectedRowsCount());
            $arConsultants = [];
            while ($ob = $rsElems->GetNextElement()) {
                $ar = $ob->GetFields();
                $ar['SECTIONS'] = [];
                $rsElemSections = \CIBlockElement::GetElementGroups($ar['ID'], false, ['ID']);
                while ($arSection = $rsElemSections->Fetch()) {
                    $ar['SECTIONS'][] = $arSection['ID'];
                }

                $arResult['ITEMS'][] = $ar;
                $arConsultants[$ar['PROPERTY_CONSULTANT_VALUE']] = $ar['PROPERTY_CONSULTANT_VALUE'];
            }

            # consultants
            if (sizeof($arConsultants) > 0) {
                $arResult['USER'] = \Local\Core\Assistant\Consult::getConsultantsData($arConsultants);
            }

        } else {
            $arResult = $obCache->getVars();
        }

        # nav object
        $rsElems = \CIBlockElement::GetList(['ACTIVE_FROM' => 'DESC', 'ID' => 'DESC'], [
            'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
            'SECTION_ID' => $arResult['SECTION']['ID'],
            'INCLUDE_SUBSECTIONS' => 'Y',
            'ACTIVE' => 'Y',
            '!DETAIL_TEXT' => false
        ], false, [
            'nPageSize' => $nav->getLimit(),
            'iNumPage' => (($nav->getOffset() / $nav->getLimit()) + 1)
        ], [
            'ID',
        ]);
        $nav->setRecordCount($rsElems->SelectedRowsCount());

        $arResult['NAV'] = $nav;

        $this->arResult = $arResult;
        $this->setSeo();

    }

    protected function is404()
    {
        $return = false;
        $obRequest = \Bitrix\Main\Application::getInstance()
            ->getContext()
            ->getRequest();

        try {
            if (empty($obRequest->get('SECTION_CODE'))) {
                throw new \Exception();
            }
            $this->_mode = self::MODE_SECTION;

            $rsSection = \CIBlockSection::GetList([], [
                'CODE' => $obRequest->get('SECTION_CODE'),
                'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                'DEPTH_LEVEL' => 1,
                'ACTIVE' => 'Y'
            ], false, ['ID', 'NAME', 'IBLOCK_ID', 'SECTION_PAGE_URL']);
            if ($rsSection->SelectedRowsCount() < 1) {
                throw new \Exception();
            }
            $this->arMainSectionData = $rsSection->GetNext();


            if (isset($_GET['TAG_CODE'])) {
                if (empty($obRequest->get('TAG_CODE'))) {
                    throw new \Exception();
                }
                $this->_mode = self::MODE_TAG;

                $rsTag = \CIBlockSection::GetList([], [
                    'CODE' => $obRequest->get('TAG_CODE'),
                    'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                    'DEPTH_LEVEL' => 2,
                    'SECTION_ID' => $this->arMainSectionData['ID'],
                    'ACTIVE' => 'Y'
                ], false, ['ID', 'NAME', 'IBLOCK_ID', 'UF_*', 'DESCRIPTION']);
                if ($rsTag->SelectedRowsCount() < 1) {
                    throw new \Exception();
                }
                $this->arTagData = $rsTag->GetNext();
            }


        } catch (\Exception $e) {
            $return = true;
        }


        return $return;
    }

    protected function setSeo()
    {
        $GLOBALS['APPLICATION']->SetPageProperty('h1', htmlspecialchars_decode($this->arResult['SECTION']['SEO_VALUES']['SECTION_PAGE_TITLE']));
        if ($this->_mode === self::MODE_TAG) {
            $GLOBALS['APPLICATION']->AddChainItem($this->arResult['MAIN_SECTION']['NAME'], $this->arResult['MAIN_SECTION']['SECTION_PAGE_URL']);
        }
        $GLOBALS['APPLICATION']->AddChainItem($this->arResult['SECTION']['NAME']);
        $GLOBALS['APPLICATION']->SetTitle($this->arResult['SECTION']['SEO_VALUES']['SECTION_META_TITLE'].($this->arResult['NAV']->getCurrentPage() > 1 ? ' - страница '.$this->arResult['NAV']->getCurrentPage() : ''));
        $GLOBALS['APPLICATION']->SetPageProperty('title', $this->arResult['SECTION']['SEO_VALUES']['SECTION_META_TITLE'].($this->arResult['NAV']->getCurrentPage() > 1 ? ' - страница '.$this->arResult['NAV']->getCurrentPage() : ''));
        $GLOBALS['APPLICATION']->SetPageProperty('description', (new Local\Core\Text\Format\FormatStripTags())->format($this->arResult['SECTION']['SEO_VALUES']['SECTION_META_DESCRIPTION']));
        $GLOBALS['APPLICATION']->SetPageProperty('keywords', $this->arResult['SECTION']['SEO_VALUES']['SECTION_META_KEYWORDS']);
    }
}