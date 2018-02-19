<?php
    require 'database.php';
    session_start();
    $story_id = $_SESSION['storyid'];
    $newstorytext = $_POST['newstorytext'];
    $newlink = $_POST['newlink'];
    
     $stmt = $mysqli->prepare("update comments comment_text=? where comment_id=?");
    if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
    }

    $stmt->bind_param('si', $comment_text, $comment_id);

    $stmt->execute();

    $stmt->close();
    header("Location: main_page.php");
    
?>