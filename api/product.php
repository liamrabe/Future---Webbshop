<?php

	header("Content-Type: text/xml");

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();

	$id = $_GET["id"];

	$stmt = $pdo->prepare("SELECT id, name, description, price, image, url FROM products WHERE id = :id");
	$stmt->bindParam(":id", $id, PDO::PARAM_INT);

	$stmt->execute();

	$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo '<?xml version="1.0" encoding="UTF-8"?>';
	if(count($products) > 0) {
		echo '<response>';
			echo '<status>200</status>';
			foreach($products as $product) {
				echo '<product>';
					echo '<id>'.$product["id"].'</id>';
					echo '<name>'.$product["name"].'</name>';
					echo '<price>'.$product["price"].'</price>';
					echo '<image>../../static/images/'.$product["image"].'.png</image>';
					echo '<url>'.$product["url"].'</url>';
					echo '<description>'.$product["description"].'</description>';
				echo '</product>';
			}
		echo '</response>';
	}
	else {
		echo '<response>';
			echo '<status>404</status>';
			echo '<error>';
				echo '<message>Hittade ingen produkt med det ID\'t.</message>';
			echo '</error>';
		echo '</response>';
	}

?>