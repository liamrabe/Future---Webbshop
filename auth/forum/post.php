<?php

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/CSRF.php";
	$CSRF = new CSRF();

	if(!$CSRF->Validate()) {
		die("Din session är ogiltig.");
		$CSRF->Remove();
	}

	// Ta bort CSRF-token, vi behöver den inte längre.
	$CSRF->Remove();

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	if(!$db->IsLoggedIn()) {
		header("location: /forum/1");
	}

	$pdo = $db->Login();
	if(!$pdo) { die("Kunde ansluta till databasen."); }

	$requiredinputs = [
		"title",
		"content"
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

	$user_id = $db->GetUserID();

	// Här har vi verifierat alla inputs och filtrerat dom
	// så nu kan vi lägga till dom i databasen.
	$stmt = $pdo->prepare(
		"INSERT INTO forum_posts (title, content, user_id)
		VALUES (:title, :content, :id)
		"
	);

	$stmt->bindParam(":title", $title, PDO::PARAM_STR);
	$stmt->bindParam(":content", $content, PDO::PARAM_STR);
	$stmt->bindParam(":id", $user_id, PDO::PARAM_STR);

	try {
		$stmt->execute();
		header("location: /forum/1");
	}
	catch(PDOException $e) {
		echo $e->getMessage()."<br>";
		die("Någonting gick fel, försök igen.");
	}

?>