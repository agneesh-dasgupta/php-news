<?php
    //main php to edit stories
    //Takes in the storyid for the story being changed
    require 'database.php';
    session_start();
    $story_id = $_SESSION['storyid'];
    $newstorytext = (string) $_POST['newstorytext'];
    $newlink = (string) $_POST['newlink'];
    $newtitle = (string) $_POST['newtitle'];
    
    $stmt = $mysqli->prepare("update stories set title=?, storytext=?, link=? where story_id=?");
    if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
    }
    //binds the variables from the query
    $stmt->bind_param('ssss', $newtitle, $newstorytext, $newlink, $story_id);

    $stmt->execute();

    $stmt->close();
    //redirects back to the users story page
    header("Location: userstories.php");
    
?>