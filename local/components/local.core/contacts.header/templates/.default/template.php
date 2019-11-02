<?
/**
 * @var array                   $arParams
 * @var array                   $arResult
 * @var EmptyComponent          $component
 * @var ContactsHeaderComponent $this
 * @var string                  $templateName
 * @var string                  $componentPath
 * @var string                  $templateFolder
 * @global CMain                $APPLICATION
 */
?>
<? $this->SetViewTarget("contacts_header", 100); ?>
    <section class="sliderTop contacts" style="background-image:url(/img/contacts.jpg);">

        <div class="container post-down">

            <div class="text">
                <div class="h1-title"><?=$APPLICATION->GetPageProperty('pre-h1')?></div>
                <div class="h1"><?=$APPLICATION->GetPageProperty('h1')?></div>
                <p>
                    <? $APPLICATION->IncludeFile('include/contacts-header-address.php', false, ['MODE' => 'text']) ?>
                </p>
            </div>

            <div class="header__contacts row row-f">
                <div class="header__contacts__item col-xs-12 col-sm-6">
                    <div class="ico ico-phone"></div>
                    <div class="header__contacts__item__text">
                        <span class="title">Телефон</span>
                        <a href="tel:+<?=preg_replace('/[^\d]/', '', tplvar('phone'))?>"><?=tplvar('phone')?></a>
                    </div>
                </div>
                <div class="header__contacts__item col-xs-12 col-sm-6">
                    <div class="ico ico-mail"></div>
                    <div class="header__contacts__item__text">
                        <span class="title">Почта</span>
                        <a href="mailto:<?=tplvar('phone')?>"><?=tplvar('email')?></a>
                    </div>
                </div>
            </div>

        </div>
    </section>
<? $this->EndViewTarget(); ?>