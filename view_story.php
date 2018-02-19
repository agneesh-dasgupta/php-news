<!DOCTYPE html>
<html>
    <head>
         <meta charset="utf-8">
        <title> Login page</title>
        <link href="styles.css" rel="stylesheet">
    </head>
</html>
<body>
    <h1>Story View</h1>


<?php
  require 'database.php';
  session_start();
  $story_id = $_POST['storyid'];
  $currentuser = $_SESSION['user_id'];
  //query that will get the important aspects of the story to be displayed

  $isGuest = $_SESSION['isGuest'];

  $stmt = $mysqli->prepare("select title, storytext, link from stories where story_id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    
    $stmt->bind_param('i', $story_id);
    
    $stmt->execute();
    
    $stmt->bind_result($title, $storytext, $link);
    //prints of the information for the story based on the story_id
    while($stmt->fetch()){

        echo "<h2>"  .$title. "</h2>";
        echo "<br>";
        echo "<p>"  .$storytext."</p>";
        echo "<br>";
        echo "<a href = '$link'> Link </a>";
        echo "<br>";
        if(strcmp($isGuest,'true')!=0){
           echo "<form action = 'comment_submit.php' method = POST>";
        echo '<p> Enter comment: </p>'; 
		    echo '<textarea name = "commentText"> </textarea>';
        echo "<label for='viewbutton'></label>";
        echo '<input type = "hidden" name = "storyid" value ="'.$story_id.'" >';
        echo "<input type='submit' id ='viewbutton' value='submit' name='commentSubmit' />";
        echo "</form>";
        }
       
}
    
    $stmt->close();
    
 
    //second query that will display the comments
    $stmt2 = $mysqli->prepare("select username, comment_text, comment_id from comments where storyid=?");
    if(!$stmt2){
        printf("Query Prep Failed: %s\n", $mysqli2->error);
        exit;
    }
    
    $stmt2->bind_param('i', $story_id);
    
    $stmt2->execute();
    
    $stmt2->bind_result($username, $comment_text, $comment_id);
    
    
    //printing off the comments along with buttons in order to delete or edit a comment
    while($stmt2->fetch()){
        echo "<p> Comment Author:" .$username. "</p>";
        //echo "<br>";
        echo "<p>" .$comment_text. "</p>";
        echo "<br>";
        if(strcmp($currentuser,$username)==0){
          echo "<form action = 'news_edit_comment.php' method = POST>";
          echo '<input type = "hidden" name = "comment_text" value ="'.$comment_text.'" >';
          echo "<input type='submit' id ='viewbutton' value='Edit Comment' name='commentSubmit' />";
          echo '<input type = "hidden" name = "comment_id" value ="'.$comment_id.'" >';
          echo "</form>";
          
          echo "<form action = 'news_comment_delete.php' method = POST>";
          echo "<input type='submit' id ='viewbutton' value='Delete Comment' name='commentSubmit' />";
          echo '<input type = "hidden" name = "comment_id" value ="'.$comment_id.'" >';
          echo "</form>";
        }
}
    
    $stmt2->close();
    
?>

</body>
</html>