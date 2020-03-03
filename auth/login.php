<?php

	require_once "../lib/database.php";
	$db = new Database();

	$pdo = $db->Login();
	if(!$pdo) { die("Kunde ansluta till databasen."); }

	// Verifiera CSRF-token.
	if(!$db->VerifyCSRFToken()) {
		die("Din session är ogiltig.");
	}

	$requiredinputs = [
		"username",
		"password"
	];

	foreach($requiredinputs as $input) {

		// Först kollar vi om våran input är tom.
		if(!isset($_POST[$input])) { die("Inkorrekt användarnamn eller lösenord."); }
		// Sedan kollar vi om den är tom.
		if(empty($_POST[$input])) { die("Inkorrekt användarnamn eller lösenord."); }

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
		die("Inkorrekt användarnamn eller lösenord.");
	}

	// Kolla om e-post addressen redan finns i databasen.
	$stmt = $pdo->prepare("SELECT username, password, access_token FROM users WHERE username = :username");
	$stmt->bindParam(":username", $username, PDO::PARAM_STR);

	$stmt->execute();
	$user = $stmt->fetchAll(PDO::PARAM_STR)[0];

	if(password_verify($password, $user["password"])) {

		// Spara inloggningsstatus i 30dagar.
		$access_token = $user["access_token"];
		$db->setcookie("access_token", $access_token, "30days");
		header("location: /");

	}
	else {
		die("Inkorrekt användarnamn eller lösenord.");
	}

?>