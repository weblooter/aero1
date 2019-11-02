<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var ServicesReviewComponent  $component
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

        <div class="reviewList row row-f">
            <? foreach ($arResult['ITEMS'] as $arItem): ?>
                <div class="col-xs-12 col-md-6">
                    <div class="reviewList__item">
                        <div class="title-preview">Отзыв</div>
                        <div class="review__author"><?=$arItem['PROPERTIES']['REVIEW_NAME']['VALUE']?></div>
                        <div class="reviewList__item__text">
                            <div class="text"><?=$arItem['PROPERTIES']['REVIEW_TEXT']['VALUE']['TEXT']?></div>
                            <? if (!empty($arItem['PROPERTIES']['PHOTOS']['VALUE'])): ?>
                                <div class="review__photos">
                                    <? foreach ($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $strImg): ?>
                                        <div class="review__photos__item"><img src="<?=$strImg?>" /></div>
                                    <? endforeach; ?>
                                </div>
                            <? endif; ?>
                        </div>
                        <div class="readmore"><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="arrow">Подробнее</a></div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>

        <? if (!empty($arResult['SECOND_BLOCK'])): ?>
            <?=$arResult['SECOND_BLOCK']?>
            <div class="line"></div>
        <? endif; ?>

    </div>
    <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.free-consult', '.default', [], false, ['HIDE_ICON' => 'Y']) ?>
</section>
