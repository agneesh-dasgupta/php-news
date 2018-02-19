<!DOCTYPE html>
    <html>
        <head>
           <meta charset="utf-8">
           <title> Main page </title>
           <link href="styles.css" rel="stylesheet">
        </head>
        <body>
         <h1>Main Stories Page</h1>
     <?php

      require 'database.php';
      session_start();
      $isGuest = $_SESSION['isGuest'];

   
      //Only available if registered user
      if(strcmp($isGuest,'true')!=0){
      echo '<a href = "changeusername.php"> Change password </a>';
      echo '<br>';
      echo '<a href = "deleteuser.php"> Delete current user </a>';
      echo htmlentities(' You will be logged out and your username will be deleted.');
      echo '<br>';
      echo '<a href="news_logout.php"> Logout </a>';
      echo '<form action = "userstories.php">';
      echo '<input type = "submit" value = "Add/View User stories" />';
      echo '</form>';
       $currentUser = $_SESSION['user_id'];
       
      }
      if(strcmp($isGuest,'true')==0){
       $currentUser = "";
       echo '<a href = "loginnews.html"> Log In/Sign Up </a>';
      }
      //query that will select the title and the storyid
      $stmt = $mysqli->prepare("select title, story_id from stories order by story_id");
      if(!$stmt){
      printf("Query Prep Failed: %s\n", $mysqli->error);
      exit;
      }
       


      
$stmt = $mysqli->prepare("select title, story_id from stories order by story_id");
if(!$stmt){
printf("Query Prep Failed: %s\n", $mysqli->error);
exit;
}


       $stmt->execute();

       $stmt->bind_result($title, $story_id);

       echo "<ul>\n";
       while($stmt->fetch()){
        //will print off the title of the news story with a button that allows one to view the news story with comments
        echo $title;
        echo '<form name = "input" action = "view_story.php" method = "POST">';
        echo '<input type = "submit" name = "submit" value="View Story">';
        echo '<input type = "hidden" name = "storyid" value ="'.$story_id.'" >';
        echo '</form>';
       }
       echo "</ul>\n";


       $stmt->close();

        ?>
        </body>
    </html>