<?php

	require "../lib/database.php";
	$db = new Database();

	$requiredinputs = [
		"name",
		"message"
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

		// Ta bort alla HTML-taggar från våra inputs.
		${$input} = strip_tags(${$input});

	}

	// Om användaren inte har en state-cookie kan vi anta
	// att dom är en bot och skicka dom till Gästbok startsidan.
	if(!isset($_COOKIE["state"]) || empty($_COOKIE["state"])) {
		header("location: /guestbook");
	}

	// Om användaren inte har en state-cookie kan vi anta
	// att dom är en bot och skicka dom till Gästbok startsidan.
	if(!isset($_POST["state"]) || empty($_POST["state"])) {
		header("location: /guestbook");
	}

	$state = $_POST["state"];

	if($state == $_COOKIE["state"]) {
		die("Din session har gått ut, gå tillbaka och försök igen.");
	}

	$pdo = $db->Login();
	if(!$pdo) {
		die("Det gick inte att ansluta till databasen, försök igen.");
	}

	// Förbered databasen.
	$stmt = $pdo->prepare("INSERT INTO guestbook (name, message) VALUES (:name,:message)");

	$stmt->bindParam(":name", $name, PDO::PARAM_STR);
	$stmt->bindParam(":message", $message, PDO::PARAM_STR);

	try {
		// Försök köra SQL koden.
		$res = $stmt->execute();
		header("location: /guestbook");
	}
	catch(PDOException $e) { die("Någonting gick fel, försök igen."); }

?>