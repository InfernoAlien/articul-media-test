<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/csv_data.php");

use Bitrix\Main\Localization\Loc as Loc;
use Bitrix\Main\UI\PageNavigation;
use Bitrix\Main\UserTable;
use Bitrix\Main\XmlWriter;

class UserListComponent extends CBitrixComponent
{
    /**
     * подключает языковые файлы
     */
    public function onIncludeComponentLang()
    {
        $this->includeComponentLang(basename(__FILE__));
        Loc::loadMessages(__FILE__);
    }

    /**
     * Получает список пользователей c постраничной навигацией
     */
    protected function getUsersList()
    {
        $select = [
            'ID',
            'NAME',
            'LOGIN',
            'EMAIL',
        ];

        if ($this->arParams['SHOW_NAV'] === "Y") {
            $nav = new PageNavigation("nav-users");
            $nav->allowAllRecords(true)
                ->setPageSize($this->arParams['COUNT'])
                ->initFromUri();

            $rsUsers = UserTable::getList([
                "select" => $select,
                "count_total" => true,
                "offset" => $nav->getOffset(),
                "limit" => $nav->getLimit(),
                "cache" => ["ttl" => 60]
            ]);

            $nav->setRecordCount($rsUsers->getCount());
        } else {
            $rsUsers = $this->getUsers($select);
        }

        $this->arResult['NAV'] = $nav ? $nav : '';
        $this->arResult['USERS'] = $rsUsers;
    }

    /**
     * Создаёт CSV-файл со списком пользователей
     *
     * @return void
     */
    protected function setUsersCSV() {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/local/storage/export/' . 'users.csv';

        $fp = fopen($filePath, 'w+');
        fclose($fp);

        $csvFile = new CCSVData();

        $fields_type = 'R';
        $delimiter = ";";
        $csvFile->SetFieldsType($fields_type);
        $csvFile->SetDelimiter($delimiter);
        $csvFile->SetFirstHeader(true);

        $arrHeaderCSV = ["id", "login", "email"];

        $csvFile->SaveFile($filePath, $arrHeaderCSV);

        $rsUsers = $this->getUsers();

        while ($user = $rsUsers->fetch())
        {
            $csvFile->SaveFile($filePath, [$user["ID"], $user["LOGIN"], $user["EMAIL"]]);
        }
    }

    /**
     * Создаёт XML-файл со списком пользователей
     *
     * @return void
     */
    protected function setUsersXML() {
        $filePath = '/local/storage/export/' . 'users.xml';

        $export = new XmlWriter(array(
            'file' => $filePath,
            'create_file' => true,
            'charset' => SITE_CHARSET,
            'lowercase' => true
        ));

        $export->openFile();

        $export->writeBeginTag('users');

        $rsUsers = $this->getUsers();

        while ($user = $rsUsers->fetch())
        {
            $export->writeBeginTag('user');
            $export->writeFullTag('id', $user["ID"]);
            $export->writeFullTag('login', $user["LOGIN"]);
            $export->writeFullTag('email', $user["EMAIL"]);
            $export->writeEndTag('user');
        }

        $export->writeEndTag('users');

        $export->closeFile();
    }

    /**
     * Получает список пользователей
     *
     * @param array $select - набор возвращаемых полей
     * @throws
     *
     * @return \Bitrix\Main\ORM\Query\Result
     */
    protected function getUsers($select = ['*']) {
        return UserTable::getList([
            "select" => $select,
            "cache" => ["ttl" => 60]
        ]);
    }

    /**
     * выполняет логику работы компонента
     */
    public function executeComponent()
    {
        $this->getUsersList();

        if (array_key_exists("EXPORT_TYPE", $_REQUEST)) {
            if ($_REQUEST["EXPORT_TYPE"] === 'csv') {
                $this->setUsersCSV();
            } else if ($_REQUEST["EXPORT_TYPE"] === 'xml') {
                $this->setUsersXML();
            }
        }

        $this->includeComponentTemplate();
    }
}
?>