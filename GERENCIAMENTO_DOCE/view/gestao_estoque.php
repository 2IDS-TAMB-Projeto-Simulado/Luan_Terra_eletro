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
        <title>Gestão de Estoque - Gestão de Doce</title>
        <link rel="stylesheet" href="../CSS/gestao.css">
    </head>
    <body>
        <div class="container">
            <h1>Gestão de Estoque</h1>
            
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
                                <td><input type='number' name='doce_id' value='<?php echo $r["DOCE_ID"]; ?>' readonly></td>
                                <td><?php echo htmlspecialchars($r["FORMATO"]); ?></td>
                                <td><?php echo htmlspecialchars($r["TAMANHO"]); ?></td>
                                <td><?php echo htmlspecialchars($r["MARCA"]); ?></td>
                                <td><?php echo htmlspecialchars($r["TIPO"]); ?></td>
                                <td><?php echo htmlspecialchars($r["DATA_VALIDADE"]); ?></td>
                                <td>
                                    <input type='number' name='estoque_qtd' value='<?php echo $r["ESTOQUE_QUANTIDADE"]; ?>' readonly>
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
                            <td colspan='10' style='text-align: center;'>Nenhum doce encontrado!</td>
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