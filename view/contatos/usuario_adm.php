<?php
session_start(); // Inicia a sessão

require_once './model/classeUsuario.php';

// Verifica se o usuário está logado e é um administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

try {
    $user = new Usuario("funk_rap", "localhost", "root", "");
} catch (Exception $e) {
    die("Falha na conexão: " . $e->getMessage());
}

?>

<div class="painel">  
    <p>Olá, <?php echo htmlspecialchars($_SESSION['user_nome']); ?>!</p> 

    <a href="./controller/sair.php">   
        <span class="material-symbols-outlined">logout</span>
    </a>
    <br>
</div>

<div class="dados">
    <h2>Dados dos usuários</h2>
    <table>
        <tr id="titulo">
            <td>Nome</td>
            <td>Telefone</td>
            <td>Email</td>
            <td colspan="2">Ações</td>
        </tr>

        <?php
        $dados = $user->buscarDados();
        if (count($dados) > 0) {
            foreach ($dados as $usuario) {
                echo "<tr>";
                foreach ($usuario as $key => $value) {
                    if ($key != "id" && $key != "senha" && $key != "role") {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                }
                echo "<td>
                        <a href='./model/classeUsuario.php?id=" . htmlspecialchars($usuario['id']) . "'>Editar</a>
                        <a href='dados.php?id=" . htmlspecialchars($usuario['id']) . "'>Excluir</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Não há pessoas cadastradas</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
