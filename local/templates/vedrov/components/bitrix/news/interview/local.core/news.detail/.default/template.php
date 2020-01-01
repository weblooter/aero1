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

    <div class="row">
        <div class="text col-xs-12 col-sm-9">
            <?=$arResult['PROPERTIES']['START_TEXT']['~VALUE']['TEXT']?>
        </div>
        <div class="col-xs-12 col-sm-3 interview__source">
            <a href="<?=$arResult['PROPERTIES']['START_LOGO_LINK']['VALUE']?>"
               target="_blank"
               rel="nofollow">
                <img src="<?=$arResult['PROPERTIES']['START_LOGO_FILE']['VALUE']?>" />
            </a>
        </div>
    </div>
    <div class="interview">
        <div class="interview__text">
            <? foreach ($arResult['PROPERTIES']['FAQ_TEXT']['VALUE'] as $key => $arFaq): ?>
                <h3><?=$arResult['PROPERTIES']['FAQ_TEXT']['DESCRIPTION'][$key]?></h3>
                <?=$arFaq['TEXT']?>
            <? endforeach; ?>
        </div>
        <div class="author">
            <div class="image"><a href="/o-doktore/"><img src="<?=$arResult['PROPERTIES']['FAQ_USER_PHOTO']['VALUE']?>" /></a></div>
            <div class="title"><a href="/o-doktore/">Ведров Олег Вячеславович <span><?=$arResult['PROPERTIES']['FAQ_USER_EPILOG']['VALUE']?></span></a></div>
        </div>
    </div>
    <div class="text">
        <?=$arResult['DETAIL_TEXT']?>
    </div>

    <div class="back">
        <? if ($arResult['PREV']): ?>
            <a href="<?=$arResult['PREV']?>" class="prev arrow">Предыдущее интервью</a>
        <? endif; ?>
        <? if ($arResult['NEXT']): ?>
            <a href="<?=$arResult['NEXT']?>" class="next arrow">Следующее интервью</a>
        <? endif; ?>
    </div>
</div>