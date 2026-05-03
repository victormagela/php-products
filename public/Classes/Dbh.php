<?php

class Dbh {
    static private ?PDO $db = null;

    public static function getConnection(): PDO {
        if (self::$db === null) {
            try {
                self::$db = new PDO('sqlite:../products.db');

                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                self::$db->exec("
                    CREATE TABLE IF NOT EXISTS products(
                    product_id INTEGER NOT NULL PRIMARYKEY AUTOINCREMENT,
                    name TEXT NOT NULL,
                    unit_price REAL NOT NULL,
                    qty INTEGER NOT NULL
                    );
                ");

            }
            catch (PDOException) {
                throw new Exception("Erro ao se conectar com o banco de dados.");

            }

        }

        return self::$db;

    }

}