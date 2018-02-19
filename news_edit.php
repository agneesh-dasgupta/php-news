<!DOCTYPE html>
<html>
    <head>
         <meta charset="utf-8">
        <title> Login page</title>
        <link href="styles.css" rel="stylesheet">
    </head>

<body>
    <h1>Story Editing</h1>

<?php
    require 'database.php';
    //News edit page that has the actual text box that will include the text to be change
    session_start();
    //takes in the storyid and selects the text and the link
    $story_id = (int) $_POST['storyid'];
    $_SESSION['storyid'] = $story_id;
    $stmt = $mysqli->prepare("select title, storytext, link from stories where story_id=?");
    if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
    //binds the variables
    $stmt->bind_param('i', $story_id);

    $stmt->execute();
    //binds results from the query
    $stmt->bind_result($title, $storytext, $link);
    
    //will pring out the textboxes that allow user to change the story_text 
    while($stmt->fetch()){
        echo "<form action = 'edit.php' method = POST>";
        echo htmlentities("Title:");
;        echo '<textarea name = "newtitle">'  .$title. '</textarea>';
        echo htmlentities("Story Text:");
		echo '<textarea name = "newstorytext">' .$storytext. '</textarea>';
        echo htmlentities("Link:");
        echo '<textarea name = "newlink">'  .$link. '</textarea>';
        echo "<label for='viewbutton'></label>";
        echo "<input type='submit' id ='viewbutton' value='Edit Story'/>";
        echo "</form>";
       
}


$stmt->close();
?>
</body>
</html>