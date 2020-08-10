<?
$arJsConfig = array(
    'articul_main' => array(
        'js' => '/local/templates/articul/js/main.js',
        'rel' => array(),
    )
);

foreach ($arJsConfig as $ext => $arExt) {
    \CJSCore::RegisterExt($ext, $arExt);
}
?>