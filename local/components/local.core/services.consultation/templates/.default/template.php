<?
/**
 * @var array                         $arParams
 * @var array                         $arResult
 * @var ServicesConsultationComponent $component
 * @var CBitrixComponentTemplate      $this
 * @var string                        $templateName
 * @var string                        $componentPath
 * @var string                        $templateFolder
 * @global CMain                      $APPLICATION
 */
?>

<section id="body" class="container">

    <div class="content inner">

        <div class="title-preview">КОНСУЛЬТАЦИЯ ОНЛАЙН</div>
        <div class="before-text center">
            <? $GLOBALS['APPLICATION']->IncludeFile('include/consult-before-form.php', false, ['MODE' => 'html']) ?>
        </div>
        <?
        $GLOBALS['APPLICATION']->IncludeComponent(
            'local.core:consult.form-send-ask',
            '.default',
            ['SECTION_ID' => $arResult['MAIN_CONSULT_SECTION_DATA']['ID']],
            false,
            ['HIDE_ICON' => 'Y']
        );
        ?>
        <div class="tags row row-f">
            <div class="col-xs-12 col-md-6">
                Часто задаваемые вопросы для вашего удобства разбиты по тегам:
            </div>
            <div class="col-xs-12 col-md-6">
                <? foreach ($arResult['TAG'] as $arItem): ?>
                    <a href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                <? endforeach; ?>
            </div>
        </div>

        <div class="more">
            <a href="<?=$arResult['ABOUT_OPERATION']?>" class="arrow">Об операции</a>
            <span class="arrow js-open-callback-form">Бесплатная консультация</span>
        </div>

        <div class="consultList">
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
                <div class="consultList__item">
                    <div class="title-preview"><a href="<?=$arResult['MAIN_CONSULT_SECTION_DATA']['SECTION_PAGE_URL'].$arItem['ID'].'/'?>">ВОПРОС №<?=$arItem['ID']?><span>/</span><?=$arItem['PROPERTY_ASKER_NAME_VALUE']?> (<?=\FormatDate('d F Y', strtotime($arItem['ACTIVE_FROM']))?> г.)</a></div>
                    <div class="question">
                        <a href="<?=$arResult['MAIN_CONSULT_SECTION_DATA']['SECTION_PAGE_URL'].$arItem['ID'].'/'?>" class="ico-faq"></a>
                        <p><?=$arItem['PREVIEW_TEXT']?></p>
                    </div>
                    <div class="answer">
                        <?
                        switch (mb_strtoupper($arItem['DETAIL_TEXT_TYPE'])) {
                            case 'HTML':
                                echo $arItem['DETAIL_TEXT'];
                                break;
                            case 'TEXT':
                                ?>
                                <p><?=$arItem['DETAIL_TEXT']?></p>
                                <?
                                break;
                        }
                        ?>
                        <div class="author">
                            <div class="image"><a href="/o-doktore/"><img src="<?=$arResult['USER'][$arItem['PROPERTY_CONSULTANT_VALUE']]['IMG']?>" alt="<?=$arResult['USER'][$arItem['PROPERTY_CONSULTANT_VALUE']]['FIO']?>" /></a></div>
                            <div class="title"><a href="/o-doktore/"><?=$arResult['USER'][$arItem['PROPERTY_CONSULTANT_VALUE']]['FIO']?> <span><?=$arResult['USER'][$arItem['PROPERTY_CONSULTANT_VALUE']]['WORK_POSITION']?></span></a></div>
                        </div>
                    </div>
                    <div class="consult-tags">
                        <span>Теги:</span>
                        <? foreach ($arItem['SECTIONS'] as $intId): ?>
                            <a href="<?=$arResult['TAG'][$intId]['SECTION_PAGE_URL']?>"><?=$arResult['TAG'][$intId]['NAME']?></a>
                        <? endforeach; ?>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <div class="more">
            <a href="<?=$arResult['MAIN_CONSULT_SECTION_DATA']['SECTION_PAGE_URL']?>" class="arrow">Все вопросы</a>
        </div>

        <? if (!empty($arResult['SECOND_BLOCK'])): ?>
            <?=$arResult['SECOND_BLOCK']?>
            <div class="line"></div>
        <? endif; ?>

    </div>
    <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.free-consult', '.default', [], false, ['HIDE_ICON' => 'Y']) ?>
</section>
