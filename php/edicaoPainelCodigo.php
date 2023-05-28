<?php

session_start();
$conn = pg_connect("host=localhost dbname=projetopit user=postgres password=123");

if (isset($_POST["enviar2"])) {
    $id2 = $_POST["id2"];
    $nome2 = $_POST["nome2"];
    $cpf2 = $_POST["cpf2"];
    $email2 = $_POST["email2"];
    $senha2 = $_POST["senha2"];
    $senhaHash2 = password_hash($senha2, PASSWORD_DEFAULT);

    $erros2 = array();

    if (empty($nome2) || empty($cpf2) || empty($email2) || empty($senha2)) {
        array_push($erros2, "É necessário que todos os campos sejam preenchidos!");
    }

    if (strlen($cpf2) != 11) {
        array_push($erros2, "CPF inválido.");
    }

    if (!filter_var($email2, FILTER_VALIDATE_EMAIL)) {
        array_push($erros2, "O e-mail não é válido.");
    }

    if (strlen($senha2) < 8) {
        array_push($erros2, "A senha deve conter pelo menos 8 caracteres.");
    }

    if (count($erros2) > 0) {
        foreach ($erros2 as $erro) {
            echo $erro;
        }
    } else {
        $sql_query = "UPDATE dadoscadastro SET nome='$nome2', cpf='$cpf2', email='$email2', senha='$senhaHash2' WHERE id='$id2' ";
        $sql_query_run = pg_query($conn, $sql_query);

        if ($sql_query_run) {
            $_SESSION["status"] = "Dados atualizados com sucesso.";
            header("Location: edicaoPainelBase.php");
        } else {
            echo "Erro ao executar a consulta: " . pg_last_error($conn);
            $_SESSION["status"] = "Não atualizado.";
            header("Location: edicaoPainelBase.php");
        }
    }
}

?>

