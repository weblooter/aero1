<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var MainNewsComponent        $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */
?>
<? if (!empty($arResult['ITEMS'])): ?>
    <section class="news container ">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-6 news__text post-right">
                <div class="title-preview"><? $APPLICATION->IncludeFile('include/main-news-title.php', false, ['MODE' => 'text']) ?></div>
                <div class="h2"><? $APPLICATION->IncludeFile('include/main-news-fio.php', false, ['MODE' => 'text']) ?></div>
                <div class="more"><a href="/poleznoe/novosti/" class="arrow">Больше новостей</a></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 news__slider post-left">
                <div class="news__slider__container">
                    <div class="newsSlider js-slider-news">
                        <? foreach ($arResult['ITEMS'] as $arItem): ?>
                            <div class="slide">
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news__item">
                                    <span class="title"><?=$arItem['NAME']?></span>
                                    <span class="arrow">Подробнее</span>
                                    <span class="image" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']?>);"></span>
                                </a>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? endif; ?>