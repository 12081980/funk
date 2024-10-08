<?php
include_once("../db/conn.php");

session_start();

if (isset($_POST['emailCad']) && isset($_POST['senhaCad'])) {
    $emailCad = $_POST['emailCad'];
    $senhaCad = $_POST['senhaCad'];

    if (strlen($emailCad) == 0) {
        echo "Preencha seu e-mail";
    } else if (strlen($senhaCad) == 0) {
        echo "Preencha sua senha";
    } else {
        $emailCad = $conn->real_escape_string($emailCad);
        $senhaCad = $conn->real_escape_string($senhaCad);

        // Prepare the SQL query to prevent SQL injection
        $sql = $conn->prepare("SELECT * FROM usuarioCad WHERE emailCad = ?");
        $sql->bind_param("s", $emailCad);
        $sql->execute();
        $sqlResult = $sql->get_result();

        if ($sqlResult->num_rows === 1) {
            $usuarioCad = $sqlResult->fetch_assoc();
            
            // Assuming passwords are hashed, use password_verify
            if (password_verify($senhaCad, $usuarioCad['senhaCad'])) {
                // Set session variables
                $_SESSION['nomeCad'] = $usuarioCad['nomeCad'];
                $_SESSION['emailCad'] = $usuarioCad['emailCad'];
                $_SESSION['tipo'] = $usuarioCad['tipo']; // Assuming 'tipo' field holds 'admin' or 'usuario'

                // Redirect based on user type
                if ($_SESSION['tipo'] === 'admin') {
                    header("Location: ../index.php?menuop=admin");
                } else {
                    header("Location: ../index.php?menuop=usuario");
                }
                exit();
            } else {
                echo "Email ou Senha incorretos";
                header("Refresh: 3; url=../index.php?menuop=login");
                exit();
            }
        } else {
            echo "Email ou Senha incorretos";
            header("Refresh: 3; url=../index.php?menuop=login");
            exit();
        }
    }
} else {
    echo "Método de solicitação inválido.";
}
?>
