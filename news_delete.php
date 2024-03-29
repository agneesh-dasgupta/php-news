<?php
    require 'database.php';
    session_start();
    $story_id = $_POST['storyid'];
    $_SESSION['storyid'] = $story_id;
    //query that will simply delete something from the stories table based on the id
    //called when pushing delete story in userstories.php
    $stmt = $mysqli->prepare("delete from stories where story_id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    
    $stmt->bind_param('i', $story_id);

    $stmt->execute();
    
    $stmt->close();
    
    header("Location: userstories.php");

?>