<section class="cadastro">
    <div class="tela-login2">
        <h1 id="login">Dados pessoais</h1>
        <br>
        <form action="./controller/cadUsuario.php" method="post">
            <div class="pessoal">
                <input class="log" type="text" name="nome" placeholder="Nome">
                <br>
                <input class="log" type="text" name="tel" placeholder="Telefone">
                <br>
                <input class="log" type="text" name="email" placeholder="Email">
                <br>
                <input class="log" type="password" name="senha" placeholder="Senha">
                <br>
                <!-- <input class="log" type="password" name="confirmarsenha" placeholder="Confirmar senha"> -->

            </div>
    </div>




    <div class="endereco">
        <h1 id="login">Endereço</h1>
        <input class="log" type="text" name="bairro" placeholder="Bairro">
        <br>
        <input class="log" type="text" name="logradouro" placeholder="Logradouro">
        <br>
        <input class="log" type="text" name="numero" placeholder="N°">
        <br>
        <input class="log" type="text" name="cidade" placeholder="Cidade">
        <br>
        <input class="log" type="text" name="estado" placeholder="Estado">
        <br>
        <div id="btncad">
            <button type="submit">Cadastrar</button>
        </div>
    </div>

    </form>




</section>