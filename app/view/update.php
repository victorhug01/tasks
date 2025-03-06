<?php
include $_SERVER['DOCUMENT_ROOT'] . '/tasks/database/connection.php';

if($_GET['task_id'] != ""){
    $task_id = $_GET['task_id'];
   
    $mysqli->query("UPDATE `list` SET `status` = 'Done' WHERE `id_list` = $task_id") or die(mysqli_errno($mysqli));
    header('location: ../../');
}
?>