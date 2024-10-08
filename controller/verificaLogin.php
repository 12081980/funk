

<?php
include_once("../db/conexao.php");

session_start();

$emailCad = $_POST['emailCad'];
$senhaCad = $_POST['senhaCad'];




if (isset($_POST['emailCad']) || isset($_POST['senhaCad'])) {
    if (strlen($_POST['emailCad']) == 0) {
        echo "Preencha seu e-mail";
    } else if (strlen($_POST['senhaCad']) == 0) {
        echo "Preencha sua senha";
    } else {
        $emailCad = $conexao->real_escape_string($_POST['emailCad']);
        $senhaCad = $conexao->real_escape_string($_POST['senhaCad']);

        $sql = "SELECT * FROM usuarioCad WHERE emailCad = '$emailCad' AND senhaCad ='senhaCad' ";
        $sqlResult = $conexao->query($sql) or die('Falha na execução: ' . $conexao->error);

        $quantidade = $sqlResult->num_rows;

        if ($quantidade == 1) {
            $usuarioCad = $sqlResult->fetch_assoc();

         
            if(isset($_SESSION)){
                session_start();
            }
                $_SESSION['nomeCad'] = $usuarioCad['nomeCad'];
                $_SESSION['emailCad'] = $usuarioCad['emailCad'];
               
                echo "Email ou Senha incorretos";
                header("Refresh: 3; url=../index.php?menuop=login");
               
                              
                
            } else {
                echo "Bem vindo ao seu perfil";
                header("Refresh: 3;url=../index.php?menuop=usuario");
               
            }
        } 
    }

?>