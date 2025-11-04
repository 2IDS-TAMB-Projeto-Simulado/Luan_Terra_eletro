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
        <title>Gestão de Estoque - Gestão de Eletrodomésticos</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Gestão de Estoque</h1>
            
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
                        <th>ESTOQUE</th>
                        <th>AÇÃO</th>
                        <th>QUANTIDADE</th>
                        <th>ATUALIZAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($resultados) > 0): ?>
                        <?php foreach($resultados as $r): ?>
                            <form method='POST' action='./../controller/controller_estoque.php'>
                            <tr>  
                                <td><input type='number' name='eletro_id' value='<?php echo $r["ELETRO_ID"]; ?>' readonly></td>
                                <td><?php echo htmlspecialchars($r["MARCA"]); ?></td>
                                <td><?php echo htmlspecialchars($r["CATEGORIA"]); ?></td>
                                <td><?php echo htmlspecialchars($r["FORNECEDOR"]); ?></td>
                                <td><?php echo htmlspecialchars($r["POTENCIA"]); ?></td>
                                <td><?php echo htmlspecialchars($r["CONSUMO"]); ?></td>
                                <td><?php echo htmlspecialchars($r["GARANTIA"]); ?></td>
                                <td><?php echo htmlspecialchars($r["PRIORIDADE_REPOSICAO"]); ?></td>
                                <td>
                                    <input type='number' name='estoque_qtd' value='<?php echo $r["QUANTIDADE"]; ?>' readonly>
                                </td>
                                <td>
                                    <select name='acao_estoque' required>
                                        <option value=''>Selecione...</option>
                                        <option value='entrada'>Entrada</option>
                                        <option value='saida'>Saída</option>
                                    </select>
                                </td>
                                <td>
                                    <input type='number' name='qtd_aumentar_diminuir' min='1' required placeholder="Qtd">
                                </td>
                                <td>
                                    <input type='submit' name='botao_atualizar' value='Atualizar'>
                                </td>
                            </tr>    
                            </form>                        
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>  
                            <td colspan='12' style='text-align: center;'>Nenhum eletrodoméstico encontrado!</td>
                        </tr>       
                    <?php endif; ?>
                </tbody>
            </table>
            
            <a href="inicial.php">
                <button>Voltar para Início</button>
            </a>
        </div>
    </body>
</html>