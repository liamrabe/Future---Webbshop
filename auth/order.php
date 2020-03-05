<?php

	require_once "../lib/database.php";
	$db = new Database();

	$pdo = $db->Login();
	if(!$pdo) { die("Kunde ansluta till databasen."); }

	// Verifiera CSRF-token.
	//if(!$db->VerifyCSRFToken()) {
	//	die("Din session är ogiltig.");
	//}

	if(isset($_POST["product_id"])) {
		$product_id = $_POST["product_id"];
	}
	else { header("location: /"); }

	$product = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/product/$product_id"));
	$product = $product->product;

	$user = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/user/".$_COOKIE["access_token"]));
	$user = $user->user;

	// Simulera betalning.
	$payment = rand(0, 1);

	include "../partials/html_begin.php";
	include "../partials/navbar.php";

	// Lägg till beställning i databasen.
	$stmt = $pdo->prepare("INSERT INTO orders (product_id, user_id, price) VALUES (:product_id, :user_id, :price)");

	$stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
	$stmt->bindParam(":user_id", $user->id, PDO::PARAM_INT);

	// Vi sparar priset vid köpet i databasen så användaren inte behöver
	// betala fullpris om dom köpte produkten under rea.
	$stmt->bindParam(":price", $product->price, PDO::PARAM_INT);

	try {
		$result = $stmt->execute();
		include $_SERVER["DOCUMENT_ROOT"] . "/partials/order-success.php";
	}
	catch(PDOException $e) {
		include $_SERVER["DOCUMENT_ROOT"] . "/partials/order-failed.php";
	}

	include "../partials/footer.php";
	include "../partials/html_end.php";

?>