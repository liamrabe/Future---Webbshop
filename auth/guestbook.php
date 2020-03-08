<?php

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/CSRF.php";
	$CSRF = new CSRF();

	if(!$CSRF->Validate()) {
		die("Din session är ogiltig.");
	}

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();
	if(!$pdo) {
		die("Det gick inte att ansluta till databasen, försök igen.");
	}

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