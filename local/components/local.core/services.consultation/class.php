<?

use Bitrix\Main\Application;
use Local\Core\Assistant\Consult;
use Local\Core\Exception\Component\Services;

class ServicesConsultationComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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
            $arResult = $obServiceComponent::extractTextBlocks($arData, 'CONSULTATION');

            $iUdId = $arData['ID'];
            if (in_array($iUdId, [463, 464, 485])) {
                $iUdId = 482;
            }

            $rsConsultSection = CIBlockSection::GetList([], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'), 'ACTIVE' => 'Y', 'UF_OPERATION' => $iUdId], false, ['ID']);
            if ($rsConsultSection->SelectedRowsCount() > 0) {
                $arConsultSection = $rsConsultSection->GetNext();

                # main section
                $rsSection = CIBlockSection::GetList(
                    [],
                    [
                        'ID' => $arConsultSection['ID'],
                        'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult')
                    ],
                    false,
                    ['ID', 'NAME', 'IBLOCK_ID', 'SECTION_PAGE_URL']
                );
                $arMainSectionData = $rsSection->GetNext();
                $arResult['MAIN_CONSULT_SECTION_DATA'] = $arMainSectionData;

                # tags
                $rsTags = CIBlockSection::GetList(
                    ['SORT' => 'ASC', 'NAME' => 'ASC'],
                    ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'), 'SECTION_ID' => $arMainSectionData['ID'], 'ACTIVE' => 'Y'],
                    ['CNT_ACTIVE' => 'Y'],
                    [
                        'ID',
                        'IBLOCK_ID',
                        'NAME',
                        'CODE',
                        'SECTION_PAGE_URL'
                    ]
                );
                while ($ar = $rsTags->GetNext()) {
                    if ($ar['ELEMENT_CNT'] > 0) {
                        $arResult['TAG'][$ar['ID']] = [
                            'NAME' => $ar['NAME'],
                            'SECTION_PAGE_URL' => $ar['SECTION_PAGE_URL'],
                        ];
                    }
                }

                # elems
                $rsElems = CIBlockElement::GetList(
                    ['ACTIVE_FROM' => 'DESC', 'ID' => 'DESC'],
                    [
                        'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                        'SECTION_ID' => $arResult['MAIN_CONSULT_SECTION_DATA']['ID'],
                        'INCLUDE_SUBSECTIONS' => 'Y',
                        'ACTIVE' => 'Y',
                        '!DETAIL_TEXT' => false
                    ],
                    false,
                    [
                        'nPageSize' => 10
                    ],
                    [
                        'ID',
                        'IBLOCK_ID',
                        'NAME',
                        'PREVIEW_TEXT',
                        'DETAIL_TEXT',
                        'PROPERTY_CONSULTANT',
                        'PROPERTY_ASKER_NAME'
                    ]
                );

                $arConsultants = [];
                while ($ob = $rsElems->GetNextElement()) {
                    $ar = $ob->GetFields();
                    $ar['SECTIONS'] = [];
                    $rsElemSections = CIBlockElement::GetElementGroups($ar['ID'], false, ['ID']);
                    while ($arSection = $rsElemSections->Fetch()) {
                        $ar['SECTIONS'][] = $arSection['ID'];
                    }

                    $arResult['ITEMS'][] = $ar;
                    $arConsultants[$ar['PROPERTY_CONSULTANT_VALUE']] = $ar['PROPERTY_CONSULTANT_VALUE'];
                }

                # consultants
                if (!empty($arConsultants)) {
                    $arResult['USER'] = Consult::getConsultantsData($arConsultants);
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