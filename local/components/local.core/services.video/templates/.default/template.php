<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var ServicesVideoComponent   $component
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

        <div class="videoList row row-f">
            <?
            foreach ($arResult['ITEMS'] as $strVideoHtml): ?>
                <div class="col-xs-12 col-sm-6">
                    <?=$strVideoHtml?>
                </div>
            <?
            endforeach; ?>
        </div>

        <?
        if (!empty($arResult['SECOND_BLOCK'])): ?>
            <?=$arResult['SECOND_BLOCK']?>
            <div class="line"></div>
        <?
        endif; ?>

    </div>
    <?
    $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.free-consult', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
</section>
