<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__); 

try {
	$arComponentParameters = [
		'GROUPS' => [
		],
		'PARAMETERS' => [
			'SHOW_NAV' => [
				'PARENT' => 'BASE',
				'NAME' => Loc::getMessage('USERS_LIST_PARAMETERS_SHOW_NAV'),
				'TYPE' => 'CHECKBOX',
				'DEFAULT' => 'N'
			],
			'COUNT' =>  [
				'PARENT' => 'BASE',
				'NAME' => Loc::getMessage('USERS_LIST_PARAMETERS_COUNT'),
				'TYPE' => 'STRING',
				'DEFAULT' => '0'
			]
		]
	];
}
catch (Main\LoaderException $e) {
	ShowError($e->getMessage());
}
?>