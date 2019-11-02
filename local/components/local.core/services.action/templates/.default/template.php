<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var ServicesActionComponent  $component
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

        <div class="content">
            <div class="articles fadeup">
                <? foreach ($arResult['ITEMS'] as $arItem): ?>
                    <article class="articles__item">
                        <div class="image">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arItem['PREVIEW_PICTURE']?>" /></a>
                        </div>
                        <div class="text">
                            <h2><?=$arItem['NAME']?></h2>
                            <div class="desc">
                                <?=$arItem['PREVIEW_TEXT']?>
                            </div>
                            <div class="more"><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="arrow">Подробнее</a></div>
                        </div>
                    </article>
                <? endforeach; ?>
            </div>
        </div>

        <?=$arResult['SECOND_BLOCK']?>
        <div class="line"></div>

    </div>
    <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.free-consult', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
</section>
