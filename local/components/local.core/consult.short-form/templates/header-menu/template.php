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
<div class="text col-xs-12 col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
    <div class="h3">Консультация онлайн</div>
    <p>Вы можете задать свой вопрос онлай и хирург в течение 3 дней ответит на него.</p>
    <div class="more"><a href="/konsultatsii/" class="arrow">Задать вопрос онлайн</a></div>
</div>
<div class="form col-xs-12 col-sm-6 col-md-5 col-lg-4">
    <form action="" id="consult-short-form-header-menu" name="consult-short-form-header-menu">
        <div class="formField">
            <input type="text" name="NAME" required placeholder="Ваше имя*" />
        </div>
        <div class="formField">
            <input type="text" name="PHONE" required placeholder="Номер телефона*" />
        </div>
        <button class="btn" type="submit">Перезвоните мне</button>
    </form>
</div>