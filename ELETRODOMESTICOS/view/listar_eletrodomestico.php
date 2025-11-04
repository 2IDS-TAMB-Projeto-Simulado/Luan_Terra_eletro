<?php
require_once "./../controller/controller_eletrodomestico.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

$eletro = new Eletrodomestico();
if (isset($_POST['botao_pesquisar'])) {
    $resultados = $eletro->filtrar_eletrodomestico($_POST['pesquisar']);
} 
else {
    $resultados = $eletro->listar_eletrodomesticos();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Eletrodomésticos - Gestão de Eletrodomésticos</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Lista de Eletrodomésticos</h1>
            
            <form method="POST">
                <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar por marca ou categoria...">
                <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
            </form>
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>MARCA</th>
                        <th>CATEGORIA</th>
                        <th>FORNECEDOR</th>
                        <th>POTÊNCIA</th>
                        <th>CONSUMO</th>
                        <th>GARANTIA</th>
                        <th>PRIORIDADE</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($resultados) > 0): ?>
                        <?php foreach($resultados as $r): ?>
                            <tr>  
                                <td><?php echo $r["ELETRO_ID"]; ?></td>
                                <td><?php echo htmlspecialchars($r["MARCA"]); ?></td>
                                <td><?php echo htmlspecialchars($r["CATEGORIA"]); ?></td>
                                <td><?php echo htmlspecialchars($r["FORNECEDOR"]); ?></td>
                                <td><?php echo htmlspecialchars($r["POTENCIA"]); ?></td>
                                <td><?php echo htmlspecialchars($r["CONSUMO"]); ?></td>
                                <td><?php echo htmlspecialchars($r["GARANTIA"]); ?></td>
                                <td><?php echo htmlspecialchars($r["PRIORIDADE_REPOSICAO"]); ?></td>
                                <td>
                                    <a href='editar_eletrodomestico.php?acao=editar_eletrodomestico&id=<?php echo $r["ELETRO_ID"]; ?>' 
                                       title="Editar eletrodoméstico"
                                       class="action-tooltip">
                                        Editar
                                    </a>
                                    <a href='./../controller/controller_eletrodomestico.php?acao=excluir_eletrodomestico&id=<?php echo $r["ELETRO_ID"]; ?>' 
                                       title="Excluir eletrodoméstico" 
                                       class="action-tooltip"
                                       onclick="return confirm('Tem certeza que deseja excluir este eletrodoméstico?')">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>  
                            <td colspan='9' style='text-align: center;'>Nenhum eletrodoméstico cadastrado!</td>
                        </tr>       
                    <?php endif; ?>
                </tbody>
            </table>
            
            <div class="button-container">
                <a href="cadastro_eletrodomestico.php">
                    <button>Cadastrar Novo Eletrodoméstico</button>
                </a>
            </div>
            
            <a href="inicial.php">
                <button>Voltar para Início</button>
            </a>
        </div>

        <script>
            // Confirmação de exclusão
            document.addEventListener('DOMContentLoaded', function() {
                const deleteLinks = document.querySelectorAll('a[title="Excluir eletrodoméstico"]');
                deleteLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        if (!confirm('Tem certeza que deseja excluir este eletrodoméstico? Esta ação não pode ser desfeita.')) {
                            e.preventDefault();
                        }
                    });
                });
            });
        </script>
    </body>
</html>