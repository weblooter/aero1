<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var ConsultDetailComponent   $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */

?>
<section id="body" class="container">
    <div class="h1-title"><?=$GLOBALS['APPLICATION']->GetPageProperty('pre-h1')?></div>
    <h1><?=$GLOBALS['APPLICATION']->GetPageProperty('h1')?></h1>
    <div class="content">
        <div class="consultList">
            <div class="consultList__item">
                <div class="title-preview">ВОПРОС №<?=$arResult['ITEM']['ID']?><span>/</span><?=$arResult['ITEM']['PROPERTY_ASKER_NAME_VALUE']?> (<?=FormatDate('d F Y', strtotime($arResult['ITEM']['ACTIVE_FROM']))?> г.)</div>
                <div class="question">
                    <span class="ico-faq"></span>
                    <p><?=$arResult['ITEM']['PREVIEW_TEXT']?></p>
                </div>
                <div class="answer">
                    <?
                    switch (mb_strtoupper($arResult['ITEM']['DETAIL_TEXT_TYPE'])) {
                        case 'HTML':
                            echo $arResult['ITEM']['DETAIL_TEXT'];
                            break;
                        case 'TEXT':
                            ?>
                            <p><?=$arResult['ITEM']['DETAIL_TEXT']?></p>
                            <?
                            break;
                    }
                    ?>
                    <div class="author">
                        <div class="image"><a href="/o-doktore/"><img src="<?=$arResult['USER'][$arResult['ITEM']['PROPERTY_CONSULTANT_VALUE']]['IMG']?>" alt="<?=$arResult['USER'][$arResult['ITEM']['PROPERTY_CONSULTANT_VALUE']]['FIO']?>" /></a></div>
                        <div class="title"><a href="/o-doktore/"><?=$arResult['USER'][$arResult['ITEM']['PROPERTY_CONSULTANT_VALUE']]['FIO']?> <span><?=$arResult['USER'][$arResult['ITEM']['PROPERTY_CONSULTANT_VALUE']]['WORK_POSITION']?></span></a></div>
                    </div>
                </div>
                <?
                if (!empty(array_intersect($arResult['ITEM']['SECTIONS'], array_keys($arResult['TAGS'])))): ?>
                    <div class="consult-tags">
                        <span>Теги:</span>
                        <?
                        foreach ($arResult['ITEM']['SECTIONS'] as $intSectID): ?>
                            <a href="<?=$arResult['TAGS'][$intSectID]['SECTION_PAGE_URL']?>"><?=$arResult['TAGS'][$intSectID]['NAME']?></a>
                        <?
                        endforeach; ?>
                    </div>
                <?
                endif; ?>
            </div>
        </div>


        <div class="more">
            <?
            if (!empty($arResult['OPERATION'])): ?>
                <a href="<?=$arResult['OPERATION']?>" class="arrow">Об операции</a>
            <?
            endif; ?>
            <span class="arrow js-open-callback-form">Бесплатная консультация</span>
        </div>

        <div class="content before-text center">
            <?
            $GLOBALS['APPLICATION']->IncludeFile('include/consult-detail.php', false, ['MODE' => 'HTML']) ?>
        </div>
        <?
        $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.form-send-ask', '.default', ['SECTION_ID' => $arResult['ITEM']['SECTIONS'][0]]) ?>
        <div class="tags row row-f">
            <div class="col-xs-12 col-md-6">
                Часто задаваемые вопросы для вашего удобства разбиты по тегам:
            </div>
            <div class="col-xs-12 col-md-6">
                <?
                foreach ($arResult['TAGS'] as $arItem): ?>
                    <a href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                <?
                endforeach; ?>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <?
    $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.free-consult', '.default', []) ?>
</section>
