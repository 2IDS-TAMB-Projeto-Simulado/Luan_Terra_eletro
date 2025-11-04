<?php
    require_once "../config/db.php";

    class Usuario{
        public function buscar_usuario($email, $senha) {
            $conn = Database::getConnection();
            $select = $conn->prepare("SELECT * FROM USUARIO WHERE EMAIL = ? AND SENHA = ?");
            $select->bind_param("ss", $email, $senha);
            $select->execute();
            $resultado = $select->get_result();
            return $resultado->fetch_assoc();
        }
    }
?>