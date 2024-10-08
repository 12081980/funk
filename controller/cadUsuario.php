<?php
include_once("../banco/conexao.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';   
    $tel = isset($_POST['tel']) ? trim($_POST['tel']) : '';   
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';


    if (empty($nome)) {
        die("Preencha seu nome");
    }
    if (empty($tel)) {
        die("Preencha seu telefone");
    }
    if (empty($email)) {
        die("Preencha seu email");
    }
    if (empty($senha)) {
        die("Crie uma senha");
    }

    
    $stmt = $conn->prepare("INSERT INTO usuarios (nome,tel, email, senha) VALUES (?, ?,?, ?)");
    if (!$stmt) {
        die("Erro na preparação da query: " . $conn->error);
    }


    $senhaHashed = password_hash($senha, PASSWORD_DEFAULT);

 
    $stmt->bind_param("ssss", $nome,$tel, $email, $senhaHashed);


    if ($stmt->execute()) {
     
          header("Location: ../index.php?menuop=login");
        exit;
    } else {
        die("Erro ao tentar realizar o cadastro: " . $stmt->error);
    } 
    $stmt->close();
} else {
    die("Método inválido.");
}
$conn->close();
?>
