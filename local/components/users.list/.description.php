<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
    "NAME" => Loc::getMessage('USERS_LIST_DESCRIPTION_NAME'),
    "DESCRIPTION" => Loc::getMessage('USERS_LIST_DESCRIPTION_DESCRIPTION'),
);

?>