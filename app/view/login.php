<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include $_SERVER['DOCUMENT_ROOT'] . '/tasks/database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['userEmail']) || empty($_POST['userPassword'])) {
        $_SESSION['not_authenticated'] = "Erro: Email ou senha não preenchidos.";
        header('Location: ../../index.php?p=login');
        exit();
    } else {

        $userEmail = mysqli_real_escape_string($mysqli, $_POST['userEmail']);
        $userPassword = mysqli_real_escape_string($mysqli, $_POST['userPassword']);

        $query = "SELECT id_user, email, nome FROM users WHERE email = '{$userEmail}' AND passwrd = MD5(MD5('{$userPassword}'))";
        $result = mysqli_query($mysqli, $query);
        $row = mysqli_num_rows($result);
        $userData = mysqli_fetch_assoc($result);

        if ($row == 1) {
            $_SESSION['userData'] = $userData;
            header('Location: ./');
            exit();
        } else {
            $_SESSION['not_authenticated'] = "Erro: Usuário ou senha inválidos.";
            header('Location: ./');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/language.php' ?>

<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/header.php' ?>
    <title>Login</title>
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/navbar.php' ?>
    <section class="d-flex w-100 align-items-center justify-content-center" style="height: calc(100vh - 100px);">
        <form action="" method="POST" class="container d-grid gap-2 col-xl-4 col-lg-4 vh-75">
            <h1>Login</h1>
            <?php
            if (isset($_SESSION['not_authenticated'])):
                ?>
                <div class="d-flex w-100 align-items-center justify-content-center text-white bg-danger py-3"
                    style="height: 6vh;">
                    <?php echo $_SESSION['not_authenticated']; ?>
                </div>
                <?php
                unset($_SESSION['not_authenticated']);
            endif;
            ?>
            <div class="form-group mb-4">
                <label for="exampleInputEmail1">Email</label>
                <input name="userEmail" type="email" class="form-control border border-primary" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Digite seu email" required>
            </div>
            <div class="form-group mb-4">
                <label for="exampleInputPassword1">Senha</label>
                <input name="userPassword" type="password" class="form-control border border-primary"
                    id="exampleInputPassword1" placeholder="Digite sua senha" required>
            </div>
            <button name="confirm" type="submit" value="save" class="btn btn-primary">Conectar</button>
            <a href="index.php?p=register" class="text-center">Não tem uma conta? Cadastre-se.</a>
        </form>
    </section>
</body>

</html>