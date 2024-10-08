<?php
if(!isset($_SESSION)){
    session_start();
}

session_destroy();


echo "Deslogado com sucesso";
header("Refresh: 1;url=../index.php?menuop=home");



?>
