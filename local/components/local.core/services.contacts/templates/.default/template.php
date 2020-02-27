<?
/**
 * @var array                     $arParams
 * @var array                     $arResult
 * @var ServicesContactsComponent $component
 * @var CBitrixComponentTemplate  $this
 * @var string                    $templateName
 * @var string                    $componentPath
 * @var string                    $templateFolder
 * @global CMain                  $APPLICATION
 */
?>
<section id="body" class="container">
    <div class="content inner contacts">
        <div class="row row-f">
            <div class="col-xs-12 col-md-6">
                <div class="title-preview"><?=$arResult['FB_TITLE']?></div>
                <h2><?=$arResult['FB_HEADER']?></h2>
                <div class="social">
                    <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:contacts.socialnet', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 contacts__item">
                <p>
                    <strong>Адрес</strong><br /><? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-address.php', false, ['MODE' => 'text']) ?>
                </p>
                <p>
                    <strong>Телефон</strong><br /><? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-phones.php', false, ['MODE' => 'text']) ?>
                </p>
                <p>
                    <strong>Режим работы</strong><br /><? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-work-time.php', false, ['MODE' => 'text']) ?>
                </p>
                <p>
                    <strong>Маркетинг и PR</strong><br /><? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-emails.php', false, ['MODE' => 'text']) ?>
                </p>
            </div>
        </div>
        <? if (!empty($arResult['PHOTO'])): ?>
            <div class="gallerySlider post-up">
                <div class="title-preview">Фотогалерея</div>
                <div class="gallery-container">
                    <div class="gallery js-slider-photo">
                        <? foreach ($arResult['PHOTO'] as $src): ?>
                            <div class="slide">
                                <a href="javascript:void(0)"><img src="<?=$src?>" /></a>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
        <? endif; ?>
        <div class="title-preview">Расположение</div>
        <div class="map">
            <? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-map.php', false, ['MODE' => 'html']) ?>
        </div>
        <? if (!empty($arResult['SECOND_BLOCK'])): ?>
            <div class="content">
                <?=$arResult['SECOND_BLOCK']?>
            </div>
            <div class="line"></div>
        <? endif; ?>
    </div>
</section>
