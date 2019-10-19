<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
?>

    <section id="body" class="container">
        <nav class="navigator"><a href="">Главная</a><span>-</span>404 ошибка</nav>
        <div class="h1-title">404 ошибка</div>
        <h1>Страница не найдена</h1>
        <div class="content">
            <div class="row row-f">
                <div class="col-xs-12 col-md-6">
                    <div class="title-preview">OOPS...</div>
                    <h2>H2 - Кажется что-то пошло не так - такой страницы нет (:</h2>
                    <p>Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах</p>
                    <ol class="sitemap">
                        <li><a href="/">Главная</a></li>
                        <li><a href="/akcii.html">АКЦИИ</a></li>
                        <li><a href="/about.html">О ХИРУРГЕ</a></li>
                        <li><a href="/news.html">НОВОСТИ</a></li>
                    </ol>
                </div>
                <div class="col-xs-12 col-md-6">
                    <p class="center"><img src="/img/404.jpg" alt="" /></p>
                </div>
            </div>
        </div>
        <div class="line"></div>
    </section>
    <section class="consultation container post-up">
        <div class="title-preview">Консультация у хирурга</div>
        <div class="row row-f">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text">
                <div class="h2">Задайте свой вопрос онлайн или запишитесь на бесплатную консультацию</div>
                <div class="more"><a href="" class="arrow">Задать вопрос онлайн</a></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2 form">
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

    </section>
    <div class="mobile-bar">
        <a href="tel:+74951234567" class="mobile-bar__item" title="Позвонить в клинику">
            <img src="/img/svg/foot-phone.svg" width="20" height="20" alt="" />
            Позвонить
        </a>
        <a href="/" class="mobile-bar__item" title="Специальные предложения">
            <img src="/img/svg/percent.svg" width="20" height="20" alt="" />
            Акции
        </a>
        <a href="whatsapp://send?phone=+74951234567" class="mobile-bar__item" title="Написать в WhatsApp">
            <img src="/img/svg/whatsup.svg" width="20" height="20" alt="" />
            WhatsApp
        </a>
        <a href="viber://chat?number=74951234567" class="mobile-bar__item" title="Написать в Viber">
            <img src="/img/svg/viber.svg" width="20" height="20" alt="" />
            Viber
        </a>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>