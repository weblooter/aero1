<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var ServicesIndexComponent   $component
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

        <? if (!empty($arResult['OPERATION_ICONS'])): ?>
            <div class="descripsion row row-f">
                <? foreach ($arResult['OPERATION_ICONS'] as $arItem): ?>
                    <div class="col-xs-12 col-md-4 descripsion__item">
                        <div class="image"><img src="<?=$arItem['IMG']?>" /></div>
                        <div class="text">
                            <?=$arItem['NAME']?> <i><?=$arItem['VALUE']?></i>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        <? endif; ?>

        <? if (!empty($arResult['PHOTOS_BEFORE_AFTER'])): ?>
            <div class="gallerySlider post-up">
                <div class="title-preview">ФОТО ДО/ПОСЛЕ</div>
                <div class="gallery-container">
                    <div class="gallery js-slider-photo">
                        <? foreach ($arResult['PHOTOS_BEFORE_AFTER'] as $src): ?>
                            <div class="slide gallery__item">
                                <a href="<?=$src?>"><img src="<?=$src?>" /></a>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
        <? endif; ?>

        <div class="more">
            <a href="<?=\Bitrix\Main\Application::getInstance()->getContext()->getRequest()->getRequestUri()?>photo/" class="arrow">СМОТРЕТЬ ВСЕ РАБОТЫ</a>
            <span class="arrow js-open-callback-form">Бесплатная консультация</span>
        </div>

        <? if (!empty($arResult['SECOND_BLOCK'])): ?>
            <?=$arResult['SECOND_BLOCK']?>
            <div class="line"></div>
        <? endif; ?>

    </div>
    <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.free-consult', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
</section>
