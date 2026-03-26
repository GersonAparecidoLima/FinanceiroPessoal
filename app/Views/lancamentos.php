<?php



// 2. USANDO OS NAMESPACES
use App\Models\Lancamento;

// 3. CHAMADA DO MÉTODO
try {
    $lancamentos = Lancamento::all();
} catch (Exception $e) {
    die("Erro ao carregar dados: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Financeiro MVC - PHP OO</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f4f9; padding: 40px; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #007bff; color: white; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f1f1f1; }
        .badge { padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .entrada { background: #d4edda; color: #155724; }
        .saida { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
<div class="container">
    <h1>Novo Lançamento</h1>
    <form method="POST" style="background: #eee; padding: 20px; border-radius: 8px; margin-bottom: 20px; display: flex; gap: 15px; align-items: flex-end;">
        <div>
            <label>Descrição</label><br>
            <input type="text" name="descricao" required style="padding: 8px;">
        </div>
        <div>
            <label>Valor</label><br>
            <input type="number" step="0.01" name="valor" required style="padding: 8px;">
        </div>
        <div>
            <label>Tipo</label><br>
            <select name="tipo" style="padding: 8px;">
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
            </select>
        </div>
        <div>
            <label>Data</label><br>
            <input type="date" name="data_lancamento" value="<?= date('Y-m-d') ?>" required style="padding: 8px;">
        </div>
        <button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
            SALVAR
        </button>
    </form>

    <hr>
    <h1>Fluxo de Caixa - Padrão MVC</h1>
    
    <?php if (empty($lancamentos)): ?>
        <p style="text-align:center; color:#666; padding:20px;">
            Nenhum lançamento encontrado. <br>
            <small>Dica: Use o HeidiSQL para inserir o primeiro registro!</small>
        </p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lancamentos as $l): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($l->data_lancamento)) ?></td>
                    <td><?= $l->descricao ?></td>
                    <td><span class="badge <?= $l->tipo ?>"><?= strtoupper($l->tipo) ?></span></td>
                    <td>R$ <?= number_format($l->valor, 2, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>