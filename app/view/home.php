<?php 
?>

<!DOCTYPE html>
<?php include $_SERVER['DOCUMENT_ROOT'].'/tasks/includes/language.php' ?>

<head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/tasks/includes/header.php' ?>
    <title>Home</title>
</head>
<body>
    <h1>Bem vindo(a), <?php echo $_SESSION['userEmail'] ?></h1>
    <h2><a href="index.php?p=logout">Sair</a></h2>
</body>
</html>