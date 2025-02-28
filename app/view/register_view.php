<?php

include "../../database/connection.php";

$erro = [];

 
if (isset($_POST['confirm'])) {
    if (!isset($_SESSION)) {
        session_start();

        foreach ($_POST as $key => $value) {
            $_SESSION[$key] = $mysqli->real_escape_string($value);
        }

        if (strlen($_SESSION['name']) == 0) {
            $erro[] = "Preencha o nome.";
            echo  $erro[] = "Preencha o nome.";
        }
        if (substr_count($_SESSION['email'], '@' != 1 || substr_count($_SESSION['email'], '.' < 1))) {
            $erro[] = "Preencha o email.";
        }

        if (strlen($_SESSION['password']) < 2 || strlen($_SESSION['password']) > 16) {
            $erro[] = "Preencha sua senha.";
        }

        if (strcmp($_SESSION['password'], $_SESSION['confirm_password']) != 0) {
            $erro[] = "As senhas não conferem.";
        }

        var_dump(count($erro) == 0);
        if (count($erro) == 0) {
            

            $password = md5(md5($_SESSION['password']));

            $sql_code = "INSERT INTO users (
                nome,
                email,
                passwrd)
                VALUES (
                    '$_SESSION[name]',
                    '$_SESSION[email]',
                    '$password'
                )";
            $confirm = mysqli_query( $mysqli, $sql_code);
            if($confirm){
                unset($_SESSION["name"], $_SESSION["email"], $_SESSION["password"], $_SESSION["confirm_password"]);
                echo "<script> location.href='../../index.php?p=home'; </script>";
            }else{
                $erro[] = $confirm;
            }
        }
    }
}


?>


<!DOCTYPE html>
<?php include '../../includes/language.php' ?>

<head>
    <?php include '../../includes/header.php' ?>
    <title>Cadastro</title>
</head>

<body>
    <?php 
    if (count($erro) > 0) {
        echo "<div>";
        foreach ($erro as $value){
            echo ("$value <br>");
        }
        echo "</div>";
    } 
    ?>
    <a href="index.php?p=home">voltar</a>
    <section class="vh-100 w-100 align-items-center justify-content-center">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/navbar.php' ?>
        <form action="" method="POST" class="container d-grid gap-2 col-xl-6 col-lg-6 vh-75">
            <h1>Cadastre-se</h1>
            <div class="form-group">
                <label for="exampleInputName">Nome completo</label>
                <input name="name" type="text" class="form-control" id="exampleInputName" aria-describedby="NameHelp"
                    placeholder="Digite seu nome" required>
                <p class=space></p>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Digite seu email" required>
                <p class=space></p>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Digite sua senha" required>
                <small>A senha deve ter entre 8 e 16 caracteres</small>
                <p class=space></p>
            </div>
            <div class="form-group">
                <label for="exampleInputConfirmPassword2">Senha</label>
                <input name="confirm_password" type="password" class="form-control" id="exampleInputConfirmPassword2"
                    placeholder="Confirme sua senha" required>
                <p class=space></p>
            </div>
            <button name="confirm" type="submit" value="save" class="btn btn-primary">Cadastrar</button>
        </form>
    </section>
</body>

</html>