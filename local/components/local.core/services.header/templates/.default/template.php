<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var ServicesHeaderComponent  $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */
?>
<?
$this->SetViewTarget('services_header');
?>
<section class="sliderTop contacts" style="background-image:url(/img/contacts.jpg);">
    <div class="submenu">
        <ul class="submenu__item">
            <? foreach ($arResult['MENU'] as $arItem): ?>
                <li class="<?=$arItem['ACTIVE'] ? 'act' : ''?>"><a href="<?=$arItem['LINK']?>"><?=$arItem['NAME']?></a></li>
            <? endforeach ?>
        </ul>
    </div>
    <div class="container post-down">

        <div class="text">
            <div class="h1-title"><?=$arResult['MENU_ACTIVE']['PRE_H1']?></div>
            <div class="h1"><?=$arResult['MENU_ACTIVE']['H1']?></div>
            <p><?=$arResult['MENU_ACTIVE']['AFTER_H1']?></p>
        </div>

        <?if( $arResult['ACTIVE_TYPE'] === 'contacts' ):?>
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
        <?endif;?>

    </div>
</section>
<?
$this->EndViewTarget();
?>
