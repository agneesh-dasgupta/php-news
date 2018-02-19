<?php
    require 'database.php';
    //News edit page that has the actual text box that will include the text to be change
    session_start();
    //takes in the storyid and selects the text and the link
    $story_id = $_POST['storyid'];
    $_SESSION['storyid'] = $story_id;
    $stmt = $mysqli->prepare("select title, storytext, link from stories where story_id=?");
    if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
    //binds the variables
    $stmt->bind_param('s', $story_id);

    $stmt->execute();
    //binds results from the query
    $stmt->bind_result($story_text, $link $title);
    
    //will pring out the textboxes that allow user to change the story_text 
    while($stmt->fetch()){
        echo "<form action = 'edit.php' method = POST>";
        echo '<textarea name = "newtitle">'  htmlentities($title)  '</textarea>';
		echo '<textarea name = "newstorytext">' htmlentities($story_text) '</textarea>';
        echo '<textarea name = "newlink">'  htmlentities($link) '</textarea>';
        echo "<label for='viewbutton'></label>";
        echo "<input type='submit' id ='viewbutton' value='Edit Story'/>";
        echo "</form>";
       
}


$stmt->close();
?>