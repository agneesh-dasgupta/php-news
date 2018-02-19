<!DOCTYPE html>
    <html>
        <head>
           <title>
            Main page
           </title> 
        </head>
        <body>
     <?php

      require 'database.php';
      session_start();
      $isGuest = $_SESSION['isGuest'];
      $currentUser = $_SESSION['user_id'];
      echo '<a href="news_logout.php"> Logout </a>';
      //guest options
      if(strcmp($isGuest,'true')!=0){
       echo '<form action = "userstories.php">';
      echo '<input type = "submit" value = "View user stories" />';
      echo '</form>';
       
      }
      //query that will select the title and the storyid
      $stmt = $mysqli->prepare("select title, story_id from stories order by story_id");
      if(!$stmt){
      	printf("Query Prep Failed: %s\n", $mysqli->error);
      	exit;
      }
require 'database.php';
session_start();
$isGuest = $_SESSION['isGuest'];
if(strcmp($isGuest,'true')!=0){
 $currentUser = $_SESSION['user_id'];
 echo '<a href="news_logout.php"> Logout </a>';
 echo '<form action = "userstories.php">';
 echo '<input type = "submit" value = "View user stories" />';
  echo '</form>';
       
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