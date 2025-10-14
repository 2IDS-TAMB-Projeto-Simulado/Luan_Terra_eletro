<?php
require_once "./../controller/controller_doce.php";

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
        <title>Editar Doce - Gestão de Doce</title>
        <link rel="stylesheet" href="../CSS/editar.css">
    </head>
    <body>
        <h1>Editar Doce</h1>
        
        <form action="" method="POST">
            <div class="editing-indicator">
                📝 Editando: <?php echo htmlspecialchars($doce_editar["MARCA"] . " - " . $doce_editar["TIPO"]); ?>
            </div>

            <div class="form-group">
                <label for="formato">Formato:</label>
                <input type="text" id="formato" name="formato" value="<?php echo htmlspecialchars($doce_editar['FORMATO']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tamanho">Tamanho:</label>
                <input type="text" id="tamanho" name="tamanho" value="<?php echo htmlspecialchars($doce_editar['TAMANHO']); ?>" required>
            </div>

            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" value="<?php echo htmlspecialchars($doce_editar['MARCA']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" id="tipo" name="tipo" value="<?php echo htmlspecialchars($doce_editar['TIPO']); ?>" required>
            </div>

            <div class="form-group">
                <label for="data_validade">Data de Validade:</label>
                <input type="date" id="data_validade" name="data_validade" value="<?php echo htmlspecialchars($doce_editar['DATA_VALIDADE']); ?>" required>
            </div>

            <input type="submit" id="editar_doce" name="editar_doce" value="Salvar Alterações">
        </form>
        
        <a href="inicial.php">
            <button>Voltar</button>
        </a>
    </body>
</html>