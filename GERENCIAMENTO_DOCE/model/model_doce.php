<?php
require_once "../config/db.php";
require_once "model_estoque.php";
require_once "model_logs.php";

class Doce{
    public function cadastrar_doce($formato, $tamanho, $marca, $tipo, $data_validade, $fk_usuario_id) {
        $conn = Database::getConnection();
        $insert = $conn->prepare("INSERT INTO DOCE (FORMATO, TAMANHO, MARCA, TIPO, DATA_VALIDADE, FK_USUARIO_ID) VALUES (?, ?, ?, ?, ?, ?)");
        $insert->bind_param("sssssi", $formato, $tamanho, $marca, $tipo, $data_validade, $fk_usuario_id);
        $success = $insert->execute();

        if($success){
            $doce_id = $conn->insert_id;
            $estoque = new Estoque();
            $estoque->adicionar_estoque(0, $fk_usuario_id, $doce_id);

            $logs = new Logs();
            $logs->cadastrar_logs("DOCE <br> ID: ".$doce_id." <br> tipo: ".$tipo." <br> marca: ".$marca." <br> tamanho: ".$tamanho." <br> formato: ".$formato." <br> data_validade: ".$data_validade." <br> AÇÃO: Cadastrado! <br> ID USUÁRIO: ".$fk_usuario_id);
        }

        $insert->close();
        return $success;
    }

    public function listar_doces() {
        $conn = Database::getConnection();
        $sql = "SELECT D.DOCE_ID, D.FORMATO, D.TAMANHO, D.MARCA, D.TIPO, D.DATA_VALIDADE, E.ESTOQUE_QUANTIDADE, U.NOME, U.EMAIL
                FROM DOCE D
                JOIN USUARIO U ON D.FK_USUARIO_ID = U.USUARIO_ID
                LEFT JOIN ESTOQUE E ON D.DOCE_ID = E.FK_DOCE_ID
                ORDER BY D.MARCA";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function excluir_doce($doce_id, $fk_usuario_id) {
        $conn = Database::getConnection();
        $delete = $conn->prepare("DELETE FROM DOCE WHERE DOCE_ID = ?");
        $delete->bind_param("i", $doce_id);

        $logs = new Logs();
        $logs->cadastrar_logs("DOCE <br> ID: ".$doce_id." <br> AÇÃO: Excluído! <br> ID USUÁRIO: ".$fk_usuario_id);

        $success = $delete->execute();
        $delete->close();
        return $success;
    }

    public function buscar_doce_pelo_id($id) {
        $conn = Database::getConnection();
        $select = $conn->prepare("SELECT D.DOCE_ID, D.FORMATO, D.TAMANHO, D.MARCA, D.TIPO, D.DATA_VALIDADE, E.ESTOQUE_QUANTIDADE, U.NOME, U.EMAIL
                                  FROM DOCE D
                                  JOIN USUARIO U ON D.FK_USUARIO_ID = U.USUARIO_ID
                                  LEFT JOIN ESTOQUE E ON D.DOCE_ID = E.FK_DOCE_ID
                                  WHERE D.DOCE_ID = ?");
        $select->bind_param("i", $id);
        $select->execute();
        $result = $select->get_result();
        $doce = $result->fetch_all(MYSQLI_ASSOC);
        $select->close();
        return $doce;
    }

    public function editar_doce($formato, $tamanho, $marca, $tipo, $data_validade, $doce_id) {
        $conn = Database::getConnection();
        $update = $conn->prepare("UPDATE DOCE SET FORMATO = ?, TAMANHO = ?, MARCA = ?, TIPO = ?, DATA_VALIDADE = ? WHERE DOCE_ID = ?");
        $update->bind_param("sssssi", $formato, $tamanho, $marca, $tipo, $data_validade, $doce_id);
        $success = $update->execute();

        if($success){
            $logs = new Logs();
            $logs->cadastrar_logs("DOCE <br> ID: ".$doce_id." <br> tipo: ".$tipo." <br> marca: ".$marca." <br> tamanho: ".$tamanho." <br> formato: ".$formato." <br> data_validade: ".$data_validade." <br> AÇÃO: Editado! <br> ID USUÁRIO: ".$fk_usuario_id);
        }

        $update->close();
        return $success;
    }

    public function filtrar_doce($campo) {
        $conn = Database::getConnection();
        $select = $conn->prepare("SELECT D.DOCE_ID, D.FORMATO, D.TAMANHO, D.MARCA, D.TIPO, D.DATA_VALIDADE, E.ESTOQUE_QUANTIDADE, U.NOME, U.EMAIL
                                  FROM DOCE D
                                  JOIN USUARIO U ON D.FK_USUARIO_ID = U.USUARIO_ID
                                  LEFT JOIN ESTOQUE E ON D.DOCE_ID = E.FK_DOCE_ID
                                  WHERE D.MARCA LIKE ?
                                  ORDER BY D.MARCA");
        $termo = "%" . $campo . "%";
        $select->bind_param("s", $termo);
        $select->execute();
        $result = $select->get_result();
        $doces = $result->fetch_all(MYSQLI_ASSOC);
        $select->close();
        return $doces;
    }
}
?>
