<?
/**
 * @var array                     $arParams
 * @var array                     $arResult
 * @var ConsultShortFormComponent $component
 * @var CBitrixComponentTemplate  $this
 * @var string                    $templateName
 * @var string                    $componentPath
 * @var string                    $templateFolder
 * @global CMain                  $APPLICATION
 */
?>
<section class="consultation container post-up">
    <div class="title-preview">Консультация у хирурга</div>
    <div class="row row-f">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text">
            <div class="h2">Задайте свой вопрос онлайн или запишитесь на бесплатную консультацию</div>
            <div class="more"><a href="/konsultatsii/" class="arrow">Задать вопрос онлайн</a></div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2 form">
            <form action="" id="consult-short-form" name="consult-short-form">
                <div class="formField">
                    <input type="text" name="NAME" placeholder="Ваше имя*" required />
                </div>
                <div class="formField">
                    <input type="text" name="PHONE" placeholder="Номер телефона*" required />
                </div>
                <button class="btn" type="submit">Перезвоните мне</button>
            </form>
        </div>
    </div>
</section>
