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
error_reporting(E_ALL & ~E_NOTICE);
$isGuest = $_POST['isGuest'];
      if(strcmp($isGuest,'true')!=0){
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
//	printf("\t<li>%s</li>\n",
//		htmlspecialchars()
//  );
 //echo $story_id;
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