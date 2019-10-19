<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var AboutGalleryComponent    $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */
?>
<? if (!empty($arResult)): ?>
    <div class="gallerySlider post-up">
        <div class="title-preview">Фотогалерея</div>
        <div class="gallery-container">
            <div class="gallery js-slider-photo">
                <? foreach ($arResult as $src): ?>
                    <div class="slide">
                        <img src="<?=$src?>" />
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
<? endif; ?>