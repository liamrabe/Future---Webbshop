<?php

	header("Content-Type: text/xml");
	echo '<?xml version="1.0" encoding="UTF-8"?>';

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();
	if(!$pdo) {
		echo "<error>";
			echo "<message>Kund inte komma åt databasen.</message>";
		echo "</error>";
		die();
	}

	try {

		// Hämta totala mängden inlägg i databasen.
		$total = $stmt = $pdo->query("SELECT count(*) FROM guestbook")->fetchColumn();

		// Max 20 resultat per sida.
		$limit = 20;

		// Antalet sidor tillgängliga.
		$pages = ceil($total / $limit);

		$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
			'options' => array(
				'default'   => 1,
				'min_range' => 1,
			),
		)));

		$offset = ($page - 1) * $limit;
		
		$start = $offset + 1;
		$end = min(($offset + $limit), $total);

		$stmt = $pdo->prepare("SELECT name, message, timestamp FROM guestbook ORDER BY id DESC LIMIT :limit OFFSET :offset");

		$stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
		$stmt->bindParam(":offset", $offset, PDO::PARAM_INT);

		$stmt->execute();

		if($stmt->rowCount() > 0) {

			$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

			echo "<response>";

				echo "<status>200</status>";
				echo "<page>$page</page>";
				if($page != $pages) {
					echo "<nextPage>".floor($page+1)."</nextPage>";
				}
				echo "<lastPage>$pages</lastPage>";

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