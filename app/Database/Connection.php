<?php
namespace App\Database;

use PDO;
use PDOException;

class Connection {
    private static $instance;

    public static function get() {
        if (!isset(self::$instance)) {
            try {
                // Ajustado para o banco 'financas_pessoal' que criamos no HeidiSQL
                self::$instance = new PDO("mysql:host=localhost;dbname=financas_pessoal", "root", "");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Se der erro aqui, ele vai parar a execução e te mostrar o porquê
                die("Erro na conexão PDO: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}