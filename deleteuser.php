<?php
//Deletes a user using a query
session_start();
require 'database.php';
$currentUser = $_SESSION['user_id'];
$stmt = $mysqli->prepare("delete from users where username=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('s', $currentUser);
$stmt->execute();

$stmt->close();
echo htmlentities("User has been successfully deleted");
echo '<a href = "loginnews.html"> Click here to go back to the login page. </a>';
?>