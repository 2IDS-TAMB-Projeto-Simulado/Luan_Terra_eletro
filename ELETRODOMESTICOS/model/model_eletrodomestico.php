<?php
require_once "../config/db.php";
require_once "model_estoque.php";
require_once "model_logs.php";

class Eletrodomestico{
    public function cadastrar_eletrodomestico($marca, $categoria, $fornecedor, $potencia, $consumo, $garantia, $prioridade_reposicao, $fk_usuario_id) {
        $conn = Database::getConnection();
        $insert = $conn->prepare("INSERT INTO ELETRODOMESTICO (MARCA, CATEGORIA, FORNECEDOR, POTENCIA, CONSUMO, GARANTIA, PRIORIDADE_REPOSICAO, FK_USUARIO_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert->bind_param("sssssssi", $marca, $categoria, $fornecedor, $potencia, $consumo, $garantia, $prioridade_reposicao, $fk_usuario_id);
        $success = $insert->execute();

        if($success){
            $eletro_id = $conn->insert_id;
            $estoque = new Estoque();
            $estoque->adicionar_estoque(0, $eletro_id);

            $logs = new Logs();
            $logs->cadastrar_logs("ELETRODOMESTICO <br> ID: ".$eletro_id." <br> marca: ".$marca." <br> categoria: ".$categoria." <br> fornecedor: ".$fornecedor." <br> potencia: ".$potencia." <br> consumo: ".$consumo." <br> garantia: ".$garantia." <br> prioridade_reposicao: ".$prioridade_reposicao." <br> AÇÃO: Cadastrado! <br> ID USUÁRIO: ".$fk_usuario_id);
        }

        $insert->close();
        return $success;
    }

    public function listar_eletrodomesticos() {
        $conn = Database::getConnection();
        $sql = "SELECT E.ELETRO_ID, E.MARCA, E.CATEGORIA, E.FORNECEDOR, E.POTENCIA, E.CONSUMO, E.GARANTIA, E.PRIORIDADE_REPOSICAO, ES.QUANTIDADE, U.NOME, U.EMAIL
                FROM ELETRODOMESTICO E
                JOIN USUARIO U ON E.FK_USUARIO_ID = U.USUARIO_ID
                LEFT JOIN ESTOQUE ES ON E.ELETRO_ID = ES.FK_ELETRO_ID
                ORDER BY E.MARCA";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function excluir_eletrodomestico($eletro_id, $fk_usuario_id) {
        $conn = Database::getConnection();
        $delete = $conn->prepare("DELETE FROM ELETRODOMESTICO WHERE ELETRO_ID = ?");
        $delete->bind_param("i", $eletro_id);

        $logs = new Logs();
        $logs->cadastrar_logs("ELETRODOMESTICO <br> ID: ".$eletro_id." <br> AÇÃO: Excluído! <br> ID USUÁRIO: ".$fk_usuario_id);

        $success = $delete->execute();
        $delete->close();
        return $success;
    }

    public function buscar_eletrodomestico_pelo_id($id) {
        $conn = Database::getConnection();
        $select = $conn->prepare("SELECT E.ELETRO_ID, E.MARCA, E.CATEGORIA, E.FORNECEDOR, E.POTENCIA, E.CONSUMO, E.GARANTIA, E.PRIORIDADE_REPOSICAO, ES.QUANTIDADE, U.NOME, U.EMAIL
                                  FROM ELETRODOMESTICO E
                                  JOIN USUARIO U ON E.FK_USUARIO_ID = U.USUARIO_ID
                                  LEFT JOIN ESTOQUE ES ON E.ELETRO_ID = ES.FK_ELETRO_ID
                                  WHERE E.ELETRO_ID = ?");
        $select->bind_param("i", $id);
        $select->execute();
        $result = $select->get_result();
        $eletro = $result->fetch_all(MYSQLI_ASSOC);
        $select->close();
        return $eletro;
    }

    public function editar_eletrodomestico($marca, $categoria, $fornecedor, $potencia, $consumo, $garantia, $prioridade_reposicao, $eletro_id) {
        $conn = Database::getConnection();
        $update = $conn->prepare("UPDATE ELETRODOMESTICO SET MARCA = ?, CATEGORIA = ?, FORNECEDOR = ?, POTENCIA = ?, CONSUMO = ?, GARANTIA = ?, PRIORIDADE_REPOSICAO = ? WHERE ELETRO_ID = ?");
        $update->bind_param("sssssssi", $marca, $categoria, $fornecedor, $potencia, $consumo, $garantia, $prioridade_reposicao, $eletro_id);
        $success = $update->execute();

        if($success){
            $logs = new Logs();
            $logs->cadastrar_logs("ELETRODOMESTICO <br> ID: ".$eletro_id." <br> marca: ".$marca." <br> categoria: ".$categoria." <br> fornecedor: ".$fornecedor." <br> potencia: ".$potencia." <br> consumo: ".$consumo." <br> garantia: ".$garantia." <br> prioridade_reposicao: ".$prioridade_reposicao." <br> AÇÃO: Editado!");
        }

        $update->close();
        return $success;
    }

    public function filtrar_eletrodomestico($campo) {
        $conn = Database::getConnection();
        $select = $conn->prepare("SELECT E.ELETRO_ID, E.MARCA, E.CATEGORIA, E.FORNECEDOR, E.POTENCIA, E.CONSUMO, E.GARANTIA, E.PRIORIDADE_REPOSICAO, ES.QUANTIDADE, U.NOME, U.EMAIL
                                  FROM ELETRODOMESTICO E
                                  JOIN USUARIO U ON E.FK_USUARIO_ID = U.USUARIO_ID
                                  LEFT JOIN ESTOQUE ES ON E.ELETRO_ID = ES.FK_ELETRO_ID
                                  WHERE E.MARCA LIKE ? OR E.CATEGORIA LIKE ?
                                  ORDER BY E.MARCA");
        $termo = "%" . $campo . "%";
        $select->bind_param("ss", $termo, $termo);
        $select->execute();
        $result = $select->get_result();
        $eletrodomesticos = $result->fetch_all(MYSQLI_ASSOC);
        $select->close();
        return $eletrodomesticos;
    }
}
?>