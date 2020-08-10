<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?$APPLICATION->ShowMeta("robots")?>
<?$APPLICATION->ShowMeta("keywords")?>
<?$APPLICATION->ShowMeta("description")?>
<title><?$APPLICATION->ShowTitle()?></title>
<?$APPLICATION->ShowHead();?>
</head>
<body>
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
    <div class="container" style="padding: 40px;">
        <h1>Тестовое задание</h1>
        <h2>Backend разработчик в <span style="color: #ff7326;">Articul Media</span></h2>
        <details>
            <summary>Описание задания</summary>
            <p>
                Реализовать компонент с применением технологий ядра D7, который выводит список зарегистрированных пользователей с постраничной навигацией. Выборка должна кешироваться. Постраничная навигация должна осуществляться Ajax-ом. Сделать возможность выгрузки пользователей в csv и xml формат.
                Исходники выложить в публичный репозиторий bitbucket или github.
                <br><br>
                <b>Прогнозируемое время:</b> 6 часов <br>
                <b>Затраченное время:</b> 4.5 часа
            </p>
        </details>

        <h2>Результат выполнения:</h2>