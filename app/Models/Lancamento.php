<?php
namespace App\Models;

require_once __DIR__ . '/../Database/Connection.php';

use App\Database\Connection;
use PDO;

class Lancamento {
    
    public static function all() {
        $db = Connection::get();
        $stmt = $db->query("SELECT * FROM lancamentos ORDER BY data_lancamento DESC");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find($id) {
        $db = Connection::get();
        $stmt = $db->prepare("SELECT * FROM lancamentos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function save($dados) {
        $db = Connection::get();
        $sql = "INSERT INTO lancamentos (descricao, valor, tipo, data_lancamento) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$dados['descricao'], $dados['valor'], $dados['tipo'], $dados['data_lancamento']]);
    }

    public static function update($id, $dados) {
        $db = Connection::get();
        $sql = "UPDATE lancamentos SET descricao = ?, valor = ?, tipo = ?, data_lancamento = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$dados['descricao'], $dados['valor'], $dados['tipo'], $dados['data_lancamento'], $id]);
    }

    public static function delete($id) {
        $db = Connection::get();
        $stmt = $db->prepare("DELETE FROM lancamentos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}