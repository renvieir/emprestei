<?php

//require "bd_connection.php";

$app->get("/createUser/:name/:email/:pwd", "createUser");
$app->get("/updateUser/:name/:email/:pwd", "updateUser");
$app->get("/getUserInfo/:email", "getUserInfo");
$app->get("/removeUser/:email", "removeUser");

function createUser($nome, $mail, $pass) {

	global $userTable;

	/* lendo dados da mensagem com json
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	if (!$body) { // fail!
		$response["status"] = $status;
		echo json_encode($response);
		return;
	}

	$json = json_decode($request->getBody());
	$name = $json->name;
	$email = $json->email;
	$pwd = $json->pwd;
	*/

	$name = $nome; $email = $mail; $pwd = $pass;
	$response["status"] = 1;
	$dbh = getConnection();
	$sql = "insert into $userTable (email, nome, senha) values
														(:email, :name, :pwd)";

	try {
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(":email", $email);
		$stmt->bindParam(":name", $name);
		$stmt->bindParam(":pwd", $pwd);
		$stmt->execute();
	} catch (PDOException $e) {
		$response["status"] = 0;
	}

	closeConnection($dbh);
	echo json_encode($response);
	return;
}

function updateUser($nome, $mail, $pass) {

	global $userTable;

	/* lendo dados da mensagem com json
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	if (!$body) { // fail!
		$response["status"] = $status;
		echo json_encode($response);
		return;
	}

	$json = json_decode($request->getBody());
	$name = $json->name;
	$email = $json->email;
	$pwd = $json->pwd;
	*/

	$name = $nome; $email = $mail; $pwd = $pass;
	$response["status"] = 1;
	$dbh = getConnection();
	$sql = "update $userTable set email = :email, nome = :name, senha = :pwd
														where email = :email";

	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":name", $name);
	$stmt->bindParam(":pwd", $pwd);
	$stmt->execute();

	closeConnection($dbh);
	echo json_encode($response);
	return;
}

function getUserInfo($mail) {

	global $userTable;

	/* lendo dados da mensagem com json
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	if (!$body) { // fail!
		$response["status"] = $status;
		echo json_encode($response);
		return;
	}

	$json = json_decode($request->getBody());
	$email = $json->email;
	*/

	$response["status"] = 0;

	$email = $mail;
	$dbh = getConnection();
	$sql = "select * from $userTable where email = :email";
	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(":email", $email);
	$stmt->execute();

	/* get user information as a associative array */
	$tmp = $stmt->fetchAll(PDO::FETCH_CLASS);

	if (!empty($tmp)) {
		foreach ($tmp[0] as $key => $value)
			$response[$key] = ($value) ? $value: null;
		$response["status"] = 1;
	}

	closeConnection($dbh);
	echo json_encode($response);
	return;
}

function removeUser($mail) {

	global $userTable;

	/* lendo dados da mensagem com json
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	if (!$body) { // fail!
		$response["status"] = $status;
		echo json_encode($response);
		return;
	}

	$json = json_decode($request->getBody());
	$email = $json->email;
	*/

	$email = $mail;
	$response["status"] = 1;
	$dbh = getConnection();
	$sql = "delete from $userTable where email = :email";

	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(":email", $email);
	$stmt->execute();

	closeConnection($dbh);
	echo json_encode($response);
	return;
}

?>
