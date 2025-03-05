<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<nav class="navbar navbar-light p-3">
    <a class="navbar-brand" href="index.php?p=home">
        <img src="public/images/bag.png" width="30" height="30" class="d-inline-block align-top" alt="">
        MYList
    </a>    

    <?php if (isset($_SESSION['userData'])):?>
        <a href="index.php?p=logout"><img src="https://cdn-icons-png.flaticon.com/128/1286/1286853.png" alt="" style="height: 20px"></a>
    <?php endif; ?>
</nav>