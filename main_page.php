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
$stmt = $mysqli->prepare("select storytext, link from stories order by story_id");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($story_text, $link);

echo "<ul>\n";
while($stmt->fetch()){
	printf("\t<li>%s %s</li>\n",
		htmlspecialchars($story_text),
		htmlspecialchars($link)
	);
}
echo "</ul>\n";

$stmt->close();
            ?>
          
        </body>
    </html>