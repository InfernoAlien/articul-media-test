<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle(" "); ?>

<div class="js-users-list">
    <? $APPLICATION->IncludeComponent(
        "users.list",
        ".default",
        array(
            "SHOW_NAV" => "Y",
            "COUNT" => "3",
            "COMPONENT_TEMPLATE" => ".default"
        ),
        false
    );?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>