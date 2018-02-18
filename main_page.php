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
      
$stmt = $mysqli->prepare("select title from stories order by story_id");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($title);

echo "<ul>\n";
while($stmt->fetch()){
//	printf("\t<li>%s</li>\n",
//		htmlspecialchars()
//  );
  
 echo "<form action = 'view_story.php' method = POST>";
 echo '<a href= "view_story.php"> '.$title.' </a>';
 echo "</form>";
}
echo "</ul>\n";


$stmt->close();

            ?>
          
        </body>
    </html>