<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Cuidador</title>
</head>

<body>

<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
?>

<h1>Bem-vindo ao Painel do Cuidador!</h1>

<a href="edicaoPainelBase.php"><button>Editar perfil</button></a>

<h4><a href="logout.php">Voltar para página de login</a></h4>
    
</body>

</html>
