<?php

session_start();
if (isset($_SESSION["user"])) {
    header("Location: painel.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>


<?php


    if (isset($_POST["enviar"])) {
        $Nome = $_POST["nome"];
        $Cpf = $_POST["cpf"];
        $Email = $_POST["email"];
        $Senha = $_POST["senha"];
        require_once "database.php";

        $SenhaHash = password_hash($Senha, PASSWORD_DEFAULT);

        $Erros = array();
        
        if (empty($Nome) OR empty($Cpf) OR empty($Email) OR empty($Senha)) {
            array_push($Erros,"É necessário que todos os campos sejam preenchidos! ");
        }

        if (strlen($Cpf)!=11) {
            array_push($Erros,"CPF inválido. ");
        }

        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            array_push($Erros,"O e-mail não é válido. ");
        }
        
        if (strlen($Senha)<8) {
            array_push($Erros,"A senha deve conter pelo menos 8 caracteres. ");
        }
        
        $sql = "SELECT * FROM dadoscadastro WHERE email = '$Email'";
        $result = pg_query($conn, $sql);
        $RowCount = pg_num_rows($result);
        if ($RowCount>0) {
            array_push($Erros,"Email já cadastrado.");
        }

        if(count($Erros)>0) {
            foreach ($Erros as $Erro) {
                echo "$Erro";
            }
        }
        
        else{
        
            $sql = "INSERT INTO dadoscadastro (nome,cpf,email,senha) VALUES ( $1, $2, $3, $4)";
            $stmt = pg_prepare($conn, "insert_statement", $sql);
            if ($stmt) {
                $result = pg_execute($conn, "insert_statement", array($Nome, $Cpf, $Email, $SenhaHash));
                if ($result) {
                    echo "Cadastro feito com sucesso.";
                    header("Location: login.php");
                    exit;
                } else {
                    die("Houve um erro.");
                }
            } else {
                die("Houve um erro.");
            }

        }

    }
?>

<form action="index.php" method="post">

    <p>Nome: <input type="text" name="nome"></p>

    <p>CPF: <input type="number" name="cpf"></p>

    <p>Email: <input type="email" name="email"></p>

    <p>Senha: <input type="password" name="senha"></p>

    <p><input type="submit" value="CADASTRAR" name="enviar"></p>

</form>

<p>Já está registrado? <a href="login.php">Clique aqui!</a></p>
    
</body>

</html>
