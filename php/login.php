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
    <title>Login</title>
</head>

<body>

<?php

    if (isset($_POST["login"])) {
        $Email = $_POST["email"];
        $Senha = $_POST["senha"];
        require_once "database.php";

        $sql = "SELECT * FROM dadoscadastro WHERE email = '$Email'";
        $result = pg_query($conn, $sql);
        $user = pg_fetch_assoc($result);
        if ($user) {
            if (password_verify($Senha, $user["senha"])) {
                session_start();
                $_SESSION["user"] = "yes";
                header("Location: painel.php");
                exit;
            } else {
                echo "Senha não coincidente.";
            }
        } else {
            echo "Email não coincidente.";
        }
    }

?>
    
<form action="login.php" method="post">

    <p>Email: <input type="email" name="email"></p>

    <p>Senha: <input type="password" name="senha"></p>

    <p><input type="submit" value="LOGIN" name="login"></p>

</form>

<p>Ainda não se cadastrou? <a href="index.php">Clique aqui!</a></p>

</body>

</html>
