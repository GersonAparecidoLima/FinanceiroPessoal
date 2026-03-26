<?php
namespace App\Models;

// ESTA LINHA É A CHAVE: Ela traz o arquivo físico para dentro da classe
require_once __DIR__ . '/../Database/Connection.php';

use App\Database\Connection;
use PDO;

class Lancamento {
    
    public static function all() {
        // Agora o PHP "enxerga" a classe Connection no disco
        $db = Connection::get(); 
        $stmt = $db->query("SELECT * FROM lancamentos ORDER BY data_lancamento DESC");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public static function save($dados) {
    $db = Connection::get();
    $sql = "INSERT INTO lancamentos (descricao, valor, tipo, data_lancamento) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        $dados['descricao'],
        $dados['valor'],
        $dados['tipo'],
        $dados['data_lancamento']
    ]);
  



    }

}