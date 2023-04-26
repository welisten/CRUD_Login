<?php 
session_start();
if(!isset($_SESSION['id_usuario']))
{
    header("location: index.php");
    exit;
}
else
{
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Área Privada</title>
</head>
<body>
    <div class="privat-container">
        <nav>
            <div class="logo">

            </div>
            <div class="navigation-menu">
            <a href="">Home</a>
            <a href="">Galeria</a>
            <a href="">Suporte</a>
            <a href="">Resumos</a>
            <a href="">Sobre</a>
            </div>
        </nav>
        <h3>Bem Vindo a sua sessão privada</h3>
    </div>
    
</body>
</html>
 <?php
}





