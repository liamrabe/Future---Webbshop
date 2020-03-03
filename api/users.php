<?php

	header("Content-Type: text/xml");

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();

	$amount = $_GET["amount"];

	$stmt = $pdo->prepare(
		"SELECT firstname, lastname, avatar, username, email, reg_date
		FROM users LIMIT $amount
	");
	$stmt->execute();

	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo '<?xml version="1.0" encoding="UTF-8"?>';
	if(count($users) > 0) {
		echo '<users>';
			foreach($users as $user) {
				echo '<user>';
					echo '<username>'.$user["username"].'</username>';
					echo '<firstname>'.$user["firstname"].'</firstname>';
					echo '<lastname>'.$user["lastname"].'</lastname>';
					echo '<email>'.$user["email"].'</email>';
					echo '<registered>'.$user["reg_date"].'</registered>';
					echo '<avatar>'.$user["avatar"].'</avatar>';
				echo '</user>';
			}
		echo '</users>';
	}
	else {
		echo '<error>';
			echo '<message>Ingen användare hittad</message>';
		echo '</error>';
	}


?>