<h1>Sistema de cadastro de produtos</h1>

<form class="produtoCad" action="./controller/cadastroProduto.php" method="post">
    <label>Nome do produto:</label>
    <input type="text" name="nomeProduto">

    <label>Quantidade:</label>
    <input type="number" min="0" name="quantidadeProduto">

    <label>Valor por unidade:</label>
    <input type="number" min="0" name="valorProduto">

    <input type="submit" value="Cadastrar produto">
</form>
<a href="javascript:history.back()">Voltar</a>