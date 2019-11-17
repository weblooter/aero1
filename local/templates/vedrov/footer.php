<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<? if (
    preg_match('/^\/poleznoe($|\/)/', \Bitrix\Main\Application::getInstance()
        ->getContext()
        ->getRequest()
        ->getRequestedPageDirectory()) === 1
): ?>
    </section>
<? endif; ?>
<? $APPLICATION->IncludeComponent('local.core:consult.short-form', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
<footer class="footer post-up">
    <div class="container">
        <div class="footer__logos">
            <? $APPLICATION->IncludeComponent('local.core:footer.review-slider', '.default', []) ?>
        </div>
        <div class="footer__contacts row row-f">
            <div class="footer__contacts__item col-xs-12 col-sm-6">
                <div class="ico ico-phone"></div>
                <div class="footer__contacts__item__text">
                    <span class="title">Телефон</span>
                    <a href="tel:+<?=preg_replace('/[^\d]/', '', tplvar('phone'))?>"><?=tplvar('phone')?></a>
                </div>
            </div>
            <div class="footer__contacts__item col-xs-12 col-sm-6">
                <div class="ico ico-mail"></div>
                <div class="footer__contacts__item__text">
                    <span class="title">Почта</span>
                    <a href="mailto:<?=tplvar('email')?>"><?=tplvar('email')?></a>
                </div>
            </div>
        </div>
        <div class="row footer__menu">
            <? $APPLICATION->IncludeComponent("bitrix:menu", "bottom-menu-4", Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => array(
                    0 => "",
                ),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "bottom41",
                "USE_EXT" => "N",
                'INCLUDE_AREA' => 'footer-service-menu-1'
            ),
                false
            ); ?>
            <? $APPLICATION->IncludeComponent("bitrix:menu", "bottom-menu-4", Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => array(
                    0 => "",
                ),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "bottom42",
                "USE_EXT" => "N",
                'INCLUDE_AREA' => 'footer-service-menu-2'
            ),
                false
            ); ?>
            <? $APPLICATION->IncludeComponent("bitrix:menu", "bottom-menu-4", Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => array(
                    0 => "",
                ),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "bottom43",
                "USE_EXT" => "N",
                'INCLUDE_AREA' => 'footer-service-menu-3'
            ),
                false
            ); ?>
            <? $APPLICATION->IncludeComponent("bitrix:menu", "bottom-menu-4", Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => array(
                    0 => "",
                ),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "bottom44",
                "USE_EXT" => "N",
                'INCLUDE_AREA' => 'footer-service-menu-4'
            ),
                false
            ); ?>

            <div class="col-xs-12 col-md-9">
                <? $APPLICATION->IncludeComponent("bitrix:menu", "bottom-menu-3", Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(
                        0 => "",
                    ),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "bottom1",
                    "USE_EXT" => "N",
                ),
                    false
                ); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <?
                $GLOBALS['APPLICATION']->IncludeComponent('local.core:footer.socialnet', '.default', [], false, ['HIDE_ICONS' => 'Y'])
                ?>
            </div>

        </div>


        <div class="row row-f footer__bottom">
            <div class="col-xs-12 col-sm-5 col-md-5 copyright">
                <? $APPLICATION->IncludeFile('include/footer-copy.php'); ?>
            </div>
            <div class="col-xs-3 col-sm-2 col-md-2 logo">
                <a href="/"><img src="/img/logo-wht.png" alt="" /></a>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-3 col-md-offset-2 links">
                <? $APPLICATION->IncludeComponent("bitrix:menu", "bottom-menu-2", Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(
                        0 => "",
                    ),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "bottom2",
                    "USE_EXT" => "N",
                ),
                    false
                ); ?>
            </div>
        </div>
    </div>
</footer>


<div id="text" class="mfp-text mfp-hide">
    <? $APPLICATION->IncludeFile('include/footer-license.php', false, ['MODE' => 'html']) ?>
</div>

<div id="toTop"></div>
<div class="mobile-bar">
    <a href="tel:+<?=preg_replace('/[^\d]/', '', tplvar('phone'))?>" class="mobile-bar__item" title="Позвонить в клинику">
        <img src="/img/svg/foot-phone.svg" width="20" height="20" alt="" />
        Позвонить
    </a>
    <a href="/aktsii/" class="mobile-bar__item" title="Специальные предложения">
        <img src="/img/svg/percent.svg" width="20" height="20" alt="" />
        Акции
    </a>
    <a href="<?=tplvar('watsapp_link')?>" class="mobile-bar__item" title="Написать в WhatsApp">
        <img src="/img/svg/whatsup.svg" width="20" height="20" alt="" />
        WhatsApp
    </a>
    <a href="<?=tplvar('viber_link')?>" class="mobile-bar__item" title="Написать в Viber">
        <img src="/img/svg/viber.svg" width="20" height="20" alt="" />
        Viber
    </a>
</div>

<script src="<?=SITE_TEMPLATE_PATH?>/assets/js/_bundle.js"></script>
<script type="text/javascript">
    var $ = jQuery = myApp.$;
</script>

<?
\Local\Core\Page::getInstance()
    ->footerInit();
?>
<? if ($_SERVER['PHP_SELF'] === '/index.php'): ?>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/preloader.js"></script>
<? endif; ?>
<? include $_SERVER['DOCUMENT_ROOT'].'/.footer-inc.text'; ?>
</body>
</html>