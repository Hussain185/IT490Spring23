#!/usr/bin/php
<?php
require_once('sampleFiles/path.inc');
require_once('sampleFiles/get_host_info.inc');
require_once('sampleFiles/rabbitMQLib.inc');
require_once('mysqlConnect.php');

function doLogin($username,$password)
{
	$query = "SELECT * FROM users WHERE usersUid='$username' AND usersPwd='$password'";
	$result = mysqli_query(dbConnection(), $query);
    echo $result;
	//return true;
	//return false if not valid
}

function requestProcessor($request)
{
	echo "received request".PHP_EOL;
	var_dump($request);
	if(!isset($request['type']))
	{
		return "ERROR: unsupported message type";
	}
	switch ($request['type'])
	{
		case "login":
			return doLogin($request['username'],$request['password']);
		case "validate_session":
			return doValidate($request['sessionId']);
		case "signup":

	}
	return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("db.ini",'dbServer');

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
