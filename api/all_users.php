<?php

	header("Content-Type: text/xml");

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();

	$sort = "";
	if(isset($_GET["sort"])) {
		$sort = "ORDER BY reg_date " . $_GET["sort"];
	}

	$stmt = $pdo->prepare(
		"SELECT firstname, lastname, avatar, username, email, reg_date
		FROM users
		$sort
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
			echo '<message>Misslyckades att hätma användare.</message>';
		echo '</error>';
	}


?>