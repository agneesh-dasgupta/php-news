<?php
    require 'database.php';
    session_start();
    $storyText = $_POST['storytext'];
    $tempUsername = $_SESSION['user_id'];
    $link = $_POST['link'];
    $stmt = $mysqli->prepare("insert into stories (storytext, username, link) values (?,?,?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    
    
    $stmt->bind_param('sss', $storyText, $tempUsername, $link);

    $stmt->execute();

    $stmt->close();
    
    header("Location:userstories.php");
    
?>