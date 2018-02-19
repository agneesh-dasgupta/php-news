<?php
    require 'database.php';
    session_start();
    //takes in variables needed to submit a new comment
    $username = $_SESSION['user_id'];
    $commentText= $_POST['commentText'];
    $story_id = $_POST['storyid'];
   
    //query that inserts new comment into comments table
    $stmt = $mysqli->prepare("insert into comments (username, comment_text, storyid) values (?, ?, ?)"); 
    if(!$stmt){
    	printf("Query Prep Failed: %s\n", $mysqli->error);
    	exit;
    }
    //binding parameters for the query
    $stmt->bind_param('ssi', $username, $commentText, $story_id);
 
    $stmt->execute();
 
    $stmt->close();
    
    //redirects to the main page
    header("Location: main_page.php");

?>