<?php 
require('../connect/connect.php');
require('functions.php');
if(isRole()){
    $sql = "DELETE FROM `lessons` WHERE `id` = " . $_GET['id'];
    $state = $database->prepare($sql);
    $state->execute();
    header('Location: /?page=updateCourse&id=' . $_GET['courseid']);
    die();
}
?>