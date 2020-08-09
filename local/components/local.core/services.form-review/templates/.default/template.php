<?
/**
 * @var array                       $arParams
 * @var array                       $arResult
 * @var ServicesFormReviewComponent $component
 * @var CBitrixComponentTemplate    $this
 * @var string                      $templateName
 * @var string                      $componentPath
 * @var string                      $templateFolder
 * @global CMain                    $APPLICATION
 */

?>

<div class="before-text center">
    <?
    $GLOBALS['APPLICATION']->IncludeFile('include/services-form-review.php', false, ['MODE' => 'HTML']) ?>
</div>
<div class="consult-form">
    <form action="" id="services-form-review" name="services-form-review">
        <div class="row row-f">
            <div class="col-xs-12 col-md-4">
                <div class="row">
                    <div class="formField col-xs-12 col-sm-6 col-md-12">
                        <input type="text" placeholder="Ваше имя*" name="NAME" required />
                    </div>
                    <div class="formField col-xs-12 col-sm-6 col-md-12">
                        <input type="email" placeholder="Ваша почта" id="mail" name="EMAIL" />
                        <span class="placeholder">(для отправки оповещения о публикации)</span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                <div class="row">
                    <div class="formField col-xs-12">
                        <textarea placeholder="Ваш отзыв*" name="MSG" required></textarea>
                    </div>
                    <div class="formField file col-xs-12 col-sm-6">
                        <input type="file" name="ATTACHMENT[]" multiple />
                        <span class="placeholder">(будет опубликовано для всех)</span>
                    </div>
                    <div class="formField file col-xs-12 col-sm-6">
                        <button class="btn" type="submit">Оставить отзыв</button>
                        <div class="right">
                            Нажимая на кнопку, вы принимаете условия<br />
                            <span class="link popup-modal textOpener" data-mfp-src="#text">пользовательcкого соглашения</span>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="after-text center content" data-ajax-result></div>
    </form>
</div>
