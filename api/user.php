<?php

	header("Content-Type: text/xml");

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();

	$id = $_GET["id"];

	$stmt = $pdo->prepare(
		"SELECT firstname, lastname, avatar, username, email, reg_date
		FROM users WHERE id = :id
	");

	$stmt->bindParam(":id", $id, PDO::PARAM_STR);
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
		echo '</user>';
	}
	else {
		echo '<error>';
			echo '<message>Ingen användare hittad</message>';
		echo '</error>';
	}


?>