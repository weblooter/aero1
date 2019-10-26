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
    <div class="text">
        <?=$arResult['DETAIL_TEXT']?>
    </div>

    <div class="back">
        <? if ($arResult['PREV']): ?>
            <a href="<?=$arResult['PREV']?>" class="prev arrow">Предыдущий совет</a>
        <? endif; ?>
        <? if ($arResult['NEXT']): ?>
            <a href="<?=$arResult['NEXT']?>" class="next arrow">Следующий совет</a>
        <? endif; ?>
    </div>
</div>