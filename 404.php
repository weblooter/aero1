<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Страница не найдена!");
$APPLICATION->AddChainItem('404 Страница не найдена!');
?>

    <section id="body" class="container">
        <div class="h1-title">404 ошибка</div>
        <h1>Страница не найдена</h1>
        <div class="content">
            <div class="row row-f">
                <div class="col-xs-12 col-md-6">
                    <div class="title-preview"><? $APPLICATION->IncludeFile('include/404-title.php', false, ['MODE' => 'text'])?></div>
                    <h2><? $APPLICATION->IncludeFile('include/404-header.php', false, ['MODE' => 'text'])?></h2>
                    <? $APPLICATION->IncludeFile('include/404-text.php', false, ['MODE' => 'html'])?>
                    <? $APPLICATION->IncludeComponent("bitrix:main.map", "sitemap", Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "SET_TITLE" => "Y",
                        "LEVEL" => "3",
                        "COL_NUM" => "1",
                        "SHOW_DESCRIPTION" => "N",
                    ),
                        false,
                        ['HIDE_ICONS' => 'Y']
                    ); ?>
                </div>
                <div class="col-xs-12 col-md-6">
                    <p class="center"><img src="/img/404.jpg" alt="" /></p>
                </div>
            </div>
        </div>
        <div class="line"></div>
    </section>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>