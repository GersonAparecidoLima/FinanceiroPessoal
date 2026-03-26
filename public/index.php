<?php
require_once __DIR__ . '/../app/Database/Connection.php';
require_once __DIR__ . '/../app/Models/Lancamento.php';

use App\Models\Lancamento;

// --- LÓGICA DE INSERÇÃO ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Lancamento::save($_POST);
    header("Location: index.php"); // Recarrega para limpar o formulário e mostrar o novo dado
    exit;
}

$lancamentos = Lancamento::all();
include __DIR__ . '/../app/Views/lancamentos.php';