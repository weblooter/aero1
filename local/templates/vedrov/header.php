<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>
	<head>
        <title><?$APPLICATION->ShowTitle();?></title>
		<?$APPLICATION->ShowHead();?>


        <link rel="icon" href="/img/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="format-detection" content="telephone=no"/>
        <meta name="format-detection" content="address=no"/>
        <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i&subset=latin-ext" rel="stylesheet"/>
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/_bundle.css" />

    </head>
	<body class="inner">
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>

        <div id="outer">
            <header class="header">
                <div class="header__inner">
                    <div class="container">
                        <div class="logo">
                            <a href="">
                                <img src="img/logo.png" alt="Ведров Олег Вячеславович"/>
                            </a>
                        </div>
                        <div class="phone">
                            <a href="tel:+74951234567">+7 (495) 123-45-67</a>
                            <span class="name">Ведров Олег<br/> Вячеславович</span>
                            <div class="awards">
                                <a href="">
                                    <i class="ico ico-award"></i>
                                    <span>Все награды хирурга</span>
                                </a>
                            </div>
                        </div>
                        <span id="nav_dropdown"><span></span></span>
                        <div class="menuTop">
                            <ul class="nav_menu">
                                <li><a href="">О докторе</a></li>
                                <li><span>Услуги</span>
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
                                </li>
                                <li><a href="">Цены</a></li>
                                <li><a href="">Фото работ</a></li>
                            </ul>
                            <ul class="nav_menu">
                                <li class="act"><a href="">Акции</a></li>
                                <li><span>Полезное</span>
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
                                </li>
                                <li><a href="">Консультации</a>
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
                                                        <input type="text" placeholder="Ваше имя*"/>
                                                    </div>
                                                    <div class="formField">
                                                        <input type="text" placeholder="Номер телефона*"/>
                                                    </div>
                                                    <button class="btn">Перезвоните мне</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="">Контакты</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="shadow"></div>
            </header>
            <section id="body" class="container">
                <nav class="navigator"><a href="">Главная</a><span>-</span>Акции</nav>
                <div class="h1-title">Акции</div>
                <h1>Акции</h1>
                <div class="content">
                    <div class="articles fadeup">
                        <article class="articles__item">
                            <div class="image">
                                <a href=""><img src="img/ac01.jpg" alt=""/></a>
                            </div>
                            <div class="text">
                                <h2>50% на увеличение груди до конца месяца</h2>
                                <div class="desc">
                                    Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шLorem Ipsum используют потому, что тот обеспечива
                                </div>
                                <div class="more"><a href="" class="arrow">Подробнее</a></div>
                            </div>
                        </article>
                        <article class="articles__item">
                            <div class="image">
                                <a href=""><img src="img/ac02.jpg" alt=""/></a>
                            </div>
                            <div class="text">
                                <h2>Скидки в выходные</h2>
                                <div class="desc">
                                    Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шLorem Ipsum используют потому, что тот обеспечива
                                </div>
                                <div class="more"><a href="" class="arrow">Подробнее</a></div>
                            </div>
                        </article>
                        <article class="articles__item">
                            <div class="image">
                                <a href=""><img src="img/ac03.jpg" alt=""/></a>
                            </div>
                            <div class="text">
                                <h2>VASER-липосакция</h2>
                                <div class="desc">
                                    Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шLorem Ipsum используют потому, что тот обеспечива
                                </div>
                                <div class="more"><a href="" class="arrow">Подробнее</a></div>
                            </div>
                        </article>
                        <article class="articles__item">
                            <div class="image">
                                <a href=""><img src="img/ac04.jpg" alt=""/></a>
                            </div>
                            <div class="text">
                                <h2>Подтяжка бедер</h2>
                                <div class="desc">
                                    Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шLorem Ipsum используют потому, что тот обеспечива
                                </div>
                                <div class="more"><a href="" class="arrow">Подробнее</a></div>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
	
						