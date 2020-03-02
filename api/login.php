<?php

	require_once "../lib/database.php";
	$db = new Database();

	$pdo = $db->Login();
	if(!$pdo) { die("Kunde ansluta till databasen."); }

	// Verifiera CSRF-token.
	if(!$db->VerifyCSRFToken()) {
		die("Din session är ogiltig.");
	}

	// Stoppa bruteforce attacker med hjälp av APC User Cache.
	$apc_key = "{$_SERVER['SERVER_NAME']}~login:{$_SERVER['REMOTE_ADDR']}";
	$apc_blocked_key = "{$_SERVER['SERVER_NAME']}~login-blocked:{$_SERVER['REMOTE_ADDR']}";
	$tries = (int)apc_fetch($apc_key);
	if ($tries >= 3) {
		header("HTTP/1.1 429 Too Many Requests");
		echo "You've exceeded the number of login attempts. We've blocked IP address {$_SERVER['REMOTE_ADDR']} for a few minutes.";
		exit();
	}

	$success = login($_POST['username'], $_POST['password']);
	if (!$success) {
		apcu_inc($apc_key, $tries+1, 600);  # store tries for 10 minutes
	} else {
		apc_delete($apc_key);
	}

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

		// Ta bort blockering.
		apc_delete($apc_key);
		apc_delete($apc_blocked_key);

		// Spara inloggningsstatus i 30dagar.
		$access_token = $user["access_token"];
		$db->setcookie("access_token", $access_token, "30days");
		header("location: /");

	}
	else {

		$blocked = (int)apc_fetch($apc_blocked_key);

		apc_store($apc_key, $tries+1, pow(2, $blocked+1)*60); # Behåll försök för 2^(x+1) minuter: 2, 4, 8, 16, ...
		apc_store($apc_blocked_key, $blocked+1, 86400); # Behåll nummer av gånger blockerade för 24 hours

		echo "Inkorrekt användarnamn eller lösenord.";
	}

?>