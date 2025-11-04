<?php
    require_once "../model/model_eletrodomestico.php";
    session_start();

    //CADASTRAR ELETRODOMESTICO
    if(isset($_POST["cadastrar_eletrodomestico"])){
        $eletro = new Eletrodomestico();
        $resultado = $eletro->cadastrar_eletrodomestico($_POST["marca"], $_POST["categoria"], $_POST["fornecedor"], $_POST["potencia"], $_POST["consumo"], $_POST["garantia"], $_POST["prioridade_reposicao"], $_SESSION['usuario']["USUARIO_ID"]);
        if($resultado){
            echo "<script>
                    alert('Eletrodoméstico cadastrado com sucesso!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        } 
        else {
            echo "<script>
                    alert('Erro ao cadastrar eletrodoméstico!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        }
        exit();
    }

    //BUSCAR DADOS PARA EDITAR ELETRODOMESTICO
    else if(isset($_GET["acao"]) && $_GET["acao"] == "editar_eletrodomestico"){
        $eletro = new Eletrodomestico();
        $resultados = $eletro->buscar_eletrodomestico_pelo_id($_GET["id"]);

        if(!empty($resultados)) {
            $eletro_editar = $resultados[0];
        } else {
            echo "<script>
                    alert('Eletrodoméstico não encontrado!');
                    window.location.href='listar_eletrodomestico.php';
                </script>";
            exit();
        }
    }

    //EDITAR ELETRODOMESTICO
    if(isset($_POST["editar_eletrodomestico"])){
        $eletro = new Eletrodomestico();
        $resultado = $eletro->editar_eletrodomestico($_POST["marca"], $_POST["categoria"], $_POST["fornecedor"], $_POST["potencia"], $_POST["consumo"], $_POST["garantia"], $_POST["prioridade_reposicao"], $_POST["eletro_id"]);
        if($resultado){
            echo "<script>
                    alert('Eletrodoméstico atualizado com sucesso!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        } 
        else {
            echo "<script>
                    alert('Erro ao atualizar eletrodoméstico!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        }
        exit();
    }

    //EXCLUIR ELETRODOMESTICO
    else if(isset($_GET["acao"]) && $_GET["acao"] == "excluir_eletrodomestico"){
        $eletro = new Eletrodomestico();
        $resultado = $eletro->excluir_eletrodomestico($_GET["id"], $_SESSION['usuario']['USUARIO_ID']);
        if($resultado){
            echo "<script>
                    alert('Eletrodoméstico excluído com sucesso!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        } 
        else {
            echo "<script>
                    alert('Erro ao excluir eletrodoméstico!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        }
        exit();
    }
?>