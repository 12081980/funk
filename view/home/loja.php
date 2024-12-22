<div class="containerloja">
    <header class="headerloja">
        <div class="title">PRODUTOS</div>
        <div class="icon-cart"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
            </svg>
            <span class="spanloja">0</span>
        </div>
    </header>

    <div class="listProduct">
        <div class="itemloja">
            <!-- <img src="./img/img1.png" alt="não existe" width="200" height="100">
                <h2 class="nomeProduto">Flak 2.0 XL</h2>
                <div class="price">R$ 136,00</div>
                <button class="addCart">
                    Adicionar ao carrinho
                </button> -->
        </div>
    </div>
</div>

<div class="cartTab">
    <h1>Carrinho de Compras</h1>
    <div class="listCart">
        <div class="itemloja">
            <div class="image">
                <img src="./img/img1.png" alt="">
            </div>
            <div class="name">
                <h2>Flak 2.0 XL</h2>
            </div>
            <div class="totalPrice">
                <h2>R$ 136,00</h2>
            </div>
            <div class="quantity">
                <span class="minus">
                    <
                        </span>
                        <span>1</span>
                        <span class="plus">></span>
            </div>
        </div>

    </div>

    <div class="botao">
        <button class="close">FECHAR</button>
        <button class="checkOut">Finalizar</button>
    </div>
</div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let iconCart = document.querySelector('.icon-cart');
        let body = document.querySelector('body');
        let closeCart = document.querySelector('.close');
        let listProductHTML = document.querySelector('.listProduct');
        let carts = [];
        let listProducts = [];
        let listCartHTML = document.querySelector('.listCart');
        let iconCartSpan = document.querySelector('.icon-cart span');
        let checkOutButton = document.querySelector('.checkOut');

        // Abre e fecha o carrinho
        iconCart.addEventListener('click', () => {
            body.classList.toggle('showCart');
        });

        closeCart.addEventListener('click', () => {
            body.classList.toggle('showCart');
        });

        const saveCartToLocalStorage = () => {
            localStorage.setItem('cart', JSON.stringify(carts));
        };

        const loadCartFromLocalStorage = () => {
            const storedCart = localStorage.getItem('cart');
            if (storedCart) {
                carts = JSON.parse(storedCart);
                updateCartCount();
                updateCartHTML();
            }
        };

        // Carregar produtos e exibir na tela
        const initApp = () => {
            fetch('./json/produtos.json') // Certifique-se de que o caminho está correto
                .then(response => response.json())
                .then(data => {
                    listProducts = data;
                    console.log('Produtos carregados:', listProducts); // Depuração
                    addDataToHTML();
                })
                .catch(error => console.error('Erro ao carregar produtos:', error));
        };

        // Renderizar produtos na página principal
        const addDataToHTML = () => {
            listProductHTML.innerHTML = '';

            if (listProducts.length > 0) {
                listProducts.forEach(product => {
                    let newProduct = document.createElement('div');
                    newProduct.classList.add('itemloja');
                    newProduct.dataset.id = product.id;

                    newProduct.innerHTML = `
                    <img src="${product.image}" alt="${product.name}">
                    <h2 class="nomeProduto">${product.name}</h2>
                    <div class="price">R$ ${product.price}</div>
                    <button class="addCart">Adicionar ao carrinho</button>
                `;

                    listProductHTML.appendChild(newProduct);
                });
            }

            listProductHTML.addEventListener('click', (event) => {
                if (event.target.classList.contains('addCart')) {
                    let product_id = event.target.parentElement.dataset.id;
                    console.log('Adicionando produto com ID:', product_id); // Depuração
                    addToCart(product_id);
                }
            });
        };

        // Função para adicionar ao carrinho
        const addToCart = (product_id) => {
            if (!product_id) {
                console.error("Erro: Nenhum ID de produto fornecido.");
                return;
            }

            let product = listProducts.find(item => item.id == product_id);
            if (!product) {
                console.error("Erro: Produto não encontrado!");
                return;
            }

            let productExists = carts.find(item => item.product_id === product_id);

            if (productExists) {
                productExists.quantity += 1;
            } else {
                carts.push({
                    product_id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.image,
                    quantity: 1
                });
            }

            console.log("Carrinho atualizado:", carts);
            updateCartCount();
            updateCartHTML();
            saveCartToLocalStorage();
        };

        // Atualiza o número no ícone do carrinho
        const updateCartCount = () => {
            let totalQuantity = carts.reduce((sum, item) => sum + item.quantity, 0);
            iconCartSpan.innerText = totalQuantity;
        };

        // Atualiza a visualização do carrinho
        const updateCartHTML = () => {
            listCartHTML.innerHTML = '';

            if (carts.length > 0) {
                carts.forEach(item => {
                    let cartItem = document.createElement('div');
                    cartItem.classList.add('itemloja');

                    cartItem.innerHTML = `
                    <div class="image">
                        <img src="${item.image}" alt="${item.name}">
                    </div>
                    <div class="name">
                        <h2>${item.name}</h2>
                    </div>
                    <div class="totalPrice">
                        <h2>R$ ${(item.price * item.quantity).toFixed(2)}</h2>
                    </div>
                    <div class="quantity">
                        <button class="minus" data-id="${item.product_id}">-</button>
                        <span>${item.quantity}</span>
                        <button class="plus" data-id="${item.product_id}">+</button>
                    </div>
                `;

                    listCartHTML.appendChild(cartItem);
                });

                document.querySelectorAll('.plus').forEach(button => {
                    button.addEventListener('click', () => {
                        modifyQuantity(button.dataset.id, 1);
                    });
                });

                document.querySelectorAll('.minus').forEach(button => {
                    button.addEventListener('click', () => {
                        modifyQuantity(button.dataset.id, -1);
                    });
                });
            } else {
                listCartHTML.innerHTML = '<p>O carrinho está vazio.</p>';
            }
        };

        // Modifica a quantidade de itens no carrinho
        const modifyQuantity = (product_id, change) => {
            let product = carts.find(item => item.product_id == product_id);
            if (product) {
                product.quantity += change;

                if (product.quantity <= 0) {
                    carts = carts.filter(item => item.product_id != product_id);
                }
            }

            updateCartCount();
            updateCartHTML();
            saveCartToLocalStorage();
        };

        // Evento de clique no botão "Finalizar"
        checkOutButton.addEventListener('click', () => {
            if (carts.length > 0) {
                alert('Compra realizada com sucesso!');
                carts = [];
                updateCartCount();
                updateCartHTML();
                saveCartToLocalStorage();
            } else {
                alert('Seu carrinho está vazio. Adicione itens antes de finalizar a compra.');
            }
        });

        // Inicializar a aplicação
        loadCartFromLocalStorage();
        initApp();
    });
</script>