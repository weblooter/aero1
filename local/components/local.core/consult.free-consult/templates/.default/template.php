<?
/**
 * @var array                       $arParams
 * @var array                       $arResult
 * @var ConsultFreeConsultComponent $component
 * @var CBitrixComponentTemplate    $this
 * @var string                      $templateName
 * @var string                      $componentPath
 * @var string                      $templateFolder
 * @global CMain                    $APPLICATION
 */
?>
<div id="callbackForm">
    <div class="close fright js-close-callback-form "></div>
    <div class="form">
        <div class="h1-title">Консультация</div>
        <div class="h1">Бесплатная консультация</div>
        <p>
            <?$GLOBALS['APPLICATION']->IncludeFile('include/consult-free-consult.php', false, ['MODE' => 'text'])?>
        </p>
        <form>
            <div class="row">
                <div class="formField col-xs-12 col-sm-6">
                    <input type="text" placeholder="Ваше имя*"/>
                </div>
                <div class="formField col-xs-12 col-sm-6">
                    <input type="text" placeholder="Номер телефона*"/>
                </div>
                <div class="formField col-xs-12">
                    <textarea placeholder="Комментарий"></textarea>
                </div>
                <div class="formbutton col-xs-12">
                    <button class="btn">Отправить</button>
                </div>
            </div>
        </form>
        <div class="after-text">Спасибо за обращение!<br/>Мы скоро свяжемся с вами.</div>

    </div>
</div>
<div class="shadow"></div>
