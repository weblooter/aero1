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
                                <li><a href="">Спецпроекты</a></li>
                                <li><a href="">Советы</a></li>
                                <li><a href="">Истории пациентов</a></li>
                                <li><a href="">Видео</a></li>
                                <li><a href="">Довольные пациенты</a></li>
                                <li><a href="">Блог</a></li>
                                <li><a href="">Новости</a></li>
                            </ul>
                        </div>
                        <?
                        break;

                    case '/konsultatsii/':
                        ?>
                        <a href="">Консультации</a>
                        <div class="submenu">
                            <div class="submenu__item row row-f">
                                <div class="text col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
                                    <div class="h3">Консультация онлайн</div>
                                    <p>Вы можете задать свой вопрос онлай и хирург в течение 3 дней ответит на него.</p>
                                    <div class="more"><a href="" class="arrow">Задать вопрос онлайн</a></div>
                                </div>
                                <div class="form col-xs-12 col-sm-6 col-md-5 col-lg-4">
                                    <form>
                                        <div class="formField">
                                            <input type="text" placeholder="Ваше имя*" />
                                        </div>
                                        <div class="formField">
                                            <input type="text" placeholder="Номер телефона*" />
                                        </div>
                                        <button class="btn">Перезвоните мне</button>
                                    </form>
                                </div>
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
