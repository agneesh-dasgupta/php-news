<?php
    require 'database.php';
    $story_id = $_POST['storyid'];
    $stmt = $mysqli->prepare("select storytext, link from stories where story_id=?");
    if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
    $stmt->bind_param('s', $story_id);

    $stmt->execute();

    $stmt->bind_result($story_text, $link);

    while($stmt->fetch()){
		echo "<textarea name = 'newstorytext'> '.$story_text.' </textarea>";
        echo "<textarea name = 'newlink'> '.$link.' </textarea>";
       
}
 echo "<form action = 'edit.php' method = POST>";
        echo "<label for='viewbutton'></label>";
        echo "<input type='submit' id ='viewbutton' value='Edit Story'/>";
        echo "</form>";

$stmt->close();
?>