<?
$arUrlRewrite = array(
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
		"CONDITION" => "#^/poleznoe/novosti/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/poleznoe/novosti/index.php",
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
		"CONDITION" => "#^/konsultatsii/([a-zA-Z\\-\\_0-9]+)/(\\?[^\\/]*)?\$#",
		"RULE" => "SECTION_CODE=\$1&TMP=\$2",
		"ID" => "",
		"PATH" => "/konsultatsii/section.php",
		"SORT" => "1000",
	),
	array(
		"CONDITION" => "#^/konsultatsii/([a-zA-Z\\-\\_0-9]+)/([0-9]+)/(\\?[^\\/]*)?\$#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_ID=\$2&TMP=\$3",
		"ID" => "",
		"PATH" => "/konsultatsii/detail.php",
		"SORT" => "1100",
	),
	array(
		"CONDITION" => "#^/konsultatsii/([a-zA-Z\\-\\_0-9]+)/([a-zA-Z\\-\\_0-9]+)/([0-9]+)/(\\?[^\\/]*)?\$#",
		"RULE" => "SECTION_CODE=\$1&TAG_CODE=\$2&ELEMENT_ID=\$3&TMP=\$4",
		"ID" => "",
		"PATH" => "/konsultatsii/detail.php",
		"SORT" => "1200",
	),
	array(
		"CONDITION" => "#^/konsultatsii/([a-zA-Z\\-\\_0-9]+)/([a-zA-Z\\-\\_0-9]+)/(\\?[^\\/]*)?\$#",
		"RULE" => "SECTION_CODE=\$1&TAG_CODE=\$2&TMP=\$3",
		"ID" => "",
		"PATH" => "/konsultatsii/tag.php",
		"SORT" => "1300",
	),
);
?>