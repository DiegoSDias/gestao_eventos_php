<?php

namespace App\Core;

use PDO;

class Database {

    private static $instancia;
    
    public static function getConnection() {
        if(!self::$instancia) {
            try {
                $dsn = 'mysql:dbname='. DB_DATABASE . ';host=' . DB_HOST . ';charset=utf8';
                $user = DB_USERNAME;
                $password = DB_PASSWORD;

                $dbh = new PDO($dsn, $user, $password);

                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                self::$instancia = $dbh;

            } catch (\PDOException $pd) {
                echo 'Erro de conexão ao banco de dados: '. $pd->getMessage();
                return;
            }
        }

        return self::$instancia;
    }
}