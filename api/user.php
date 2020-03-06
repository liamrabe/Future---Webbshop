<?php

	header("Content-Type: text/xml");
	echo '<?xml version="1.0" encoding="UTF-8"?>';

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();

	$key = $_GET["key"];
	$id = $_GET["id"];

	$stmt = $pdo->prepare("SELECT api_key FROM api_keys WHERE api_key = :key");
	$stmt->bindParam(":key", $key, PDO::PARAM_STR);

	$stmt->execute();

	$result = $stmt->fetchAll(PDO::PARAM_STR);
	if(count($result) != 1) {
		echo '<response>';
			echo '<status>404</status>';
			echo '<message>Fel API nyckel använd</message>';
		echo '</response>';
		die();
	}

	$stmt = $pdo->prepare(
		"SELECT id, role, firstname, lastname, avatar, username, email, reg_date
		FROM users WHERE id = :id
	");

	$stmt->bindParam(":id", $id, PDO::PARAM_STR);
	$stmt->execute();

	$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if(count($user) == 1) {

		echo '<response>';
			echo '<status>200</status>';
			echo '<user>';
				echo '<id>'.$user[0]["id"].'</id>';
				echo '<username>'.$user[0]["username"].'</username>';
				echo '<firstname>'.$user[0]["firstname"].'</firstname>';
				echo '<lastname>'.$user[0]["lastname"].'</lastname>';
				echo '<email>'.$user[0]["email"].'</email>';
				echo '<registered>'.$user[0]["reg_date"].'</registered>';
				echo '<avatar>'.$user[0]["avatar"].'</avatar>';
				echo '<role>'.$user[0]["role"].'</role>';
			echo '</user>';
		echo '</response>';

	}
	else {
		echo '<response>';
			echo '<status>404</status>';
			echo '<message>Ingen användare hittad</message>';
		echo '</response>';
	}


?>