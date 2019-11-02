<?

use Local\Core\Exception\Component\Services;
use Local\Core\Text\Format;

class ServicesIndexComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
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
            $arResult = $obServiceComponent::extractTextBlocks($arData, 'INDEX');


            # operation props
            if (!empty($arData['PROPERTIES']['INDEX_OPETAION_PROPS']['VALUE'])) {
                $obOperationPropsClass = \Local\Core\HighloadBlock\Entity::getInstance(\Local\Core\HighloadBlock\Entity::Opetationprops);
                $rsOperationsProps = $obOperationPropsClass::getList([
                    'select' => [
                        '*'
                    ]
                ]);
                $arOperationsProps = [];
                while ($ar = $rsOperationsProps->fetch()) {
                    $arOperationsProps[$ar['UF_XML_ID']] = [
                        'NAME' => $ar['UF_NAME'],
                        'IMG' => \CFile::GetPath($ar['UF_FILE']),
                    ];
                }

                foreach ($arData['PROPERTIES']['INDEX_OPETAION_PROPS']['VALUE'] as $k => $v) {
                    $arResult['OPERATION_ICONS'][] = [
                        'IMG' => $arOperationsProps[$v]['IMG'],
                        'NAME' => $arOperationsProps[$v]['NAME'],
                        'VALUE' => $arData['PROPERTIES']['INDEX_OPETAION_PROPS_VAL']['VALUE'][$k]
                    ];
                }
            }

            # photos
            if (!empty($arData['PROPERTIES']['INDEX_PHOTOS_BEFORE_AFTER']['VALUE'])) {
                foreach ($arData['PROPERTIES']['INDEX_PHOTOS_BEFORE_AFTER']['VALUE'] as $intId) {
                    $arTmp = \CFile::ResizeImageGet($intId, ['width' => 900, 'height' => 600], BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 75);
                    $arResult['PHOTOS_BEFORE_AFTER'][] = $arTmp['src'];
                }
            }

            $this->extractReviews($arData, $arResult);
            $this->extractPatients($arData, $arResult);
            $this->extractConsult($arData, $arResult);

            $arResult['ABOUT_OPERATION'] = $arData['DETAIL_PAGE_URL'];
            $obCache->endDataCache($arResult);
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
    }

    protected function extractPatients(& $arData, & $arResult)
    {
        if (!empty($arData['PROPERTIES']['REVIEW_REVIEWS']['VALUE']) && preg_match('/\{\{SERVICES_INDEX_PATIENTS\}\}(.*?)\{\{\/SERVICES_INDEX_PATIENTS\}\}/', $arResult['SECOND_BLOCK'], $arPatientMatch) === 1) {
            $rsElems = \CIBlockElement::GetList(['ACTIVE_FROM' => 'DESC', 'SORT' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'useful_patient'), 'ACTIVE' => 'Y', 'ID' => $arData['PROPERTIES']['REVIEW_REVIEWS']['VALUE']]);

            $strHtmlPatientBlock = '';
            if ($rsElems->SelectedRowsCount() > 0) {
                $arPatients = [];
                while ($obElem = $rsElems->GetNextElement()) {
                    $arElem = $obElem->GetFields();
                    $arElem['PROPERTIES'] = $obElem->GetProperties();

                    $arElem['DETAIL_PAGE_URL'] = $arData['DETAIL_PAGE_URL'].'review/'.$arElem['ID'].'/';

                    $arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'] = (new Format\FormatCommon())->format(htmlspecialchars_decode($arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT']));
                    if (mb_strtoupper($arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TYPE']) == 'TEXT') {
                        $arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'] = '<p>'.$arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'].'</p>';
                    }

                    if (!empty($arElem['PROPERTIES']['PHOTOS']['VALUE'])) {
                        $arElem['PROPERTIES']['PHOTOS']['VALUE'] = array_map(function ($v)
                            {
                                $arTmp = [
                                    'BIG' => \CFile::ResizeImageGet($v, ['width' => 510, 'height' => 340], BX_RESIZE_IMAGE_EXACT, false, false, false, 75)
                                ];
                                ksort($arTmp);
                                return array_combine(array_keys($arTmp), array_column($arTmp, 'src'));
                            }, $arElem['PROPERTIES']['PHOTOS']['VALUE']);

                        $arPatients['PATIENT_ITEMS'][] = $arElem;
                    }
                }

                $strHtmlImgGallery = '';
                $arPatients['PATIENT_ITEMS'] = array_splice($arPatients['PATIENT_ITEMS'], 0, 4);
                foreach ($arPatients['PATIENT_ITEMS'] as $arItem) {

                    foreach ($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $arImg) {
                        $strHtmlImgGallery .= '<div class="slide reviews__gallery__item"><a href="'.($arData['DETAIL_PAGE_URL'].'review/'.$arItem['ID']).'" style="background-image: url('.$arImg['BIG'].');"><span class="arrow">Подробнее</span></a></div>';
                    }
                }

                $strLinkMorePatients = $arData['DETAIL_PAGE_URL'].'review/';

                $strHtmlPatientBlock = <<<DOCHERE
<section class="infoMedia container post-up">
    <div class="row row-f reviews">
        <div class="col-xs-12 col-sm-6 reviews__text post-left">
            <div class="title-preview">Делитесь вашими фотографиями</div>
            <div class="h2">Довольные пациенты</div>
            <div class="more"><a href="$strLinkMorePatients" class="arrow">Больше пациентов</a></div>
        </div>
        <div class="col-xs-12 col-sm-6 reviews__gallery post-right">
            <div class="reviews__gallery__container">
                <div class="sliderGallery js-slider-gallery">
                    $strHtmlImgGallery
                </div>
            </div>
        </div>
    </div>
</section>
DOCHERE;

            }

            $arResult['SECOND_BLOCK'] = str_replace($arPatientMatch[0], (new Format\FormatNewLine())->format($strHtmlPatientBlock), $arResult['SECOND_BLOCK']);
        }
    }

    protected function extractReviews(& $arData, & $arResult)
    {
        if (!empty($arData['PROPERTIES']['REVIEW_REVIEWS']['VALUE']) && preg_match('/\{\{SERVICES_INDEX_REVIEWS\}\}(.*?)\{\{\/SERVICES_INDEX_REVIEWS\}\}/', $arResult['SECOND_BLOCK'], $arPatientMatch) === 1) {
            $rsElems = \CIBlockElement::GetList(
                [
                    'ACTIVE_FROM' => 'DESC',
                    'SORT' => 'ASC'
                ],
                [
                    'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'useful_patient'),
                    'ACTIVE' => 'Y',
                    'ID' => $arData['PROPERTIES']['REVIEW_REVIEWS']['VALUE']
                ]
            );
            $arReviews = [];

            $strHtmlReviewBlock = '';

            if ($rsElems->SelectedRowsCount() > 0) {
                while ($obElem = $rsElems->GetNextElement()) {
                    $arElem = $obElem->GetFields();
                    $arElem['PROPERTIES'] = $obElem->GetProperties();

                    $arElem['DETAIL_PAGE_URL'] = $arData['DETAIL_PAGE_URL'].'review/'.$arElem['ID'].'/';

                    $arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'] = (new Format\FormatCommon())->format(htmlspecialchars_decode($arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT']));
                    if (mb_strtoupper($arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TYPE']) == 'TEXT') {
                        $arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'] = '<p>'.$arElem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT'].'</p>';
                    }

                    if (!empty($arElem['PROPERTIES']['PHOTOS']['VALUE'])) {
                        $arElem['PROPERTIES']['PHOTOS']['VALUE'] = array_map(function ($v)
                            {
                                $arTmp = [
                                    'THUMB' => \CFile::ResizeImageGet($v, ['width' => 100, 'height' => 65], BX_RESIZE_IMAGE_EXACT, false, false, false, 75),
                                ];
                                ksort($arTmp);
                                return array_combine(array_keys($arTmp), array_column($arTmp, 'src'));
                            }, $arElem['PROPERTIES']['PHOTOS']['VALUE']);

                    }

                    $arReviews['PATIENT_ITEMS'][] = $arElem;
                }

                $arReviews['PATIENT_ITEMS'] = array_splice($arReviews['PATIENT_ITEMS'], 0, 4);

                $strHtmlReview = '';
                foreach ($arReviews['PATIENT_ITEMS'] as $arItem) {

                    $strHtmlReview .= '<div class="col-xs-12 col-md-6">
<div class="reviewList__item">
    <div class="title-preview">Отзыв</div>
    <div class="review__author">'.($arItem['PROPERTIES']['REVIEW_NAME']['VALUE']).'</div>
    <div class="reviewList__item__text">
        <div class="text">'.($arItem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT']).'</div>';

                    if (!empty($arItem['PROPERTIES']['PHOTOS']['VALUE'])) {
                        $strHtmlReview .= '<div class="review__photos">';
                    }

                    foreach ($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $arImg) {
                        $strHtmlReview .= '<div class="review__photos__item"><img src="'.($arImg['THUMB']).'" /></div>';
                    }

                    if (!empty($arItem['PROPERTIES']['PHOTOS']['VALUE'])) {
                        $strHtmlReview .= '</div>';
                    }

                    $strHtmlReview .= '</div>
    <div class="readmore"><a href="'.($arData['DETAIL_PAGE_URL'].'review/'.$arItem['ID']).'" class="arrow">Подробнее</a></div>
</div>
</div>';
                }

                $strLinkMorePatients = $arData['DETAIL_PAGE_URL'].'review/';

                $strHtmlReviewBlock = <<<DOCHERE
<div class="reviewList row row-f">
    $strHtmlReview
</div>
<div class="more">
    <a href="$strLinkMorePatients" class="arrow">Смотреть все отзывы</a>
    <span class="arrow js-open-callback-form">Бесплатная консультация</span>
</div>
DOCHERE;

            }

            $arResult['SECOND_BLOCK'] = str_replace($arPatientMatch[0], (new Format\FormatNewLine())->format($strHtmlReviewBlock), $arResult['SECOND_BLOCK']);
        }
    }

    protected function extractConsult($arData, & $arResult)
    {
        if (preg_match('/\{\{SERVICES_INDEX_CONSULT\}\}(.*?)\{\{\/SERVICES_INDEX_CONSULT\}\}/', $arResult['SECOND_BLOCK'], $arConsultMatch) === 1) {

            $strHtmlConsultBlock = '';
            $arConsultResult = [];

            $rsConsultSection = \CIBlockSection::GetList([], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'), 'ACTIVE' => 'Y', 'UF_OPERATION' => $arData['ID']], false, ['ID']);
            if ($rsConsultSection->SelectedRowsCount() > 0) {

                $arConsultSection = $rsConsultSection->GetNext();

                # main section
                $rsSection = \CIBlockSection::GetList([], [
                    'ID' => $arConsultSection['ID'],
                    'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult')
                ], false, ['ID', 'NAME', 'IBLOCK_ID', 'SECTION_PAGE_URL']);
                $arMainSectionData = $rsSection->GetNext();
                $arConsultResult['MAIN_CONSULT_SECTION_DATA'] = $arMainSectionData;

                # tags
                $rsTags = \CIBlockSection::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'), 'SECTION_ID' => $arMainSectionData['ID'], 'ACTIVE' => 'Y'], ['CNT_ACTIVE' => 'Y'], [
                    'ID',
                    'IBLOCK_ID',
                    'NAME',
                    'CODE',
                    'SECTION_PAGE_URL'
                ]);
                while ($ar = $rsTags->GetNext()) {
                    if ($ar['ELEMENT_CNT'] > 0) {
                        $arConsultResult['TAG'][$ar['ID']] = [
                            'NAME' => $ar['NAME'],
                            'SECTION_PAGE_URL' => $ar['SECTION_PAGE_URL'],
                        ];
                    }
                }

                # elems
                $rsElems = \CIBlockElement::GetList(['ACTIVE_FROM' => 'DESC', 'ID' => 'DESC'], [
                    'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                    'SECTION_ID' => $arConsultResult['MAIN_CONSULT_SECTION_DATA']['ID'],
                    'INCLUDE_SUBSECTIONS' => 'Y',
                    'ACTIVE' => 'Y',
                    '!DETAIL_TEXT' => false
                ], false, [
                    'nPageSize' => 10
                ], [
                    'ID',
                    'IBLOCK_ID',
                    'NAME',
                    'PREVIEW_TEXT',
                    'DETAIL_TEXT',
                    'PROPERTY_CONSULTANT',
                    'PROPERTY_ASKER_NAME'
                ]);

                $arConsultants = [];
                while ($ob = $rsElems->GetNextElement()) {
                    $ar = $ob->GetFields();
                    $ar['SECTIONS'] = [];
                    $rsElemSections = \CIBlockElement::GetElementGroups($ar['ID'], false, ['ID']);
                    while ($arSection = $rsElemSections->Fetch()) {
                        $ar['SECTIONS'][] = $arSection['ID'];
                    }

                    if (mb_strtoupper($ar['PREVIEW_TEXT_TYPE']) === 'TEXT') {
                        $ar['PREVIEW_TEXT'] = '<p>'.($ar['PREVIEW_TEXT']).'</p>';
                    }

                    if (mb_strtoupper($ar['DETAIL_TEXT_TYPE']) === 'TEXT') {
                        $ar['DETAIL_TEXT'] = '<p>'.($ar['DETAIL_TEXT']).'</p>';
                    }

                    $arConsultResult['ITEMS'][] = $ar;
                    $arConsultants[$ar['PROPERTY_CONSULTANT_VALUE']] = $ar['PROPERTY_CONSULTANT_VALUE'];
                }

                # consultants
                if (!empty($arConsultants)) {
                    $arConsultResult['USER'] = \Local\Core\Assistant\Consult::getConsultantsData($arConsultants);
                }

                if (!empty($arConsultResult['ITEMS'])) {

                    $strHtmlConsultBlock = '
<div class="consult">
    <div class="consultList">
        <div class="title-preview">КОНСУЛЬТАЦИИ ХИРУРГА</div>
        <div class="sliderConsult js-slider-consult">';

                    foreach ($arConsultResult['ITEMS'] as $arItem) {
                        $strHtmlConsultBlock .= '
            <div class="consultList__item slide">
                <div class="title-preview">
                    <a href="'.($arConsultResult['MAIN_CONSULT_SECTION_DATA']['SECTION_PAGE_URL'].$arItem['ID'].'/').'">ВОПРОС №'.($arItem['ID']).'<span>/</span>'.($arItem['PROPERTY_ASKER_NAME_VALUE']).' ('.(\FormatDate('d F Y', strtotime($arItem['ACTIVE_FROM']))).' г.)</a>
                </div>
                <div class="question">
                    <a href="'.($arConsultResult['MAIN_CONSULT_SECTION_DATA']['SECTION_PAGE_URL'].$arItem['ID'].'/').'" class="ico-faq"></a>
                    '.($arItem['PREVIEW_TEXT']).'
                </div>
                <div class="answer">
                    '.($arItem['DETAIL_TEXT']).'
                    <div class="author">
                        <div class="image">
                            <a href="/o-doktore/"><img src="'.($arConsultResult['USER'][$arItem['PROPERTY_CONSULTANT_VALUE']]['IMG']).'" /></a>
                        </div>
                        <div class="title">
                            <a href="/o-doktore/">'.($arConsultResult['USER'][$arItem['PROPERTY_CONSULTANT_VALUE']]['FIO']).'<span>'.($arConsultResult['USER'][$arItem['PROPERTY_CONSULTANT_VALUE']]['WORK_POSITION']).'</span></a>
                        </div>
                    </div>
                </div>
                <div class="consult-tags">
                    <span>Теги:</span>';
                        foreach ($arItem['SECTIONS'] as $intId) {
                            $strHtmlConsultBlock .= '<a href="'.($arConsultResult['TAG'][$intId]['SECTION_PAGE_URL']).'">'.($arConsultResult['TAG'][$intId]['NAME']).'</a>';
                        }

                        $strHtmlConsultBlock .= '
                </div>
            </div>';
                    }

                    $strHtmlConsultBlock .= '
        </div>
    </div>
</div>';

                }

            }

            $arResult['SECOND_BLOCK'] = str_replace($arConsultMatch[0], (new Format\FormatNewLine())->format($strHtmlConsultBlock), $arResult['SECOND_BLOCK']);
        }
    }
}