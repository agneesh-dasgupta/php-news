<?php
require 'database.php';

session_start();
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
if( !preg_match('/^[\w_\-]+$/', $username) ){
            echo htmlentities("Invalid new username");
            exit;
}
$stmt = $mysqli->prepare("select username from users");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
     
    $stmt->execute();
    $stmt->bind_result($founduser);
    while($stmt->fetch()){
        if(strcmp($founduser,$username)==0) {
            echo "Username is already taken";
            exit;
        }
    }
$stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)"); 
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('ss', $username, $password);
 
$stmt->execute();
 
$stmt->close();
echo "User successfully created.";
echo '<a href = "loginnews.html"> Click here to go back to the login page. </a>'; 
exit;
?>