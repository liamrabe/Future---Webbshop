<?php

	require_once "../lib/database.php";
	$db = new Database();

	$pdo = $db->Login();
	if(!$pdo) { die("Kunde ansluta till databasen."); }

	$requiredinputs = [
		"username",
		"password"
	];

	foreach($requiredinputs as $input) {

		// Först kollar vi om våran input är tom.
		if(!isset($_POST[$input])) { die("$input måste existera."); }
		// Sedan kollar vi om den är tom.
		if(empty($_POST[$input])) { die("$input får inte vara tom."); }

		// Om våra variabler finns och inte är tomma kan vi
		// börja processera dom.

		// Skriv över variabel från POST till lokal variabel.
		${$input} = $_POST[$input];

		// Filtrera inputs.
		${$input} = strip_tags(${$input});

	}

	// Kolla om användarnamnet redan finns i databasen.
	$stmt = $pdo->prepare("SELECT username FROM users WHERE username = :username");
	$stmt->bindParam(":username", $username, PDO::PARAM_STR);

	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if(count($result) == 0) { die("Inkorrekt användarnamn eller lösenord."); }

	// Verifiera användarnamnet innehåller alfanumeriska-karaktärer inklusive - och _.
	if(!preg_match("/([a-zA-Z0-9\-_]+)/", $username)) {
		die("Användarnamnet får bara innehålla alfanumeriska karaktärer inklusive - och _");
	}

	// Kolla om e-post addressen redan finns i databasen.
	$stmt = $pdo->prepare("SELECT username, password, access_token FROM users WHERE username = :username");
	$stmt->bindParam(":username", $username, PDO::PARAM_STR);

	$stmt->execute();
	$user = $stmt->fetchAll(PDO::PARAM_STR)[0];

	if(password_verify($password, $user["password"])) {
		// Spara inloggningsstatus i 30dagar.
		$access_token = $user["access_token"];
		setcookie("token", $access_token, strtotime("+30days"), "/", "127.0.0.1", true, false);
		header("location: /");
	}
	else {
		echo "Inkorrekt användarnamn eller lösenord.";
	}

?>