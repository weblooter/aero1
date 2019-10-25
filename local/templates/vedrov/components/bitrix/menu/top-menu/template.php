<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<? foreach ($arResult as $arBatch): ?>
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
                                <li>
                                    <a href="" class="title">Грудь</a>
                                    <ul>
                                        <li><a href="">Увеличение груди</a></li>
                                        <li><a href="">Уменьшение груди</a></li>
                                        <li><a href="">Подтяжка груди</a></li>
                                        <li><a href="">Увеличение груди с подтяжкой</a></li>
                                        <li><a href="">Липофилинг груди </a></li>
                                        <li><a href="">Реконструкция груди имплантом</a></li>
                                        <li><a href="">Реконструкция груди экспандером</a></li>
                                        <li><a href="">Реконструкция груди ТРАМ/Diep - лоскутом</a></li>
                                        <li><a href="">Реконструкция соска</a></li>
                                        <li><a href="">Коррекция втянутых сосков</a></li>
                                        <li><a href="">Коррекция гинекомастии</a></li>
                                        <li><a href="">Удаление фиброаденом </a></li>
                                        <li><a href="">Удаление добавочных долек молочных желёз</a></li>
                                        <li><a href="">Подкожная мастэктомия+реконструкция</a></li>
                                        <li><a href="">Радикальная мастэктомия</a></li>
                                        <li><a href="">Онкопластическая резекция молочной железы</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="" class="title">Тело</a>
                                    <ul>
                                        <li><a href="">Абдоминопластика</a></li>
                                        <li><a href="">Миниабдоминопластика</a></li>
                                        <li><a href="">Подтяжка рук</a></li>
                                        <li><a href="">Подтяжка ног</a></li>
                                        <li><a href="">Подтяжка тела после массивного похудения</a></li>
                                        <li><a href="">Липофилинг ягодиц</a></li>
                                        <li><a href="">Интимная пластика (Мпг)</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="" class="title">Лицо</a>
                                    <ul>
                                        <li><a href="">Верхняя блефаропластика</a></li>
                                        <li><a href="">Нижняя блефаропластика</a></li>
                                        <li><a href="">Отопластика</a></li>
                                        <li><a href="">Удаление комков Биша</a></li>
                                        <li><a href="">Липофилинг губ (носогубных складок)</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="" class="title">Липо</a>
                                    <ul>
                                        <li><a href="">VASER-липосакция</a></li>
                                        <li><a href="">Липосакция лица</a></li>
                                        <li><a href="">Липосакция бедер</a></li>
                                        <li><a href="">Липосакция коленей</a></li>
                                        <li><a href="">Липосакция рук</a></li>
                                        <li><a href="">Липосакция боков</a></li>
                                        <li><a href="">Липосакция живота</a></li>
                                        <li><a href="">Липосакция у мужчин</a></li>
                                        <li><a href="">Липосакция подбородка</a></li>
                                        <li><a href="">Липосакция ягодиц</a></li>
                                        <li><a href="">Липосакция ног</a></li>
                                        <li><a href="">Липосакция щек</a></li>
                                        <li><a href="">Липосакция галифе</a></li>
                                    </ul>
                                </li>
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
                                <?endforeach; ?>
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
