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
        <title>Cadastro de Doces - Gestão de Doce</title>
        <link rel="stylesheet" href="../CSS/cadastro.css">
    </head>
    <body>
        <h1>Cadastro de Doces</h1>
        
        <form action="./../controller/controller_doce.php" method="POST">
            <div class="form-group">
                <label for="formato">Formato:</label>
                <input type="text" id="formato" name="formato" placeholder="Formato..." required>
            </div>

            <div class="form-group">
                <label for="tamanho">Tamanho:</label>
                <input type="text" id="tamanho" name="tamanho" placeholder="Tamanho..." required>
            </div>

            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" placeholder="Marca..." required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" id="tipo" name="tipo" placeholder="Tipo..." required>
            </div>

            <div class="form-group">
                <label for="data_validade">Data de Validade:</label>
                <input type="date" id="data_validade" name="data_validade" required>
            </div>

            <input type="submit" id="cadastrar_doce" name="cadastrar_doce" value="Cadastrar">
        </form>
        
        <a href="inicial.php">
            <button>Voltar</button>
        </a>
    </body>
</html>