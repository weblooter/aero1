<?php

if (!empty($arResult['SECTION']['SEO']['SECTION_META_TITLE'])) {
    $GLOBALS['APPLICATION']->SetTitle($arResult['SECTION']['SEO']['SECTION_META_TITLE']);
    $GLOBALS['APPLICATION']->SetPageProperty('title', $arResult['SECTION']['SEO']['SECTION_META_TITLE']);
}
if (!empty($arResult['SECTION']['SEO']['SECTION_META_KEYWORDS'])) {
    $GLOBALS['APPLICATION']->SetPageProperty('keywords', $arResult['SECTION']['SEO']['SECTION_META_KEYWORDS']);
}
if (!empty($arResult['SECTION']['SEO']['SECTION_META_DESCRIPTION'])) {
    $GLOBALS['APPLICATION']->SetPageProperty('description', $arResult['SECTION']['SEO']['SECTION_META_DESCRIPTION']);
}