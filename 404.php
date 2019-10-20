<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
?>

    <section id="body" class="container">
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
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>