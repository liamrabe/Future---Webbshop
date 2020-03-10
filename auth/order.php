<?php

	highlight_string(var_export($_POST, true));

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/CSRF.php";
	$CSRF = new CSRF();

	if(!$CSRF->Validate()) {
		// Ta bort CSRF-token, vi behöver den inte längre.
		$CSRF->Remove();
		die("Din session är ogiltig.");
	}

	// Ta bort CSRF-token, vi behöver den inte längre.
	$CSRF->Remove();

	include "../partials/html_begin.php";
	include "../partials/navbar.php";

	$pdo = $db->Login();
	if(!$pdo) { die("Kunde ansluta till databasen."); }

	if(!$db->IsLoggedIn()) {
		header("location: /login");
	}

	if(isset($_POST["product_id"])) {
		$product_id = $_POST["product_id"];
	}
	else { header("location: /"); }

	$product = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/product/$product_id"));
	$product = $product->product;

	$user = $db->GetUser();

	// Lägg till beställning i databasen.
	$stmt = $pdo->prepare("INSERT INTO orders (product_id, user_id, price) VALUES (:product_id, :user_id, :price)");

	$stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
	$stmt->bindParam(":user_id", $user["id"], PDO::PARAM_INT);

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