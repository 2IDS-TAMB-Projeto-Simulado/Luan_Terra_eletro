<?php
session_start();

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
        <title>Cadastro de Eletrodomésticos - Gestão de Eletrodomésticos</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <h1>Cadastro de Eletrodomésticos</h1>
        
        <form action="./../controller/controller_eletrodomestico.php" method="POST">
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" placeholder="Marca..." required>
            </div>

            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <input type="text" id="categoria" name="categoria" placeholder="Categoria..." required>
            </div>

            <div class="form-group">
                <label for="fornecedor">Fornecedor:</label>
                <input type="text" id="fornecedor" name="fornecedor" placeholder="Fornecedor..." required>
            </div>

            <div class="form-group">
                <label for="potencia">Potência:</label>
                <input type="text" id="potencia" name="potencia" placeholder="Potência..." required>
            </div>

            <div class="form-group">
                <label for="consumo">Consumo:</label>
                <input type="text" id="consumo" name="consumo" placeholder="Consumo..." required>
            </div>

            <div class="form-group">
                <label for="garantia">Data de Garantia:</label>
                <input type="date" id="garantia" name="garantia" required>
            </div>

            <div class="form-group">
                <label for="prioridade_reposicao">Prioridade de Reposição:</label>
                <select id="prioridade_reposicao" name="prioridade_reposicao" required>
                    <option value="">Selecione...</option>
                    <option value="Alta">Alta</option>
                    <option value="Média">Média</option>
                    <option value="Baixa">Baixa</option>
                </select>
            </div>

            <input type="submit" id="cadastrar_eletrodomestico" name="cadastrar_eletrodomestico" value="Cadastrar">
        </form>
        
        <a href="inicial.php">
            <button>Voltar</button>
        </a>
    </body>
</html>