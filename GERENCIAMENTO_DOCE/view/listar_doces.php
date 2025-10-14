<?php
require_once "./../controller/controller_doce.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

$doce = new Doce();
if (isset($_POST['botao_pesquisar'])) {
    $resultados = $doce->filtrar_doce($_POST['pesquisar']);
} 
else {
    $resultados = $doce->listar_doces();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Doces - Gestão de Doce</title>
        <link rel="stylesheet" href="../CSS/listar.css">
    </head>
    <body>
        <div class="container">
            <h1>Lista de Doces</h1>
            
            <form method="POST">
                <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar por marca, tipo ou formato...">
                <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
            </form>
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FORMATO</th>
                        <th>TAMANHO</th>
                        <th>MARCA</th>
                        <th>TIPO</th>
                        <th>DATA VALIDADE</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($resultados) > 0): ?>
                        <?php foreach($resultados as $r): ?>
                            <tr>  
                                <td><?php echo $r["DOCE_ID"]; ?></td>
                                <td><?php echo htmlspecialchars($r["FORMATO"]); ?></td>
                                <td><?php echo htmlspecialchars($r["TAMANHO"]); ?></td>
                                <td><?php echo htmlspecialchars($r["MARCA"]); ?></td>
                                <td><?php echo htmlspecialchars($r["TIPO"]); ?></td>
                                <td><?php echo htmlspecialchars($r["DATA_VALIDADE"]); ?></td>
                                <td>
                                    <a href='editar_doce.php?acao=editar_doce&id=<?php echo $r["DOCE_ID"]; ?>' 
                                       title="Editar doce"
                                       class="action-tooltip">
                                        Editar
                                    </a>
                                    <a href='./../controller/controller_doce.php?acao=excluir_doce&id=<?php echo $r["DOCE_ID"]; ?>' 
                                       title="Excluir doce" 
                                       class="action-tooltip"
                                       onclick="return confirm('Tem certeza que deseja excluir este doce?')">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>  
                            <td colspan='7' style='text-align: center;'>Nenhum doce cadastrado!</td>
                        </tr>       
                    <?php endif; ?>
                </tbody>
            </table>
            
            <div class="button-container">
                <a href="cadastro_doce.php">
                    <button>Cadastrar Novo Doce</button>
                </a>
            </div>
            
            <a href="inicial.php">
                <button>Voltar para Início</button>
            </a>
        </div>

        <script>
            // Confirmação de exclusão
            document.addEventListener('DOMContentLoaded', function() {
                const deleteLinks = document.querySelectorAll('a[title="Excluir doce"]');
                deleteLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        if (!confirm('Tem certeza que deseja excluir este doce? Esta ação não pode ser desfeita.')) {
                            e.preventDefault();
                        }
                    });
                });
            });
        </script>
    </body>
</html>