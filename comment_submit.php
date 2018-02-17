<?php
    require 'database.php';
    session_start();
    
    $username = $_SESSION['user_id']
    $commentText= $_POST['commentText'];
    $story_id = $_SESSION['storyid'];
   

    $stmt = $mysqli->prepare("insert into commets (username, comment_text, story_id) values (?, ?, ?)"); 
    if(!$stmt){
    	printf("Query Prep Failed: %s\n", $mysqli->error);
    	exit;
    }
 
    $stmt->bind_param('ssi', $username, $commentText, $story_id);
 
    $stmt->execute();
 
    $stmt->close();
    header("Location: main_page.php");
    exit;


?>