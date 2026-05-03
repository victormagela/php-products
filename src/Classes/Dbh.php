<?php

class Dbh {
    static private ?PDO $db = null;

    public static function getConnection(): PDO {
        if (self::$db === null) {
            try {
                self::$db = new PDO('sqlite:../products.db');

                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            }
            catch (PDOException $e) {
                // throw new Exception("Erro ao se conectar com o banco de dados.");
                throw $e;
            }

        }

        return self::$db;

    }

}