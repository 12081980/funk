function habilitarEdicao() {
    let inputs = document.querySelectorAll('.dadospessoais input');
    inputs.forEach(input => input.removeAttribute('readonly'));
    document.getElementById('editarDados').style.display = 'none'; // Esconde o botão "Editar" após edição
}