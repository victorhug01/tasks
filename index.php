<!DOCTYPE html>
<?php include './includes/language.php' ?>

<head>
    <?php include './includes/header.php' ?>
    <title>cadastro de usuários</title>
</head>

<body>
    <section class=principal>
        <?php
        if(isset($_GET['p'])){
            $page = $_GET['p'].".php";
            if(is_file("/app/view/$page")){
                include "app/view/$page";
            }else{
                include 'configs/not_found_page.php';
            }
        }else{
            include 'app/view/login_view.php';
        }

        ?>
    </section>
</body>

</html>