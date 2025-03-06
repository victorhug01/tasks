<?php
include $_SERVER['DOCUMENT_ROOT'] . '/tasks/database/connection.php';
if (isset($_POST['add'])) {
    if ($_POST['title'] != "" && $_POST['description'] != "") {
        $title = mysqli_real_escape_string($mysqli, $_POST['title']);
        $date = mysqli_real_escape_string($mysqli, $_POST['date']);
        $time = mysqli_real_escape_string($mysqli, $_POST['time']);
        $selectOption = mysqli_real_escape_string($mysqli, $_POST['select-option']);
        $chooseFile = mysqli_real_escape_string($mysqli, $_POST['choose-file']);
        $description = mysqli_real_escape_string($mysqli, $_POST['description']);
        $optional = mysqli_real_escape_string($mysqli, $_POST['optional']);

        $mysqli->query("INSERT INTO list(
            title, 
            time_shopping, 
            date_shopping, 
            descriptions, 
            image_product,
            option_size,
            optional, 
            fk_id_user) 
        VALUES (
            '{$title}',
            '{$time}',
            '{$date}',
            '{$description}',
            '{$chooseFile}',
            '{$selectOption}',
            '{$optional}',
            '{$_SESSION['userData']['id_user']}'
        )");

        header('Location: ./');
    }
}
?>