<?php

namespace Classes;

class DbConfig extends Database
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = 'root@48_';
    const DB_NAME = 'Dbhaidar';

    private static $db;

    /**
     * @return mixed
     */
    public static function getDb()
    {
        if (self::$db === null){
            self::$db = new Database(self::DB_NAME, self::DB_HOST, self::DB_USER, self::DB_PASS);
        }
        return self::$db;
    }

    /**
     * @return void
     * 404 Error
     */
    public static function notFound(){
        header("HTTP/1.0 404 Not Found");
        //$p = 'deconnexion';
        echo "<script></script><meta http-equiv='Refresh' CONTENT='0;URL=index.php'>";
    }

    /**
     * @return string
     * display when entity haven't data
     */
    public static function noRecordFound()
    {
        return "<p class='text-muted'>no record found</p>";
    }

    /**
     * @return mixed
     * get last insertion ID
     */
    public static function LastInsert()
    {
        return self::getDb()->LastInsertId();
    }

}
