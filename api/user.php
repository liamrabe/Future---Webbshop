<?php

	//header("Content-Type: text/xml");

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();

	$key = $_GET["key"];

	$stmt = $pdo->prepare(
		"SELECT id, role, firstname, lastname, avatar, username, email, reg_date
		FROM users WHERE access_token = :key
	");

	$stmt->bindParam(":key", $key, PDO::PARAM_STR);
	$stmt->execute();

	$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo '<?xml version="1.0" encoding="UTF-8"?>';
	if(count($user) == 1) {

		echo '<user>';
			echo '<username>'.$user[0]["username"].'</username>';
			echo '<firstname>'.$user[0]["firstname"].'</firstname>';
			echo '<lastname>'.$user[0]["lastname"].'</lastname>';
			echo '<email>'.$user[0]["email"].'</email>';
			echo '<registered>'.$user[0]["reg_date"].'</registered>';
			echo '<avatar>'.$user[0]["avatar"].'</avatar>';
			echo '<role>'.$user[0]["role"].'</role>';
		echo '</user>';

	}
	else {
		echo '<response>';
			echo '<status>404</status>';
			echo '<message>Ingen användare hittad</message>';
		echo '</response>';
	}


?>