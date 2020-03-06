<?php

	header("Content-Type: text/xml");
	echo '<?xml version="1.0" encoding="UTF-8"?>';

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	// Blockera förfrågningar från användare som inte är inloggade.
	if(!$db->IsLoggedIn()) {
		header("location: /");
	}
	
	// Blockera förfrågningar från användare som inte är admins.
	if(!$db->IsAdmin()) {
		header("location: /");
	}

	$pdo = $db->Login();
	if(!$pdo) {
		echo "<response>";
			echo "<status>404</status>";
			echo "<message>Kunde inte ansluta till databasen.</message>";
		echo "</response>";
		die();
	}

	$page = $_GET["page"];
	
	try {

		$pagination = $db->Pagination("users");
		if($page > $pagination["pages"]) {
			header("location: /api/users/".$pagination["pages"]);
		}

		$stmt = $pdo->prepare(
			"SELECT firstname, lastname, username, email, reg_date, avatar FROM users ORDER BY id DESC LIMIT :limit OFFSET :offset
		");

		$stmt->bindParam(":limit", $pagination["limit"], PDO::PARAM_INT);
		$stmt->bindParam(":offset", $pagination["offset"], PDO::PARAM_INT);

		$stmt->execute();

		if($stmt->rowCount() > 0) {

			$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

			echo "<response>";

				echo "<status>200</status>";
				echo "<page>".$pagination["page"]."</page>";
				if($pagination["page"] != $pagination["pages"]) {
					echo "<nextPage>".floor($pagination["page"]+1)."</nextPage>";
				}
				echo "<lastPage>".$pagination["pages"]."</lastPage>";

				echo "<entries>";
					foreach($users as $user) {

						$username = $user["username"];
						$firstname = $user["firstname"];
						$lastname = $user["lastname"];
						$email = $user["email"];
						$registered = $user["reg_date"];
						$avatar = $user["avatar"];

						echo "<entry>";
							echo "<firstname>$firstname</firstname>";
							echo "<lastname>$lastname</lastname>";
							echo "<username>$username</username>";
							echo "<email>$email</email>";
							echo "<registered>$registered</registered>";
							echo "<avatar>$avatar</avatar>";
						echo "</entry>";

					} 
				echo "</entries>";

			echo "</response>";

		}

	}
	catch(PDOException $e) {
		echo "<response>";
			echo "<status>404</status>";
			echo "<message>Inga användare hittades.</message>";
		echo "</response>";
		die();
	}

?>