<?php

	require_once "./lib/database.php";
	$db = new Database();

	include "./partials/html_begin.html";

	$pdo = $db->Login();
	if(!$pdo) { die("Kunde ansluta till databasen."); }

	$stmt = $pdo->prepare("SELECT name, message,timestamp FROM guestbook ORDER BY id DESC");
	try {
		$stmt->execute();
		$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e) { die("Kunde inte hämta gästbok inlägg."); }

	// Skapa en state-variabel.
	$state = bin2hex(random_bytes(20));
	setcookie("state", $state, strtotime("+20min"), "/", "127.0.0.1", true, false);
	
	include "./partials/navbar.php";

?>

	<div class="main">
		<div class="guestbook">
			<h1 class="guestbook-title">Skriv ett meddelande</h1>
			<h3 class="guestbook-sub-title">Alla inlägg är offentliga</h3>
			<form action="/guestbook" method="post" class="guestbook-form">
				<input type="hidden" value="<?= $state; ?>">
				<input type="text" placeholder="Ditt namn" id="name" name="name" required>
				<textarea placeholder="Ditt meddelande" id="message" name="message" required></textarea>
				<button type="submit" id="submit" class="send-btn">Skicka</button>
			</form>
			<div class="guestbook-entries">
				<?php foreach($entries as $entry) { ?>

					<?php
						$name = $entry["name"];
						$message = $entry["message"];
						$timestamp = date("Y-m-d H:i", strtotime($entry["timestamp"]));
						// Använder div över br för enklare styling.
						$message = preg_replace(
							"/\\n/",
							"<div class=\"line-break\"></div>",
							$message
						);
					?>

					<div class="guestbook-entry">
						<div class="entry-title">
							<span class="name"><?= $name; ?></span>
						</div>
						<div class="entry-timestamp"><?= $timestamp; ?></div>
						<div class="entry-message"><?= $message; ?></div>
					</div>

				<?php } ?>

			</div>
		</div>
	</div>

<?php
	include "./partials/footer.php";
	include "./partials/html_end.html";
?>