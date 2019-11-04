<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$obRequest = \Bitrix\Main\Application::getInstance()
    ->getContext()
    ->getRequest();
?>
<!DOCTYPE html>
<html>
<head>
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <? $APPLICATION->ShowHead(); ?>


    <link rel="icon" href="/img/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="format-detection" content="address=no" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i&subset=latin-ext" rel="stylesheet" />
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/_bundle.css" />

    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/LocalCore.js"></script>
    <script type="text/javascript">
        LocalCore._reg._sessid = '<?=bitrix_sessid()?>';
    </script>

</head>
<body class="<?=(defined('MAIN_PAGE') ? 'main' : 'inner')?>">
<div id="panel">
    <? $APPLICATION->ShowPanel(); ?>
</div>
<?if($_SERVER['PHP_SELF'] === '/index.php'):?>
    <div class="loaderArea" id="preloader" style="display:none" data-one-time-only="true"><!-- DEBUG ONLY, switch to "true" on prod -->
        <div class="loader">
            <p>Пластический хирург</p>
            <div class="title">Ведров Олег Вячеславович</div>
        </div>
    </div>
<?endif;?>

<div id="outer">
    <header class="header">
        <div class="header__inner">
            <div class="container">
                <div class="logo">
                    <a href="/">
                        <img src="/img/logo.png" alt="Ведров Олег Вячеславович" />
                    </a>
                </div>
                <div class="phone">
                    <a href="tel:+<?=preg_replace('/[^\d]/', '', tplvar('phone'))?>"><?=tplvar('phone')?></a>
                    <span class="name">Ведров Олег<br /> Вячеславович</span>
                    <div class="awards">
                        <a href="/o-doktore/">
                            <i class="ico ico-award"></i>
                            <span>Все награды хирурга</span>
                        </a>
                    </div>
                </div>
                <span id="nav_dropdown"><span></span></span>
                <div class="menuTop">
                    <? $APPLICATION->IncludeComponent("bitrix:menu", "top-menu", Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "2",
                        "MENU_CACHE_GET_VARS" => array(
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "N",
                    ),
                        false
                    ); ?>
                </div>

            </div>
        </div>
        <div class="shadow"></div>
        <?
        if( $obRequest->getRequestedPageDirectory() == '/kontakty' )
        {
            $APPLICATION->ShowViewContent("contacts_header");
        }
        elseif( preg_match('/^\/uslugi\//', $obRequest->getRequestedPageDirectory()) === 1 )
        {
            $APPLICATION->ShowViewContent("services_header");
        }
        elseif( $_SERVER['PHP_SELF'] === '/index.php' )
        {
            $APPLICATION->IncludeComponent('local.core:main.slide', '.default', [], false, ['HIDE_ICONS' => 'Y']);
        }
        ?>
    </header>
    <? if (!defined('DISABLE_BREADCRUMBS')): ?>
        <div class="container">
            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb", Array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0",
            ),
                false
            ); ?>
        </div>
    <? endif; ?>

    <? if (preg_match('/^\/poleznoe($|\/)/', \Bitrix\Main\Application::getInstance()
        ->getContext()
        ->getRequest()
        ->getRequestedPageDirectory()) === 1): ?>
    <section id="body" class="container">
        <div class="submenu">
            <? $APPLICATION->IncludeComponent("bitrix:menu", "poleznoe-menu", Array(
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
                "ROOT_MENU_TYPE" => "left",
                "USE_EXT" => "N",
            ),
                false
            ); ?>
        </div>
        <div class="mobile-nav">
            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb", Array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0",
            ),
                false
            ); ?>
        </div>
        <? endif; ?>
	
						