<?php

	header("Content-Type: text/xml");
	echo '<?xml version="1.0" encoding="UTF-8"?>';

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

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

		$pagination = $db->Pagination("guestbook");
		if($page > $pagination["pages"]) {
			header("location: /api/guestbook/entries/".$pagination["pages"]);
		}

		$stmt = $pdo->prepare("SELECT name, message, timestamp FROM guestbook ORDER BY id DESC LIMIT :limit OFFSET :offset");

		$stmt->bindParam(":limit", $pagination["limit"], PDO::PARAM_INT);
		$stmt->bindParam(":offset", $pagination["offset"], PDO::PARAM_INT);

		$stmt->execute();

		if($stmt->rowCount() > 0) {

			$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

			echo "<response>";

				echo "<status>200</status>";
				echo "<page>".$pagination["page"]."</page>";
				if($pagination["page"] != $pagination["pages"]) {
					echo "<nextPage>".floor($pagination["page"]+1)."</nextPage>";
				}
				echo "<lastPage>".$pagination["pages"]."</lastPage>";

				echo "<entries>";
					foreach($entries as $entry) {

						$name = $entry["name"];
						$message = $entry["message"];
						$timestamp = $entry["timestamp"];

						echo "<entry>";
							echo "<name>$name</name>";
							echo "<message>$message</message>";
							echo "<created>$timestamp</created>";
						echo "</entry>";

					} 
				echo "</entries>";

			echo "</response>";

		}

	}
	catch(PDOException $e) {
		echo "<response>";
			echo "<status>404</status>";
			echo "<message>Inga meddelanden hittades.</message>";
		echo "</response>";
		die();
	}

?>