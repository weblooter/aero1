<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<ul>
    <? foreach ($arResult as $arItem): ?>
        <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
    <? endforeach ?>
    <li><span class="address js-open-geo-form">Москва</span></li>
</ul>