
<?php
require 'database.php';
session_start();
    // Use a prepared statement
$stmt = $mysqli->prepare("SELECT COUNT(*), username, password FROM users WHERE username=?");

// Bind the parameter
$stmt->bind_param('s', $user);
$user = $_POST['username'];
$isGuest = (string) $_POST['isGuest'];
$_SESSION['isGuest'] = $isGuest;
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();

$pwd_guess = $_POST['password'];
// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
	$_SESSION['user_id'] = $user_id;
	header("Location:main_page.php");
} else{
	// Login failed; redirect back to the login screen
    header("Location:loginnews.html");
}
    ?>