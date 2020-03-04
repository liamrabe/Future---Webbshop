<?php

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	if(!$db->IsAdmin()) {
		header("location: /");
	}

	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_begin.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/admin_navbar.php";

	$pdo = $db->Login();

	$user = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/user/".$db->GetUserID()));

	// Hämta mängden användare i databasen.
	$stmt = $pdo->prepare("SELECT username FROM users");
	$stmt->execute();

	$users = $stmt->fetchAll(PDO::PARAM_STR);

	// Hämta mängden användare som registrerades idag.
	$today = date("Y-m-d");
	$start = "$today 00:00:00.00";
	$end = "$today 23:59:59.99";

	$stmt = $pdo->prepare("SELECT username FROM users WHERE reg_date BETWEEN :start AND :end");
	$stmt->bindParam(":start", $start, PDO::PARAM_STR);
	$stmt->bindParam(":end", $end, PDO::PARAM_STR);

	$stmt->execute();

	$usersToday = $stmt->fetchAll(PDO::PARAM_STR);

?>

<div class="admin">
	<div class="admin-wrapper">
		<div class="admin-title"><?= $user->firstname . " " . $user->lastname; ?></div>
		<section class="admin-section">
			<div class="admin-stats">
				<div class="stats-text">
					<b><?= count($users); ?></b> totala användare
				</div>
				<div class="stats-text">
					<b><?= count($usersToday); ?></b> användare registrerades idag
				</div>
			</div>
		</section>
	</div>
</div>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_end.html"; ?>