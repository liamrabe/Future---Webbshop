<?php

	header("Content-Type: text/xml");

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();

	$stmt = $pdo->prepare(
		"SELECT id, name, description, price, image, url, banner FROM products"
	);
	$stmt->execute();

	$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo '<?xml version="1.0" encoding="UTF-8"?>';
	if(count($products) > 0) {
		echo '<response>';
			echo '<status>200</status>';
			echo '<products>';
			foreach($products as $product) {
				echo '<product>';
					echo '<id>'.$product["id"].'</id>';
					echo '<name>'.$product["name"].'</name>';
					echo '<price>'.$product["price"].'</price>';
					echo '<image>../../static/images/'.$product["image"].'.png</image>';
					echo '<banner>../../static/images/'.$product["banner"].'.png</banner>';
					echo '<url>'.$product["url"].'</url>';
					echo '<description>'.$product["description"].'</description>';
				echo '</product>';
			}
			echo '</products>';
		echo '</response>';
	}
	else {
		echo '<response>';
			echo '<status>404</status>';
			echo '<message>Misslyckades att hätma användare.</message>';
		echo '</response>';
	}


?>