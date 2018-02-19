

<?php
//PHP code to add a story to th main page
    require 'database.php';
    session_start();
    //takes in all the things needed to add a story to the stories table
    $storyText = $_POST['storytext'];
    $tempUsername = $_SESSION['user_id'];
    $link = $_POST['link'];
    $title = $_POST['title'];
    $stmt = $mysqli->prepare("insert into stories (storytext, username, link, title) values (?,?,?, ?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    
    //binds the variables from the query
    $stmt->bind_param('ssss', $storyText, $tempUsername, $link, $title);

    $stmt->execute();

    $stmt->close();
    //will redirect back to the user's main stories page 
    header("Location:userstories.php");
    
?>