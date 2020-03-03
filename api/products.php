<?php

	header("Content-Type: text/xml");

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();

	$stmt = $pdo->prepare(
		"SELECT name, description, price, image, url FROM products"
	);
	$stmt->execute();

	$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo '<?xml version="1.0" encoding="UTF-8"?>';
	if(count($products) > 0) {
		echo '<products>';
			foreach($products as $product) {
				echo '<product>';
					echo '<name>'.$product["name"].'</name>';
					echo '<price>'.$product["price"].'</price>';
					echo '<image>../../static/images/'.$product["image"].'.png</image>';
					echo '<url>'.$product["url"].'</url>';
					echo '<description>'.$product["description"].'</description>';
				echo '</product>';
			}
		echo '</products>';
	}
	else {
		echo '<error>';
			echo '<message>Misslyckades att hätma användare.</message>';
		echo '</error>';
	}


?>