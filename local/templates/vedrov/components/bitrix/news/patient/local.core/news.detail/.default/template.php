<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="content">
    <div class="h1-title"><?=$GLOBALS['APPLICATION']->GetPageProperty('pre-h1')?></div>
    <h1><?=$arResult['NAME']?></h1>
    <div class="col2 post-up">
        <?=$arResult['DETAIL_TEXT']?>
    </div>
    <? if (!empty($arResult['PROPERTIES']['OPERATION_PROPS']['VALUE'])): ?>
        <div class="descripsion row row-f">
            <? foreach ($arResult['PROPERTIES']['OPERATION_PROPS']['VALUE'] as $key => $arItem): ?>
                <div class="col-xs-12 col-md-4 descripsion__item">
                    <div class="image"><img src="<?=$arItem['IMG']?>" /></div>
                    <div class="text">
                        <?=$arItem['NAME']?> <i><?=$arResult['PROPERTIES']['OPERATION_PROPS_VAL']['VALUE'][$key]?></i>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    <? endif; ?>
    <? if (!empty($arResult['PROPERTIES']['PHOTOS']['VALUE'])): ?>
        <div class="gallerySlider galleryPatients post-up">
            <div class="gallery-container">
                <div class="gallery js-slider-photo">
                    <? foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $strImg): ?>
                        <div class="slide gallery__item">
                            <img src="<?=$strImg?>" />
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    <? endif; ?>
    <div class="reviews">
        <div class="reviews__item post-up">
            <div class="title-preview"><?=$arResult['PROPERTIES']['REVIEW_TITLE']['VALUE']?></div>
            <?=$arResult['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT']?>
            <div class="right"><?=$arResult['PROPERTIES']['REVIEW_NAME']['VALUE']?></div>
        </div>
        <div class="back">
            <? if ($arResult['PREV']): ?>
                <a href="<?=$arResult['PREV']?>" class="prev arrow">Предыдущий пациент</a>
            <? endif; ?>
            <? if ($arResult['NEXT']): ?>
                <a href="<?=$arResult['NEXT']?>" class="next arrow">Следующий пациент</a>
            <? endif; ?>
        </div>
    </div>
</div>



