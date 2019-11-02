<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<? foreach ($arResult['ITEMS'] as $arBatch): ?>
    <ul class="nav_menu">
        <? foreach ($arBatch as $arItem): ?>
            <li class="<?=$arItem['SELECTED'] ? 'act' : ''?>">
                <?
                switch ($arItem['LINK']) {
                    case '/uslugi/':
                        ?>
                        <span>Услуги</span>
                        <div class="submenu">
                            <ul class="submenu__item cols">
                                <?
                                foreach ($arResult['SERVICES'] as $arSection):?>
                                    <li>
                                        <a href="javascript:void(0)" class="title"><?=$arSection['NAME']?></a>
                                        <ul>
                                            <?
                                            foreach ($arSection['CHILD'] as $arItem):?>
                                                <li><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></li>
                                            <?endforeach; ?>
                                        </ul>
                                    </li>
                                <?endforeach; ?>
                            </ul>
                        </div>
                        <?
                        break;


                    case '/poleznoe/':
                        ?>
                        <span>Полезное</span>
                        <div class="submenu">
                            <ul class="submenu__item">
                                <?
                                foreach ($arItem['CHILDS'] as $arChild):?>
                                    <li class="<?=$arChild['SELECTED'] ? 'act' : ''?>"><a href="<?=$arChild['LINK']?>"><?=$arChild['TEXT']?></a></li>
                                <? endforeach; ?>
                            </ul>
                        </div>
                        <?
                        break;

                    case '/konsultatsii/':
                        ?>
                        <a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
                        <div class="submenu">
                            <div class="submenu__item row row-f">
                                <? $APPLICATION->IncludeComponent('local.core:consult.short-form', 'header-menu', [], false, ['HIDE_ICONS' => 'Y']) ?>
                            </div>
                        </div>
                        <?
                        break;

                    default:
                        ?>
                        <a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
                        <?
                        break;
                }
                ?>
            </li>
        <? endforeach; ?>
    </ul>
<? endforeach; ?>
