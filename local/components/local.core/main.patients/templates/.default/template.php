<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var MainPatientsComponent    $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */

?>
<?
if (!empty($arResult['ITEMS'])): ?>
    <section class="infoMedia container post-up">
        <div class="row row-f reviews">
            <div class="col-xs-12 col-sm-6 reviews__text post-left">
                <div class="title-preview"><?
                    $APPLICATION->IncludeFile('include/main-patients-title.php', false, ['MODE' => 'text']) ?></div>
                <div class="h2"><?
                    $APPLICATION->IncludeFile('include/main-patients-h2.php', false, ['MODE' => 'text']) ?></div>
                <div class="more"><a href="/poleznoe/dovolnye-patsienty/" class="arrow">Больше пациентов</a></div>
            </div>
            <div class="col-xs-12 col-sm-6 reviews__gallery post-right">
                <div class="reviews__gallery__container">
                    <div class="sliderGallery js-slider-gallery">
                        <?
                        foreach ($arResult['ITEMS'] as $arItem): ?>
                            <div class="slide reviews__gallery__item">
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"
                                   style="background-image: url(<?=$arItem['PREVIEW_PICTURE']?>);"><span class="arrow">Подробнее</span></a>
                            </div>
                        <?
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-6 infoMedia__item post-left">
                <div class="title-preview"><?
                    $APPLICATION->IncludeFile('include/main-patients-col1-title.php', false, ['MODE' => 'text']) ?></div>
                <p><?
                    $APPLICATION->IncludeFile('include/main-patients-col1-text.php', false, ['MODE' => 'text']) ?></p>
                <div class="more"><a href="/foto-rabot/" class="arrow">Смотреть фото</a></div>
            </div>
            <div class="col-xs-12 col-md-6 infoMedia__item post-right">
                <div class="title-preview"><?
                    $APPLICATION->IncludeFile('include/main-patients-col2-title.php', false, ['MODE' => 'text']) ?></div>
                <p><?
                    $APPLICATION->IncludeFile('include/main-patients-col2-text.php', false, ['MODE' => 'text']) ?></p>
                <div class="more"><a href="/poleznoe/video/" class="arrow">Смотреть видео</a></div>
            </div>
        </div>
    </section>
<?
endif; ?>