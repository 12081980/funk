<?php
if (!isset($_SESSION)) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Cultura Funk</title>
    <link rel="shortcut icon" type="imagex/png" href="../img/band.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body>

    <!-- inicio navegação -->
    <header>
        <div><a class="logo" href="./index.php">Cultura Funk</a>
        </div>
        <div class="hamb">
            <div class="line"></div>
            <!-- <div class="line"></div>
            <div class="line"></div> -->
        </div>
        <nav class="nav-bar">
            <ul>

                <li>
                    <a href="index.php?menuop=sobre">Sobre</a>
                </li>
                <li>
                    <a href="index.php?menuop=musica">Musicas</a>
                </li>
                <li>
                    <a href="index.php?menuop=artista">Artista</a>
                </li>
                <li>
                    <a href="index.php?menuop=loja">Loja</a>
                </li>
                <li>
                    <a href="index.php?menuop=login">Login</a>
                </li>
                <!-- <li>
                    <div class="car">
                        <a href="index.php?menuop=carrinho"><span class="material-symbols-outlined">
                                shopping_cart <span id="car">0</span>
                            </span></a>
                    </div>
                </li> -->

            </ul>
        </nav>
    </header>
    <section class="inicio">