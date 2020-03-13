<?php

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/CSRF.php";
	$CSRF = new CSRF();

	if(!$CSRF->Validate()) {
		// Ta bort CSRF-token, vi behöver den inte längre.
		$CSRF->Remove();
		die("Din session är ogiltig.");
	}

	// Ta bort CSRF-token, vi behöver den inte längre.
	$CSRF->Remove();

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();
	if(!$pdo) { die("Kunde ansluta till databasen."); }

	$requiredinputs = [
		"firstname",
		"lastname",
		"email",
		"gender",
		"birthday",
		"username",
		"password"
	];

	foreach($requiredinputs as $input) {

		// Först kollar vi om våran input är tom.
		if(!isset($_POST[$input])) { die("Icke-komplett formluär."); }

		// Sedan kollar vi om den är tom.
		if(empty($_POST[$input])) { die("Icke-komplett formulär."); }

		// Om våra variabler finns och inte är tomma kan vi
		// börja processera dom.

		// Skriv över variabel från POST till lokal variabel.
		${$input} = $_POST[$input];

		// Filtrera inputs.
		${$input} = strip_tags(${$input});
		${$input} = trim(${$input});

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

	// Verifiera att användarens födelesedag är ett korrekt datum.
	$d = DateTime::createFromFormat("Y-m-d", $birthday);
	$validDate = $d && $d->format($birthday) === $birthday;
	if(!$validDate) {
		die("Ogiltigt datum");
	}

	// Verifiera om användaren är över 13år.
	$age = floor((time() - strtotime($birthday)) / 31557600);
	if($age <= 13) {
		die("Du måste vara äldre än 13 år.");
	}

	// Hämta Gravatar avatar baserat på email.
	$avatar = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email)));

	// Hasha lösenord och verifiera hashen.
	$hash = password_hash($password, PASSWORD_BCRYPT);
	if(!password_verify($password, $hash)) {
		die("Misslyckades att verifiera lösenordet.");
	}

	// Ta bort lösenordet.
	unset($password);

	// Generera ett 255-bitars åtkomstnyckel.
	$access_token = bin2hex(openssl_random_pseudo_bytes(255));

	$stmt = $pdo->prepare(
		"INSERT INTO users (
			avatar, firstname, lastname, username, email, password, gender, birthday, access_token
		)
		VALUES (
			:avatar, :firstname, :lastname, :username, :email, :password, :gender, :birthday, :access_token
		)
	");

	$stmt->bindParam(":avatar", $avatar, PDO::PARAM_STR);
	$stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
	$stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
	$stmt->bindParam(":username", $username, PDO::PARAM_STR);
	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
	$stmt->bindParam(":password", $hash, PDO::PARAM_STR);
	$stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
	$stmt->bindParam(":birthday", $birthday, PDO::PARAM_STR);
	$stmt->bindParam(":access_token", $access_token, PDO::PARAM_STR);

	$result = $stmt->execute();

	if($result) { header("location: /login"); }
	else { echo "Din förfrågan misslyckades, försök igen."; }

?>