<?php
//start session if closed and unset username and password and redirect to index page
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION["username"]);
    unset($_SESSION["id"]);
    header("Location: ../../index.php");