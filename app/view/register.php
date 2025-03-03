<?php
include $_SERVER['DOCUMENT_ROOT']."/tasks/database/connection.php";

$erro = [];

if (isset($_POST['confirm'])) {
    // Verifica se a sessão foi iniciada
    if (!isset($_SESSION)) {
        session_start();
    }

    // Sanitiza os dados
    $name = $mysqli->real_escape_string($_POST['name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validações
    if (strlen($name) == 0) {
        $erro[] = "Preencha o nome.";
    }
    if (substr_count($email, '@') != 1 || substr_count($email, '.') < 1) {
        $erro[] = "Preencha o email corretamente.";
    }
    if (strlen($password) < 8 || strlen($password) > 16) {
        $erro[] = "A senha deve ter entre 8 e 16 caracteres.";
    }
    if ($password !== $confirm_password) {
        $erro[] = "As senhas não conferem.";
    }

    // Se não houver erros, insere no banco
    if (count($erro) == 0) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Hash da senha

        $sql_code = "INSERT INTO users (nome, email, passwrd) VALUES ('$name', '$email', '$passwordHash')";
        $confirm = mysqli_query($mysqli, $sql_code);

        if ($confirm) {
            echo "<script> location.href='index.php?p=home'; </script>";
        } else {
            $erro[] = "Erro ao cadastrar, tente novamente mais tarde.";
        }
    }
}

?>

<!DOCTYPE html>
<?php include $_SERVER['DOCUMENT_ROOT'].'/tasks/includes/language.php' ?>

<head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/tasks/includes/header.php' ?>
    <title>Cadastro</title>
</head>

<body>
    <?php
    if (count($erro) > 0) {
        echo "<div>";
        foreach ($erro as $value) {
            echo ("$value <br>");
        }
        echo "</div>";
    }
    ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/navbar.php' ?>
    <section class="w-100 d-flex align-items-center justify-content-center" style="height: calc(100vh - 100px);">
        <form action="" method="POST" class="container d-grid gap-2 col-xl-5 col-lg-5 vh-75">
            <h1 class="mb-4">Cadastre-se</h1>
            <div class="form-grou">
                <label for="exampleInputName">Nome completo</label>
                <input name="name" type="text" class="form-control border border-primary" id="exampleInputName" aria-describedby="NameHelp"
                    placeholder="Digite seu nome" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="email" class="form-control border border-primary" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Digite seu email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input name="password" type="password" class="form-control border border-primary" id="exampleInputPassword1"
                    placeholder="Digite sua senha" required>
                <small>A senha deve ter entre 8 e 16 caracteres</small>
            </div>
            <div class="form-group">
                <label for="exampleInputConfirmPassword2">Confirmar senha</label>
                <input name="confirm_password" type="password" class="form-control border border-primary" id="exampleInputConfirmPassword2"
                    placeholder="Confirme sua senha" required>
            </div>
            <button name="confirm" type="submit" value="save" class="btn btn-primary">Cadastrar</button>
            <a href="index.php?p=login" class="text-center">Já possui uma conta? Conecte-se.</a>
        </form>
    </section>
</body>

</html>
