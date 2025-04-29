<?php

namespace backend\db\config;

require_once dirname(dirname(dirname(__FILE__))) . '\env.php';

use PDO;
use PDOException;

class Connection
{
    public static function Connect()
    {
        if (!isset(self::$db)) {
            try {
                $conn = new PDO('sqlite:' . dirname(dirname(__FILE__)) . '\database.sqlite');
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $conn;
            } catch (PDOException $e) {
                die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
            }
        }
    }
}
