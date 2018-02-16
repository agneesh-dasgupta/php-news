<?php
    require 'database.php';
    session_start();
    
    $story_id = $_POST['storyid'];
    //echo $story_id;
    
    $stmt = $mysqli->prepare("delete from stories where story_id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    
    $stmt->bind_param('s', $story_id);

    $stmt->execute();

    
    $stmt->close();
    
    header("Location:userstories.php");

?>