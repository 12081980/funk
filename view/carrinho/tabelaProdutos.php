<?php
include_once "./banco/conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check the action
    if ($_POST['acao'] === 'salvar') {
        // Loop through each product
        foreach ($_POST['nomeProduto'] as $id => $nomeProduto) {
            $quantidadeProduto = $_POST['quantidadeProduto'][$id];
            $valorProduto = $_POST['valorProduto'][$id];

            // Update the product in the database
            $updateQuery = "UPDATE produtos SET nomeProduto = ?, quantidadeProduto = ?, valorProduto = ? WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("sdii", $nomeProduto, $quantidadeProduto, $valorProduto, $id);
            $stmt->execute();
        }
    } elseif ($_POST['acao'] === 'apagar') {
        // Delete product by ID
        foreach ($_POST['nomeProduto'] as $id => $nomeProduto) {
            $deleteQuery = "DELETE FROM produtos WHERE id = ?";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
    }
}

// Redirect or display a success message
header(header: "index.php?menuop=tabela"); // Redirect back to the products list
exit;
?>