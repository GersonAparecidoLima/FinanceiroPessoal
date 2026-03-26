<?php
require_once __DIR__ . '/../app/Database/Connection.php';
require_once __DIR__ . '/../app/Models/Lancamento.php';

use App\Models;
use App\Models\Lancamento;

// --- LÓGICA DE AÇÕES (C do MVC) ---

// 1. Excluir
if (isset($_GET['excluir'])) {
    Lancamento::delete($_GET['excluir']);
    header("Location: index.php");
    exit;
}

// 2. Salvar ou Atualizar (via POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        Lancamento::update($_POST['id'], $_POST);
    } else {
        Lancamento::save($_POST);
    }
    header("Location: index.php");
    exit;
}

// 3. Buscar dados para edição (se houver)
$editando = null;
if (isset($_GET['editar'])) {
    $editando = Lancamento::find($_GET['editar']);
}

// 4. Listagem geral
$lancamentos = Lancamento::all();

// CHAMA A VIEW
include __DIR__ . '/../app/Views/lancamentos.php';