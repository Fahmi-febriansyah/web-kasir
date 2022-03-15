<?php 

    session_start();

    session_unset();
    session_destroy();

    if( !isset($_SESSION['loginAdmin']) ) {

        header("Location: login.php");
        exit;

    }

?>