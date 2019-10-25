<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<ul class="submenu__item">
    <? foreach ($arResult as $arItem): ?>
        <li class="<?=$arItem['SELECTED'] ? 'act' : ''?>">
            <a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
        </li>
    <? endforeach; ?>
</ul>
