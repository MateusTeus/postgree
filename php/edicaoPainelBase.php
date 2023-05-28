<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil Cuidador</title>
</head>

<body>

<?php

if(isset($_SESSION["status"])){
    echo "<h4>".$_SESSION["status"]."</h4>";
    unset($_SESSION["status"]);
}

?>

EDIÇÃO AQUI

<form action="edicaoPainelCodigo.php" method="post">

    <p>ID:<input type="text" name="id2"></p> 

    <p>Nome: <input type="text" name="nome2"></p>

    <p>CPF: <input type="number" name="cpf2"></p>

    <p>Email: <input type="email" name="email2"></p>

    <p>Senha: <input type="text" name="senha2"></p>

    <p><input type="submit" value="EDITAR" name="enviar2"></p>

</form>

<p>Deseja voltar para ao Painel do Cuidador? <a href="painel.php">Clique aqui!</a></p>
    
</body>

</html>
