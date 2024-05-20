<?php 
    session_start();
    ob_start();
    session_destroy();
    header('location: ../view/index.php');
    exit();

?>