<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/poleznoe/dovolnye-patsienty/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/poleznoe/dovolnye-patsienty/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#",
		"RULE" => "componentName=\$1",
		"ID" => "",
		"PATH" => "/bitrix/services/mobileapp/jn.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/poleznoe/spetsproekty/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/poleznoe/spetsproekty/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/poleznoe/intervyu/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/poleznoe/intervyu/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/poleznoe/novosti/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/poleznoe/novosti/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/poleznoe/sovety/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/poleznoe/sovety/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/poleznoe/video/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/poleznoe/video/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/poleznoe/blog/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/poleznoe/blog/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/foto-rabot/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/foto-rabot/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/aktsii/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/aktsii/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/rest/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/rest/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/uslugi/([a-zA-Z\\-\\_0-9]+)/([a-zA-Z\\-\\_0-9]+)/review/([0-9]+)?\\/(\\?[^\\/]*)?\$#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2&PAGE_TAB=review&REVIEW_ID=\$3&TMP=\$4",
		"ID" => "",
		"PATH" => "/uslugi/index.php",
		"SORT" => "1000",
	),
	array(
		"CONDITION" => "#^/uslugi/([a-zA-Z\\-\\_0-9]+)/([a-zA-Z\\-\\_0-9]+)/([a-zA-Z0-9\\-\\_]+)?\\/?(\\?[^\\/]*)?\$#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2&PAGE_TAB=\$3&TMP=\$4",
		"ID" => "",
		"PATH" => "/uslugi/index.php",
		"SORT" => "1100",
	),
	array(
		"CONDITION" => "#^/konsultatsii/([a-zA-Z\\-\\_0-9]+)/(\\?[^\\/]*)?\$#",
		"RULE" => "SECTION_CODE=\$1&TMP=\$2",
		"ID" => "",
		"PATH" => "/konsultatsii/section.php",
		"SORT" => "2000",
	),
	array(
		"CONDITION" => "#^/konsultatsii/([a-zA-Z\\-\\_0-9]+)/([0-9]+)/(\\?[^\\/]*)?\$#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_ID=\$2&TMP=\$3",
		"ID" => "",
		"PATH" => "/konsultatsii/detail.php",
		"SORT" => "2100",
	),
	array(
		"CONDITION" => "#^/konsultatsii/([a-zA-Z\\-\\_0-9]+)/([a-zA-Z\\-\\_0-9]+)/([0-9]+)/(\\?[^\\/]*)?\$#",
		"RULE" => "SECTION_CODE=\$1&TAG_CODE=\$2&ELEMENT_ID=\$3&TMP=\$4",
		"ID" => "",
		"PATH" => "/konsultatsii/detail.php",
		"SORT" => "2200",
	),
	array(
		"CONDITION" => "#^/konsultatsii/([a-zA-Z\\-\\_0-9]+)/([a-zA-Z\\-\\_0-9]+)/(\\?[^\\/]*)?\$#",
		"RULE" => "SECTION_CODE=\$1&TAG_CODE=\$2&TMP=\$3",
		"ID" => "",
		"PATH" => "/konsultatsii/tag.php",
		"SORT" => "2300",
	),
);
?>