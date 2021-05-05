<?php
 
// require our class file
require_once 'inc/2fa.php';
 
// create a class instance
$auth = new userAuth();
 
// check if form was submitted
if (!empty($_POST)) {
  $email = $_POST['email'];
  $pswd = $_POST['password'];
 
  //.......
  // do your data santization and validation here
  // Like check if values are empty or contain invalid characters
  //.......
 
  // If everything is valid, send the email
  $msg = $auth->mailUser($email, $pswd);
 
}
 
?>