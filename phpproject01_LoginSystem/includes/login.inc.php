<?php
// session_start();

require_once('../../sampleFiles/path.inc');
require_once('../../sampleFiles/get_host_info.inc');
require_once('../../sampleFiles/rabbitMQLib.inc');
//require_once("dbh.inc.php");
require_once('functions.inc.php');


  // First we get the form data from the URL
  $username = $_POST["username"] ?? "no name";
  $pwd = $_POST["password"] ?? "no password";

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php
  invalidUid($username);


   // Left inputs empty
   if (emptyInputLogin($username, $pwd) === true) {
     header("location: ../login.php?error=emptyinput");
 		exit();
   }

  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  //loginUser($conn, $username, $pwd);
  
  
  $client = new rabbitMQClient("../incFiles/testRabbitMQ.ini","dbServer");
  if (isset($argv[1]))
  {
    $msg = $argv[1];
  }
  else
  {
    $msg = "test message";
  }

  $request = array();
  $request['type'] = "login";
  $request['username'] = $username;
  $request['password'] = $pwd;
  $request['message'] = $msg;
  $response = $client->send_request($request);
  
  echo $response;
  // if(!$response == 0){
	
        // header("location: ../index.php?error=none");
        // exit();
// } 

