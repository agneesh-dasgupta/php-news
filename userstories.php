<?php
    require 'database.php';
    
    session_start();
    
    $tempUsername = $_SESSION['user_id'];
    
    $stmt = $mysqli->prepare("select storytext from stories where username=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }   
    
    $stmt->bind_param('s', $tempUsername);

    $stmt->execute();

    $stmt->bind_result($storyText);
    
    echo "<ul>\n";
    while($stmt->fetch()){
        printf("\t<li>%s</li>\n",
		htmlspecialchars($storyText)
	);
    }
    echo "</ul>\n";

    $stmt->close();
    
?>