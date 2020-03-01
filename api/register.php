<?php

	require_once "../lib/database.php";
	$db = new Database();

	$pdo = $db->Login();
	if(!$pdo) { die("Kunde ansluta till databasen."); }

	$requiredinputs = [
		"email",
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
	if(count($result) == 1) { die("Användarnamnet finns redan."); }

	// Kolla om e-post addressen redan finns i databasen.
	$stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
	$stmt->bindParam(":email", $email, PDO::PARAM_STR);

	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if(count($result) == 1) { die("E-post addressen är redan registrerad."); }

	// Verifiera användarnamnet innehåller alfanumeriska-karaktärer inklusive - och _.
	if(!preg_match("/([a-zA-Z0-9\-_]+)/", $username)) {
		die("Användarnamnet får bara innehålla alfanumeriska karaktärer inklusive - och _");
	}

	// Verifiera om emailen har ett giltig format.
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		die("Ogiltig e-post address.");
	}

	// Hasha lösenord och verifiera hashen.
	$hash = password_hash($password, PASSWORD_BCRYPT);
	if(!password_verify($password, $hash)) {
		die("Misslyckades att verifiera lösenordet.");
	}

	// Ta bort lösenordet.
	unset($password);

	$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
	$stmt->bindParam(":username", $username, PDO::PARAM_STR);
	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
	$stmt->bindParam(":password", $hash, PDO::PARAM_STR);

	$result = $stmt->execute();

	if($result) { header("location: /login"); }
	else { echo "Din förfrågan misslyckades, försök igen."; }

?>