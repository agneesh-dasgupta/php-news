<?php
    require 'database.php';
    session_start();
  
  $story_id = $_POST['storyid'];
  echo $story_id;
  $stmt = $mysqli->prepare("select title, storytext, link from stories where story_id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    
    $stmt->bind_param('i', $story_id);
    
    $stmt->execute();
    
    $stmt->bind_result($title, $storytext, $link);
    
    while($stmt->fetch()){
        echo "<h2> .$title. </h2>";
        echo "<br>";
        echo "<p> .$storytext. </p>";
        echo "<br>";
        echo "<p> .$link. </p>";        
}
    
    $stmt->close();
    
    $mysqli2 = new mysqli('localhost', 'newsadmin', 'fakenews', 'news');

    if($mysqli2->connect_errno) {
        printf("Connection Failed: %s\n", $mysqli2->connect_error);
	exit;
    }
    
    $stmt2 = $mysqli2->prepare("select username, comment_text where story_id=?");
    if(!$stmt2){
        printf("Query Prep Failed: %s\n", $mysqli2->error);
        exit;
    }
    
    $stmt2->bind_param('i', $story_id);
    
    $stmt2->execute();
    
    $stmt2->bind_result($username, $comment_text);
    
    while($stmt2->fetch()){
        echo "<p> .$username. </p>";
        echo "<br>";
        echo "<p> .$comment_text. </p>";        
}
    
    $stmt2->close();
    
?>