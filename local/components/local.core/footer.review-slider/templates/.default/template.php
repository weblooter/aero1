<?
/**
 * @var array                       $arParams
 * @var array                       $arResult
 * @var FooterReviewSliderComponent $component
 * @var CBitrixComponentTemplate    $this
 * @var string                      $templateName
 * @var string                      $componentPath
 * @var string                      $templateFolder
 * @global CMain                    $APPLICATION
 */
?>
<div class="h3">Отзывы о хирурге в интернете</div>
<div class="sliderLogos js-slider-logos str_wrap">
    <? foreach ($arResult['ITEMS'] as $arItem): ?>
        <a href="<?=$arItem['PROPERTY_LINK_VALUE']?>"><img src="<?=$arItem['PREVIEW_PICTURE']?>" /></a>
    <? endforeach; ?>
</div>
