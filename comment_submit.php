<?php
    require 'database.php';
    session_start();
    
    $username = $_SESSION['user_id'];
    $commentText= $_POST['commentText'];
    $story_id = $_SESSION['storyid'];
   
    echo $username;
    echo $commentText;
    echo $story_id;
   
    $stmt = $mysqli->prepare("insert into comments (username, comment_text, storyid) values (?, ?, ?)"); 
    if(!$stmt){
    	printf("Query Prep Failed: %s\n", $mysqli->error);
    	exit;
    }
    $stmt->bind_param('ssi', $username, $commentText, $story_id);
 
    $stmt->execute();
 
    $stmt->close();
    header("Location: main_page.php");
    //exit;


?>