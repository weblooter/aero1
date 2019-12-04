<?
/**
 * @var array                         $arParams
 * @var array                         $arResult
 * @var ServicesReviewDetailComponent $component
 * @var CBitrixComponentTemplate      $this
 * @var string                        $templateName
 * @var string                        $componentPath
 * @var string                        $templateFolder
 * @global CMain                      $APPLICATION
 */
?>

<section id="body" class="container">


    <div class="content inner review">
        <div class="title-preview"><?=$arResult['ITEM']['PROPERTIES']['REVIEW_TITLE']['VALUE']?></div>
        <div class="text">
            <?=$arResult['ITEM']['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT']?>
        </div>
        <div class="row row-f">
            <div class="review__source col-xs-12 col-sm-6 col-md-3 col-md-offset-6">
                <?if(
                    (int)$arResult['ITEM']['PROPERTIES']['EXTERNAL_REVIEW_LOGO']['VALUE'] > 0
                    && !empty( trim($arResult['ITEM']['PROPERTIES']['EXTERNAL_REVIEW_LINK']['VALUE'])  )
                ):?>
                    <a href="<?=trim($arResult['ITEM']['PROPERTIES']['EXTERNAL_REVIEW_LINK']['VALUE'])?>" target="_blank" rel="nofollow"><img src="<?=\CFile::GetPath($arResult['ITEM']['PROPERTIES']['EXTERNAL_REVIEW_LOGO']['VALUE'])?>" /></a>
                <?else:?>
                &nbsp;
                <?endif;?>
            </div>
            <div class="review__author col-xs-12 col-sm-6 col-md-3">
                <?=$arResult['ITEM']['PROPERTIES']['REVIEW_NAME']['VALUE']?>
            </div>
        </div>

        <? if (!empty($arResult['ITEM']['PROPERTIES']['PHOTOS']['VALUE'])): ?>
            <div class="gallerySlider post-up">
                <div class="title-preview">Фото пациента</div>
                <div class="gallery-container">
                    <div class="gallery js-slider-photo">
                        <? foreach ($arResult['ITEM']['PROPERTIES']['PHOTOS']['VALUE'] as $strImg): ?>
                            <div class="slide gallery__item">
                                <a href="<?=$strImg?>"><img src="<?=$strImg?>" /></a>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
        <? endif; ?>


        <div class="more">
            <a href="<?=$arResult['ABOUT_OPERATION']?>" class="arrow">Об операции</a>
            <span class="arrow js-open-callback-form">Бесплатная консультация</span>
            <? if (!empty($arResult['ITEM']['PROPERTIES']['REVIEW_LINK']['VALUE'])): ?>
                <a href="<?=$arResult['ITEM']['PROPERTIES']['REVIEW_LINK']['VALUE']?>" class="arrow"><?=( !empty( trim( $arResult['ITEM']['PROPERTIES']['INNER_LINK_TEXT']['VALUE'] ) ) ? $arResult['ITEM']['PROPERTIES']['INNER_LINK_TEXT']['VALUE'] : 'Подробная история' )?></a>
            <? endif; ?>
        </div>

        <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:services.form-review', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
        <div class="line"></div>
    </div>

    <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.free-consult', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
</section>
