<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var ServicesPhotoComponent   $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */

?>

<section id="body" class="container">

    <div class="content inner">

        <?=$arResult['FIRST_BLOCK']?>
        <div class="more">
            <a href="<?=$arResult['ABOUT_OPERATION']?>" class="arrow">Об операции</a>
            <span class="arrow js-open-callback-form">Бесплатная консультация</span>
        </div>

        <div class="works">

            <?
            foreach ($arResult['ITEMS'] as $arItem): ?>
                <div class="works__item">
                    <div class="row">
                        <div class="text col-xs-12 col-md-6">
                            <div class="title-preview"><?=$arItem['NAME']?></div>
                            <?=$arItem['PREVIEW_TEXT']?>
                        </div>
                        <div class="gallery col-xs-12 col-md-6 js-slider-with-nav">
                            <?
                            if (!empty($arItem['PROPERTIES']['IS_18']['VALUE'])): ?>
                            <div class="confirm">
                                <div class="confirm__age js-confirm-age">
                                    <div class="preview">18+</div>
                                    <div class="text">
                                        <?
                                        $GLOBALS['APPLICATION']->IncludeFile('include/work-photo-18.php', false, ['MODE' => 'HTML']) ?>
                                        <div class="more"><a class="arrow js-confirm-age-yes">ДА, МНЕ ИСПОЛНИЛОСЬ 18 ЛЕТ</a></div>
                                        <p><a class="js-confirm-age-no">Нет, мне ещё нет 18-ти</a></p>
                                    </div>
                                </div>
                                <?
                                endif; ?>
                                <div class="js-slider-for">
                                    <?
                                    foreach ($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $arPhoto): ?>
                                        <div class="slide gallery__item">
                                            <span><img src="<?=$arPhoto['BIG']?>" /></span>
                                        </div>
                                    <?
                                    endforeach; ?>
                                    <?
                                    if (!empty($arItem['PROPERTIES']['VIDEO_PREVIEW']['VALUE'])): ?>
                                        <?
                                        foreach ($arItem['PROPERTIES']['VIDEO_PREVIEW']['VALUE'] as $k => $arPhoto): ?>
                                            <div class="slide gallery__item gallery__item-youtube">
                                                <a href="javascript:void(0)" data-mfp-src="<?=$arItem['PROPERTIES']['VIDEO']['VALUE'][$k]?>" class="gallery__item-youtube-link js-video-popup">
                                                    <img src="<?=$arPhoto['BIG']?>" />
                                                </a>
                                            </div>
                                        <?
                                        endforeach; ?>
                                    <?
                                    endif; ?>
                                </div>
                                <?
                                if (!empty($arItem['PROPERTIES']['IS_18']['VALUE'])): ?>
                            </div>
                        <?
                        endif; ?>
                            <div class="js-slider-nav">
                                <?
                                foreach ($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $arPhoto): ?>
                                    <div class="slide">
                                        <span style="background-image:url(<?=$arPhoto['THUMB']?>)"></span>
                                    </div>
                                <?
                                endforeach; ?>
                                <?
                                if (!empty($arItem['PROPERTIES']['VIDEO_PREVIEW']['VALUE'])): ?>
                                    <?
                                    foreach ($arItem['PROPERTIES']['VIDEO_PREVIEW']['VALUE'] as $arPhoto): ?>
                                        <div class="slide slide-youtube">
                                            <span style="background-image:url(<?=$arPhoto['THUMB']?>)"></span>
                                        </div>
                                    <?
                                    endforeach; ?>
                                <?
                                endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="descripsion row row-f">
                        <?
                        foreach ($arItem['PROPERTIES']['OPERATION_PROPS']['VALUE'] as $key => $v): ?>
                            <div class="col-xs-12 col-md-4 descripsion__item">
                                <div class="image"><img src="<?=$arResult['OPERATION_PROPS'][$v]['IMG']?>" /></div>
                                <div class="text">
                                    <?=$arResult['OPERATION_PROPS'][$v]['NAME']?> <i><?=$arItem['PROPERTIES']['OPERATION_PROPS_VAL']['VALUE'][$key]?></i>
                                </div>
                            </div>
                        <?
                        endforeach; ?>
                    </div>
                </div>
            <?
            endforeach; ?>

            <div class="all">
                <a href="/foto-rabot/" class="arrow">Все работы</a>
            </div>
        </div>

        <?
        if (!empty($arResult['SECOND_BLOCK'])): ?>
            <?=$arResult['SECOND_BLOCK']?>
            <div class="line"></div>
        <?
        endif; ?>

    </div>
    <?
    $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.free-consult', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
</section>
