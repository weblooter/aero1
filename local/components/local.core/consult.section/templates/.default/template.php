<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var ConsultSectionComponent  $component
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
    <?
    switch ($arResult['MODE']) {
        case $component::MODE_SECTION:
            ?>
            <div class="content before-text center">
                <? $GLOBALS['APPLICATION']->IncludeFile('include/consult-before-form.php', false, ['MODE' => 'html']) ?>
            </div>
            <?
            $GLOBALS['APPLICATION']->IncludeComponent(
                'local.core:consult.form-send-ask',
                '.default',
                ['SECTION_ID' => $arResult['SECTION']['ID']],
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
            <?
            break;
        case $component::MODE_TAG:
            ?>
            <div class="content">
                <?
                if (!empty($arResult['SECTION']['UF_VIDEO_LINK'])): ?>
                    <div class="video">
                        <div class="video__item">
                            <div class="video__item__text">
                                <?
                                if (!empty($arResult['SECTION']['UF_VIDOE_TITLE'])):?>
                                    <div class="title-preview"><?=$arResult['SECTION']['UF_VIDOE_TITLE']?></div>
                                <? endif; ?>
                                <?
                                if (!empty($arResult['SECTION']['UF_VIDEO_NAME'])):?>
                                    <div class="h2"><?=$arResult['SECTION']['UF_VIDEO_NAME']?></div>
                                <? endif; ?>
                            </div>
                            <div class="link">
                                <?
                                if (!empty($arResult['SECTION']['UF_VIDOE_TITLE'])):?>
                                    <div class="title-preview"><?=$arResult['SECTION']['UF_VIDOE_TITLE']?></div>
                                <? endif; ?>
                                <?
                                if (!empty($arResult['SECTION']['UF_VIDEO_NAME'])):?>
                                    <div class="h2"><?=$arResult['SECTION']['UF_VIDEO_NAME']?></div>
                                <? endif; ?>
                                <img src="<?=$arResult['SECTION']['UF_VIDEO_IMG']?>" />
                                <a data-mfp-src="<?=$arResult['SECTION']['UF_VIDEO_LINK']?>>" class="video-ico js-video-popup"></a>
                            </div>
                            <?
                            if (!empty($arResult['SECTION']['UF_VIDEP_DESC'])):?>
                                <p><?=$arResult['SECTION']['UF_VIDEP_DESC']?></p>
                            <? endif; ?>
                        </div>
                    </div>
                <?
                endif; ?>
                <?
                switch (mb_strtoupper($arResult['SECTION']['DESCRIPTION_TYPE']))
                {
                    case 'HTML':
                        echo $arResult['SECTION']['DESCRIPTION'];
                        break;
                    case 'TEXT':
                        echo '<p>'.$arResult['SECTION']['DESCRIPTION'].'</p>';
                        break;
                }
                ?>
                <? // TODO Сделать ссылку на операцию когда она будет закончена
                ?>
                <p>Здесь собраны все вопросы-ответы, по тегу <strong><?=$arResult['SECTION']['NAME']?></strong> в операции "<a href=""><?=$arResult['MAIN_SECTION']['NAME']?></a>". </p>
            </div>
            <?
            break;
    }
    ?>


    <div class="more">
        <? // TODO Сделать ссылку на операцию когда она будет закончена ?>
        <a href="" class="arrow">Об операции</a>
        <span class="arrow js-open-callback-form">Бесплатная консультация</span>
    </div>

    <div class="consultList">
        <? foreach ($arResult['ITEMS'] as $arItem): ?>
            <div class="consultList__item">
                <div class="title-preview"><a href="<?=$arResult['MAIN_SECTION']['SECTION_PAGE_URL'].$arItem['ID'].'/'?>">ВОПРОС №<?=$arItem['ID']?><span>/</span><?=$arItem['PROPERTY_ASKER_NAME_VALUE']?> (<?=\FormatDate('d F Y', strtotime($arItem['ACTIVE_FROM']))?> г.)</a></div>
                <div class="question">
                    <a href="<?=$arResult['MAIN_SECTION']['SECTION_PAGE_URL'].$arItem['ID'].'/'?>" class="ico-faq"></a>
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

    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.pagenavigation",
        ".default",
        array(
            "NAV_OBJECT" => $arResult['NAV'],
            "SEF_MODE" => "N", // ЧПУ пагинация или нет, Y|N
            "SHOW_COUNT" => "N",
        ),
        false,
        ['HIDE_ICON' => 'Y']
    );
    ?>

    <div class="line"></div>
    <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.free-consult', '.default', [], false, ['HIDE_ICON' => 'Y']) ?>
</section>
