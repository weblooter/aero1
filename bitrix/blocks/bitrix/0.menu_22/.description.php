<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;

return array(
	'block' => array(
		// 'name' => Loc::getMessage('LANDING_BLOCK_MENU_22-NAME'),
		'section' => array('sidebar', 'menu'),
		'dynamic' => false,
		'subtype' => 'menu',
		'subtype_params' => array(
			'source' => 'catalog',
		),
		'version' => '19.0.300',	//and may be more
	),
	'cards' => array(
		'.landing-block-node-menu-item' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_MENU_22-LINK'),
			'label' => array('.landing-block-node-menu-link'),
		),
	),
	'nodes' => array(
		'.landing-block-node-menu-link' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_MENU_22-LINK'),
			'type' => 'link',
		),
	),
	'style' => array(
		'block' => array(
			'type' => ['block-default', 'block-border']
		),
		'nodes' => array(
			'.landing-block-node-menu-link' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_MENU_22-LINK'),
				'type' => ['typo-simple']
			),
			'.landing-block-node-navbar' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_MENU_22-NAVBAR'),
				'type' => ['navbar'],
			),
		),
	),
	'assets' => array(
		'ext' => array('landing_menu'),
	),
);