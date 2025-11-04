<?php
session_start();
// Não destrói a sessão aqui para manter a mensagem de erro
if(isset($_SESSION['usuario'])){
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Gestão de Eletrodomésticos</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <h1>Login - Gestão de Eletrodomésticos</h1>
        <form action="./../controller/controller_usuario.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email..." required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Senha..." required>

            <?php
                if(isset($_SESSION['erro_login'])){
                    echo '<div class="error-message">' . $_SESSION['erro_login'] . '</div>';
                    unset($_SESSION['erro_login']);
                }
            ?>

            <input type="submit" id="login" name="login" value="Acessar">
        </form>
    </body>
</html>