<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<div class="col-xs-6 col-md-3">
    <div class="footer__title">
        <?$GLOBALS['APPLICATION']->IncludeFile('include/'.$arParams['INCLUDE_AREA'].'.php', false, ['MODE' => 'html'])?>
    </div>
    <ul>
        <? foreach ($arResult as $arItem): ?>
            <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
        <? endforeach ?>
    </ul>
</div>