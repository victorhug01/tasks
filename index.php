<?php

session_start();
if (isset($_GET['p']) && $_GET['p'] === 'logout') {
    session_unset();
    session_destroy();
    header('Location: index.php?p=login');
    exit();
}
?>

<!DOCTYPE html>
<?php include './includes/language.php' ?>

<head>
    <?php include './includes/header.php' ?>
</head>

<body>
    <section class=main>
        <?php
        if (isset($_GET['p'])) {
            $page = $_GET['p'] . ".php";
            if (is_file("app/view/$page")) {
                include "app/view/$page";
            } else {
                include 'configs/not_found_page.php';
            }
        } else {
            if (!isset($_SESSION['userEmail'])) {
                include 'app/view/login.php';
                exit();
            } else {
                include 'app/view/home.php';
                exit();
            }
        }
        ?>
    </section>
</body>

</html>