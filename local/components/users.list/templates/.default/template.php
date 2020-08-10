<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (array_key_exists("IS_AJAX", $_REQUEST) && $_REQUEST["IS_AJAX"] == "Y") {
    $APPLICATION->RestartBuffer();
}

use Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__);
?>

<ul>
    <? while ($user = $arResult['USERS']->fetch()): ?>
        <li>
            <?= $user['LOGIN'] . " (" . $user['EMAIL'] . ")"; ?>
        </li>
    <? endwhile; ?>
</ul>
<?= $arResult['NAV_STRING'];?>

<? $APPLICATION->IncludeComponent(
    "bitrix:main.pagenavigation",
    "articul",
    [
        "NAV_OBJECT" => $arResult['NAV'],
        "SEF_MODE" => "N",
    ],
    false
); ?>

<a class="js-export" data-type="csv" href="/local/storage/export/users.csv">Выгрузить пользователей в CSV</a>

<a class="js-export" data-type="xml" href="/local/storage/export/users.xml">Выгрузить пользователей в XML</a>

<? if (array_key_exists("IS_AJAX", $_REQUEST) && $_REQUEST["IS_AJAX"] == "Y") die(); ?>
