<?php
require_once './model/classeUsuario.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'usuario') {
    header("Location: login.php");
    exit();
}
?>

<div class="painel">
    <h1 id="titulo">Bem-vindo!!!</h1>
    <p> <?php echo $_SESSION['user_nome']; ?>!</p>
    <a href="./controller/sair.php"> <span class="material-symbols-outlined">
            logout
        </span>
        <div class="usuario">
            <div class="dadospessoais">

            </div>
            <div class="interacao">

            </div>

        </div>
</div>
</div>