<!DOCTYPE html>
    <html>
        <head>
           <title>
            Main page
           </title> 
        </head>
        <body>
    <p>
        
    </p>
     <?php
require 'database.php';
session_start();
$isGuest = $_POST['isGuest'];
      if(strcmp($isGuest,'true')!=0){
       echo '<form action = "userstories.php">';
      echo '<input type = "submit" value = "View user stories" />';
      echo '</form>';
       
      }
$stmt = $mysqli->prepare("select storytext, link from stories order by story_id");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($story_text, $link);

echo "<ul>\n";
while($stmt->fetch()){
	printf("\t<li>%s</li>\n",
		htmlspecialchars($story_text)
      );
 echo '<a href ="'.$link.'"> Link </a>';
 
 echo "<form action = 'comment_submit.php' method = POST>";
	echo '<textarea name = "commentText">' . $comment_text . '</textarea>';
 echo "<label for='viewbutton'></label>";
 echo "<input type='submit' id ='viewbutton' value='Submit Comment'/>";
 echo "</form>";
}
echo "</ul>\n";

$stmt->close();
            ?>
          
        </body>
    </html>