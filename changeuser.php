<?php
//Changes password using query 
    require 'database.php';
    session_start();
    $currentUser = $_SESSION['user_id'];
    $newpassword = (string) $_POST['newpassword'];
    
//checks validity
if(!preg_match('/^[\w_\s\-]+$/', $newpassword)){ 
    echo "Invalid changed password";
    exit;
}
$newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
$stmt = $mysqli->prepare("update users set password =? where username =?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('ss', $newpassword, $currentUser);

$stmt->execute();

$stmt->close();
echo(htmlentities("Password successfully changed."));
echo '<a href = "loginnews.html"> Click here to go back to the login page. </a>';
//header("Location: loginnews.html");
   
//header("Location: loginnews.html");

?>