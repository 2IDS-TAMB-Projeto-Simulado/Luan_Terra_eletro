<?php
require_once "./../controller/controller_eletrodomestico.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Eletrodoméstico - Gestão de Eletrodomésticos</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <h1>Editar Eletrodoméstico</h1>
        
        <form action="" method="POST">
            <div class="editing-indicator">
                📝 Editando: <?php echo htmlspecialchars($eletro_editar["MARCA"] . " - " . $eletro_editar["CATEGORIA"]); ?>
            </div>

            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" value="<?php echo htmlspecialchars($eletro_editar['MARCA']); ?>" required>
            </div>

            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($eletro_editar['CATEGORIA']); ?>" required>
            </div>

            <div class="form-group">
                <label for="fornecedor">Fornecedor:</label>
                <input type="text" id="fornecedor" name="fornecedor" value="<?php echo htmlspecialchars($eletro_editar['FORNECEDOR']); ?>" required>
            </div>

            <div class="form-group">
                <label for="potencia">Potência:</label>
                <input type="text" id="potencia" name="potencia" value="<?php echo htmlspecialchars($eletro_editar['POTENCIA']); ?>" required>
            </div>

            <div class="form-group">
                <label for="consumo">Consumo:</label>
                <input type="text" id="consumo" name="consumo" value="<?php echo htmlspecialchars($eletro_editar['CONSUMO']); ?>" required>
            </div>

            <div class="form-group">
                <label for="garantia">Data de Garantia:</label>
                <input type="date" id="garantia" name="garantia" value="<?php echo htmlspecialchars($eletro_editar['GARANTIA']); ?>" required>
            </div>

            <div class="form-group">
                <label for="prioridade_reposicao">Prioridade de Reposição:</label>
                <select id="prioridade_reposicao" name="prioridade_reposicao" required>
                    <option value="Alta" <?php echo ($eletro_editar['PRIORIDADE_REPOSICAO'] == 'Alta') ? 'selected' : ''; ?>>Alta</option>
                    <option value="Média" <?php echo ($eletro_editar['PRIORIDADE_REPOSICAO'] == 'Média') ? 'selected' : ''; ?>>Média</option>
                    <option value="Baixa" <?php echo ($eletro_editar['PRIORIDADE_REPOSICAO'] == 'Baixa') ? 'selected' : ''; ?>>Baixa</option>
                </select>
            </div>

            <input type="hidden" name="eletro_id" value="<?php echo $eletro_editar['ELETRO_ID']; ?>">
            <input type="submit" id="editar_eletrodomestico" name="editar_eletrodomestico" value="Salvar Alterações">
        </form>
        
        <a href="inicial.php">
            <button>Voltar</button>
        </a>
    </body>
</html>