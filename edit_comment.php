<?php
    require 'database.php';
    session_start();
    
    $comment_text = $_POST['comment_text'];
    $comment_id = $_POST['comment_id'];
    //query that will simply update the comments table with the new text baed on the comment_id
     $stmt = $mysqli->prepare("update comments set comment_text=? where comment_id=?");
    if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
    }

    $stmt->bind_param('si', $comment_text, $comment_id);

    $stmt->execute();

    $stmt->close();
    header("Location: main_page.php");
    
?>