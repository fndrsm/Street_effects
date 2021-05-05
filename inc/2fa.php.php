<?php
 
// require the autoloader that composer created
require_once 'vendor/autoload.php';
 
// use the firebase JWT Library previous installed using composer
use \Firebase\JWT\JWT;
 
// create a class for easy code structure and use
class userAuth {
	// create a dummy user for the tutorial
private $user = array(
  "id" => 768,
  "email" => "code.wolf@ghostffco.de",
  "password" => "ThisIsAPassword"
);

// create an empty id variable to hold the user id
private $id;
 
// key for JWT signing and validation, shouldn't be changed
private $key = "secretSignKey";

// Checks if the user exists in the database
private function validUser($email, $password) {
  // doing a user exists check with minimal to no validation on user input
  if ($email == $this->user['email'] && $password == $this->user['password']) {
    // Add user email and id to empty email and id variable and return true
    $this->id = $this->user['id'];
    
    $this->email = $this->user['email'];
    
    return true;
  } else {
    
    return false;
  }
}

// Generates and signs a JWT for User
private function genJWT() {
  // Make an array for the JWT Payload
  $payload = array(
    "id" => $this->id,
    "email" => $this->email,
    "exp" => time() + (60 * 60)
  );
 
  // encode the payload using our secretkey and return the token
  return JWT::encode($payload, $this->key);
}

// sends signed token in email to user if the user exists
public function mailUser($email, $password) {
  // check if the user exists
  if ($this->validUser($email, $password)) {
    // generate JSON web token and store as variable
    $token = $this->genJWT();
    // create email
    $message = 'http://ghostffco.de/index.php?token='.$token;
    
    $mail = mail($this->email,"Authentication From ghostffco.de",$message);
    
    // if the email is successful, send feedback to user
    if ($mail) {
      
      return 'We Just Sent You An Email With Your Login Link';
    } else {
      
      return 'An Error Occurred While Sending The Email';
    }
  } else {
    
    return 'We Couldn\'t Find You In Our Database. Maybe Wrong Email/Password Combination';
  }
  
}
}

 
?>

