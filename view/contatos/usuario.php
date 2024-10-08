<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'usuario') {
    header("Location: login.php");
    exit();
}
?>

<div class="painel">
    <h1 id="titulo">Bem-vindo!!!</h1>    
    <p> <?php echo $_SESSION['user_nome']; ?>!</p>    
    <a href="./controller/sair.php">   <span class="material-symbols-outlined">
logout
</span></a>
<a href="http://">
<span class="material-symbols-outlined">
add_shopping_cart
</span></a>
    </div>
    </div>



