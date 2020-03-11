<?php

	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_begin.php";
	
	// Skicka tillbaka användaren om dom inte är admin.
	if(!$db->IsLoggedIn() && !$db->IsAdmin()) { header("location: /"); }

	include $_SERVER["DOCUMENT_ROOT"] . "/partials/navbar.php";

	$pdo = $db->Login();

	// Dagens datum.
	$today = date("Y-m-d");
	
	$users = [
		// Antalet användare totalt.
		"total" => $pdo->query("SELECT count(*) FROM users")->fetchColumn(),
		// Antalet användare registrerades idag.
		"today" => $pdo->query("SELECT count(*) FROM users WHERE reg_date BETWEEN '$today 00:00:00.00' AND '$today 23:59:59.99'")->fetchColumn()
	];

	$entries = [
		// Hämta antalet gästbok inlägg.
		"total" => $pdo->query("SELECT count(*) FROM guestbook")->fetchColumn(),
		// Hämta antalet gästbok inlägg idag.
		"today" => $pdo->query("SELECT count(*) FROM guestbook WHERE timestamp BETWEEN '$today 00:00:00.00' AND '$today 23:59:59.99'")->fetchColumn(),
	];

	$posts = [
		// Hämta antalet gästbok inlägg.
		"total" => $pdo->query("SELECT count(*) FROM posts")->fetchColumn(),
		// Hämta antalet gästbok inlägg idag.
		"today" => $pdo->query("SELECT count(*) FROM posts WHERE created BETWEEN '$today 00:00:00.00' AND '$today 23:59:59.99'")->fetchColumn(),
	];

	$orders = [
		// Hämta antalet beställningar.
		"total" => $pdo->query("SELECT count(*) FROM orders")->fetchColumn(),
		// Hämta antalet beställningar idag.
		"today" => $pdo->query("SELECT count(*) FROM orders WHERE timestamp BETWEEN '$today 00:00:00.00' AND '$today 23:59:59.99'")->fetchColumn(),
	];

	$comments = [
		// Hämta antalet kommentarer.
		"total" => $pdo->query("SELECT count(*) FROM comments")->fetchColumn(),
		// Hämta antalet kommentarer idag.
		"today" => $pdo->query("SELECT count(*) FROM comments WHERE created BETWEEN '$today 00:00:00.00' AND '$today 23:59:59.99'")->fetchColumn(),
	];

?>

<div class="admin">
	<div class="admin-wrapper">

		<div class="admin-buttons">
			<a href="/blog/new" class="admin-button">
				<span class="fas fa-plus"></span>
				Skriv ett blogginlägg
			</a>
		</div>
		<div class="admin-title">statistik</div>
		<table class="admin-table" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<td></td>
					<td>Totalt</td>
					<td>Idag</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Användare</td>
					<td><?= $users["total"]; ?></td>
					<td><?= $users["today"]; ?></td>
				</tr>
				<tr>
					<td>Gästbok inlägg</td>
					<td><?= $entries["total"]; ?></td>
					<td><?= $entries["today"]; ?></td>
				</tr>
				<tr>
					<td>Forum inlägg</td>
					<td><?= $posts["total"]; ?></td>
					<td><?= $posts["today"]; ?></td>
				</tr>
				<tr>
					<td>Kommentarer</td>
					<td><?= $comments["total"]; ?></td>
					<td><?= $comments["today"]; ?></td>
				</tr>
				<tr>
					<td>Beställningar</td>
					<td><?= $orders["total"]; ?></td>
					<td><?= $orders["today"]; ?></td>
				</tr>
			</tbody>
		</table>

	</div>
</div>

<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/footer.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_end.php";
?>