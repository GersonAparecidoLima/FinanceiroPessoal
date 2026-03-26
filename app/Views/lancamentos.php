<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Financeiro MVC - PHP OO</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f4f9; padding: 40px; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        .form-area { background: #eee; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #007bff; color: white; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        .badge { padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .entrada { background: #d4edda; color: #155724; }
        .saida { background: #f8d7da; color: #721c24; }
        .btn-edit { color: blue; text-decoration: none; margin-right: 10px; }
        .btn-del { color: red; text-decoration: none; }
    </style>
</head>
<body>
<div class="container">
    <div class="form-area">
        <h2><?= isset($editando) ? 'Editar Lançamento' : 'Novo Lançamento' ?></h2>
        <form method="POST" style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
            <input type="hidden" name="id" value="<?= $editando->id ?? '' ?>">
            
            <div>
                <label>Descrição</label><br>
                <input type="text" name="descricao" value="<?= $editando->descricao ?? '' ?>" required style="padding: 8px;">
            </div>
            <div>
                <label>Valor</label><br>
                <input type="number" step="0.01" name="valor" value="<?= $editando->valor ?? '' ?>" required style="padding: 8px;">
            </div>
            <div>
                <label>Tipo</label><br>
                <select name="tipo" style="padding: 8px;">
                    <option value="entrada" <?= (isset($editando) && $editando->tipo == 'entrada') ? 'selected' : '' ?>>Entrada</option>
                    <option value="saida" <?= (isset($editando) && $editando->tipo == 'saida') ? 'selected' : '' ?>>Saída</option>
                </select>
            </div>
            <div>
                <label>Data</label><br>
                <input type="date" name="data_lancamento" value="<?= $editando->data_lancamento ?? date('Y-m-d') ?>" required style="padding: 8px;">
            </div>
            <button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
                <?= isset($editando) ? 'ATUALIZAR' : 'SALVAR' ?>
            </button>
            <?php if ($editando): ?>
                <a href="index.php" style="color: #666; font-size: 13px;">Cancelar</a>
            <?php endif; ?>
        </form>
    </div>

    <h1>Fluxo de Caixa</h1>
    
    <?php if (empty($lancamentos)): ?>
        <p style="text-align:center; padding:20px;">Nenhum lançamento encontrado.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lancamentos as $l): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($l->data_lancamento)) ?></td>
                    <td><?= $l->descricao ?></td>
                    <td><span class="badge <?= $l->tipo ?>"><?= strtoupper($l->tipo) ?></span></td>
                    <td>R$ <?= number_format($l->valor, 2, ',', '.') ?></td>
                    <td>
                        <a href="?editar=<?= $l->id ?>" class="btn-edit">Editar</a>
                        <a href="?excluir=<?= $l->id ?>" class="btn-del" onclick="return confirm('Excluir?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>