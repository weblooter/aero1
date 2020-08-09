<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var MainSlideComponent       $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */

?>
<section class="sliderTop">
    <div class="js-slider-video">
        <?
        foreach ($arResult['ITEMS'] as $arItem): ?>
            <div class="slide">
                <div class="text">
                    <div class="container">
                        <div class="title"><?=$arItem['NAME']?></div>
                        <p><?=$arItem['PREVIEW_TEXT']?></p>
                        <?
                        if (!empty($arItem['LINK'])): ?>
                            <div class="more"><a href="<?=$arItem['LINK']?>" class="btn arrow"><?=$arItem['LINK_TEXT']?></a></div>
                        <?
                        endif; ?>
                    </div>
                </div>
            </div>
        <?
        endforeach; ?>
    </div>
    <div class="sliderTop__nav">
        <div class="container">
            <div class="slider-video-menu js-slider-video-nav">
                <?
                foreach ($arResult['ITEMS'] as $k => $arItem): ?>
                    <div class="slide">
                        <span><?=($k < 9) ? '0'.($k + 1) : ($k + 1)?></span>
                        <span><?=(!empty($arItem['SLIDE_NAME'])) ? $arItem['SLIDE_NAME'] : $arItem['NAME']?></span>
                    </div>
                <?
                endforeach; ?>
            </div>
            <div class="video-indicator js-slider-video-indicator">
                <?
                foreach ($arResult['ITEMS'] as $k => $arItem): ?>
                    <div class="slide"></div>
                <?
                endforeach; ?>
            </div>
        </div>
    </div>
    <div class="video-inslider js-video" style="background-image:url(/img/main-page/bg.jpg);">
        <video loop="loop" preload="preload" muted="muted" style="min-width:100vw;min-height:100%;">
            <source src="/img/main-page/main-video.webm" type="video/webm" />
            <source src="/img/main-page/main-video.mp4" type="video/mp4" />
        </video>
    </div>
</section>
