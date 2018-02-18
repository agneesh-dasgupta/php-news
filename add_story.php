<?php
    require 'database.php';
    session_start();
    $storyText = $_POST['storytext'];
    $tempUsername = $_SESSION['user_id'];
    $link = $_POST['link'];
    $title = $_POST['title'];
    $stmt = $mysqli->prepare("insert into stories (storytext, username, link, title) values (?,?,?, ?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    
    
    $stmt->bind_param('ssss', $storyText, $tempUsername, $link, $title);

    $stmt->execute();

    $stmt->close();
    
    header("Location:userstories.php");
    
?>