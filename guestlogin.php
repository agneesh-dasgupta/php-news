<?php

    //Changes session variable to reflect guest login

     require 'database.php';
     session_start();
     $_SESSION['isGuest'] = 'true';
     header("Location: main_page.php");

?>