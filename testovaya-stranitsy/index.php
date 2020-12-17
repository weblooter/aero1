<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовая страницы");
$APPLICATION->SetPageProperty("pre-h1", "pre h1");
$APPLICATION->SetPageProperty("h1", "H1");
?><section id="body" class="container">
<div class="h1-title">
	<?=$APPLICATION->GetPageProperty('pre-h1')?>
</div>
<h1><?=$APPLICATION->GetPageProperty('h1')?></h1>
<div class="content">
	 Текст страницы
</div>
 </section><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>