<!DOCTYPE html>
    <html>
        <head>
           <meta charset="utf-8">
           <title> User Page </title>
           <link href="styles.css" rel="stylesheet">
        </head>
        <body>
<h1>User's news hub</h1>
<?php
    //page for user that shows only their stories
    require 'database.php';
    
    session_start();
    //ability to add a story
    echo '<form action = "addstory.html">';
    echo '<input type = "submit" name = "addstory" value = "Add Story">';
    echo '</form>';
    $tempUsername = $_SESSION['user_id'];
    //echo $tempUsername;
    //exit;
    //selects the info for the stories by the logged in user
    $stmt = $mysqli->prepare("select story_id, storytext, title from stories where username=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }   
    
    $stmt->bind_param('s', $tempUsername);

    $stmt->execute();

    $stmt->bind_result($story_id, $storyText, $title);
    
    echo "<ul>\n";
    //prints of the title and text for each story
    while($stmt->fetch()){
        printf("\t<li>%s<br>%s</li>\n",
        htmlspecialchars($title),
		htmlspecialchars($storyText)
	);
        //will print of buttons that have the option of editting a story or deleting it 
        echo '<form name = "input" action = "news_edit.php" method = "POST">';
        echo '<input type = "submit" name = "submit" value="Edit">';
        echo '<input type = "hidden" name = "storyid" value ="'.$story_id.'" >';
        echo '</form>';
        echo '<form name = "input" action = "news_delete.php" method = "POST">';
        echo '<input type = "submit" name = "submit" value="delete">';
        echo '<input type = "hidden" name = "storyid" value ="'.$story_id.'" >';
        echo '</form>';
    }
    echo "</ul>\n";
    // back to main button
    echo '<form name = "input" action = "main_page.php">';
    echo '<input type = "submit" name = "backtomain" value = "Back to main page">';
    echo '</form>';

    $stmt->close();
    
?>
    </body>
</html>