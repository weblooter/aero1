<?

class ConsultSectionComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{
    public function executeComponent()
    {
        if ($this->is404()) {
            $this->_show404Page();
        }

        $this->fillResult();
        $this->includeComponentTemplate();
    }

    protected $arSectionData = [];

    protected function fillResult()
    {
        $arResult = [
            'SECTION' => $this->arSectionData
        ];


        $nav = new \Bitrix\Main\UI\PageNavigation("nav-consult");
        $nav->allowAllRecords(true)
            ->setPageSize(20)
            ->initFromUri();


        $obCache = \Bitrix\Main\Application::getInstance()->getCache();
        if( $obCache->startDataCache(60*60*24, __FILE__.__LINE__.'#'.$nav->getCurrentPage()) )
        {
            $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
                \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                $this->arSectionData['ID']
            );

            $arResult['SECTION']["SEO_VALUES"] = $ipropValues->getValues();

            $rsTags = \CIBlockSection::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'), 'SECTION_ID' => $this->arSectionData['ID'], 'ACTIVE' => 'Y'], ['CNT_ACTIVE' => 'Y'], [
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

            $rsElems = \CIBlockElement::GetList(['ACTIVE_FROM' => 'DESC', 'ID' => 'DESC'], [
                'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                'SECTION_ID' => $this->arSectionData['ID'],
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
            if ($arConsultants > 0) {
                $rsUser = \Bitrix\Main\UserTable::getList([
                    'filter' => [
                        'ID' => $arConsultants
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

        }
        else
        {
            $arResult = $obCache->getVars();
        }
        $rsElems = \CIBlockElement::GetList(['ACTIVE_FROM' => 'DESC', 'ID' => 'DESC'], [
            'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
            'SECTION_ID' => $this->arSectionData['ID'],
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
    }

    protected function is404()
    {
        $return = false;
        if (
        empty(\Bitrix\Main\Application::getInstance()
            ->getContext()
            ->getRequest()
            ->get('SECTION_CODE'))
        ) {
            $return = true;
        }

        $rsSection = \CIBlockSection::GetList([], [
            'CODE' => \Bitrix\Main\Application::getInstance()
                ->getContext()
                ->getRequest()
                ->get('SECTION_CODE'),
            'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
            'DEPTH_LEVEL' => 1,
            'ACTIVE' => 'Y'
        ], false, ['ID', 'NAME', 'IBLOCK_ID', 'SECTION_PAGE_URL']);
        if ($rsSection->SelectedRowsCount() < 1) {
            $return = true;
        }

        $this->arSectionData = $rsSection->GetNext();

        return $return;
    }
}