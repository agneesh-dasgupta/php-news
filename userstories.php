<?php
    require 'database.php';
    
    session_start();
    echo '<form action = "addstory.html">';
    echo '<input type = "submit" name = "addstory" value = "Add Story">';
    echo '</form>';
    $tempUsername = $_SESSION['user_id'];
    $stmt = $mysqli->prepare("select story_id, storytext, title from stories where username=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }   
    
    $stmt->bind_param('s', $tempUsername);

    $stmt->execute();

    $stmt->bind_result($story_id, $storyText, $title);
    
    echo "<ul>\n";
    while($stmt->fetch()){
        printf("\t<li>%s<br>%s</li>\n",
        htmlspecialchars($title),
		htmlspecialchars($storyText)
	);
        echo '<form name = "input" action = "news_edit.php" method = "POST">';
        echo '<input type = "submit" name = "submit" value="Edit">';
        echo '<input type = "hidden" name = "storyid" value ="'.$story_id.'" >';
        echo '</form>';
        echo '<form name = "input" action = "news_delete" method = "POST">';
        echo '<input type = "submit" name = "submit" value="delete">';
        echo '<input type = "hidden" name = "storyid" value ="'.$story_id.'" >';
        echo '</form>';
    }
    echo "</ul>\n";
    echo '<form name = "input" action = "main_page.php">';
    echo '<input type = "submit" name = "backtomain" value = "Back to main page">';
    echo '</form>';

    $stmt->close();
    
?>