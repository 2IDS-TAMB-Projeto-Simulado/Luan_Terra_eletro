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
        <title>Página Inicial - Gestão de Eletrodomésticos</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="content-container">
            <h1>Página Inicial</h1>
            <h2>Gestão de Eletrodomésticos</h2>
            <h3>Bem vindo, <?php echo htmlspecialchars($_SESSION['usuario']['NOME']); ?>!</h3>
            
            <div class="button-container">
                <a href="listar_eletrodomestico.php">
                    <button>Cadastrar Eletrodoméstico</button>
                </a>
                <a href="gestao_estoque.php">
                    <button>Gestão de Estoque</button>
                </a>
                <a href="login.php">
                    <button>Logout</button>
                </a>
            </div>
        </div>
    </body>
</html>