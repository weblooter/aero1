<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>

    <section class="contacts container content post-up">
        <div class="row row-f">
            <div class="col-xs-12 col-md-6">
                <div class="title-preview">Текст о хирурге напишем позже</div>
                <h2>Центр пластической хирургии</h2>
                <div class="social">
                    <a href="" class="yb">Youtube</a>
                    <a href="" class="vk">Vkontakte</a>
                    <a href="" class="inst">Instagram</a>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 contacts__item">
                <p>
                    <strong>Адрес</strong><br />г.Москве, ул.название улица длинное, д.25, стр.7, м.Тушино
                </p>
                <p>
                    <strong>Телефон</strong><br />+7 (916) 123-45-67<br />+7 (495) 123-45-67
                </p>
                <p>
                    <strong>Режим работы</strong><br />
                    пн.-пт. с 9:00 до 20.00<br />сб. с 10.00 до 16.00<br />вс. выходной
                </p>
                <p>
                    <strong>Маркетинг и PR</strong><br /><a href="mailto:marketing@dr-vedrov.ru">marketing@dr-vedrov.ru</a><br /><a href="mailto:info@dr-vedrov.ru">info@dr-vedrov.ru</a>
                </p>
            </div>
        </div>
        <div class="map">
            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A28023725f7af0e3b4c05dc2d58615221e743a50a389fe562319a74acd4203918&amp;source=constructor" width="100%" height="520" frameborder="0"></iframe>
        </div>
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