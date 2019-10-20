<?
/**
 * @var array                       $arParams
 * @var array                       $arResult
 * @var ConsultFormSendAskComponent $component
 * @var CBitrixComponentTemplate    $this
 * @var string                      $templateName
 * @var string                      $componentPath
 * @var string                      $templateFolder
 * @global CMain                    $APPLICATION
 */
?>
<div class="consult-form content">
    <form id="form-send-ask" name="form-send-ask">
        <div class="row row-f">
            <div class="col-xs-12 col-md-4">
                <div class="row">
                    <div class="formField col-xs-12 col-sm-4 col-md-12">
                        <input type="text" placeholder="Ваше имя*" name="NAME" />
                    </div>
                    <div class="formField col-xs-12 col-sm-4 col-md-12">
                        <input type="email" placeholder="Ваша почта*" id="mail" name="EMAIL" required />
                        <span class="placeholder">(для отправки ответа, не публикуется на сайте)</span>
                    </div>
                    <div class="formField col-xs-12 col-sm-4 col-md-12">
                        <?if( $arParams['SECTION_ID'] > 0 ):?>
                            <input type="hidden" name="CATEGORY_ID" value="<?=$arParams['SECTION_ID']?>" />
                        <?else:?>
                            <select required name="CATEGORY_ID">
                                <option selected disabled value="">Выберите раздел *</option>
                                <? foreach ($arResult['SELECT_OPTIONS'] as $arItem): ?>
                                    <option value="<?=$arItem['ID']?>"><?=$arItem['NAME']?></option>
                                <? endforeach; ?>
                            </select>
                        <?endif;?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                <div class="row">
                    <div class="formField col-xs-12">
                        <textarea placeholder="Ваш вопрос*" name="MSG" required></textarea>
                    </div>
                    <div class="formField file col-xs-12 col-sm-6">
                        <input type="file" name="ATTACHMENT" />
                        <span class="placeholder">(только для доктора)</span>
                    </div>
                    <div class="formField file col-xs-12 col-sm-6">
                        <button class="btn" type="submit">Отправить вопрос</button>
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