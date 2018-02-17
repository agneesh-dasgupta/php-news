<?php
    require 'database.php';
    session_start();
    $story_id = $_SESSION['storyid'];
    $newstorytext = $_POST['newstorytext'];
    $newlink = $_POST['newlink'];
    
     $stmt = $mysqli->prepare("update stories set storytext=?, link=? where story_id=?");
    if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
    }

    $stmt->bind_param('sss', $newstorytext, $newlink, $story_id);

    $stmt->execute();

    $stmt->close();
    header("Location: userstories.php");
    
?>