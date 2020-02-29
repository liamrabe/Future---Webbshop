<?php
	require_once "./lib/database.php";
	$db = new Database();

	include "./partials/html_begin.html";

?>

	<?php include "./partials/navbar.php"; ?>
	<div class="main">
		<div class="guestbook">
			<h1 class="guestbook-title">Skriv ett meddelande</h1>
			<form action="/guestbook/create" method="post" class="guestbook-form">
				<input type="text" placeholder="Ditt namn" id="name" name="name" required>
				<textarea placeholder="Ditt meddelande" id="message" name="message" required></textarea>
				<button type="submit" id="submit" class="send-btn">Skicka</button>
			</form>
			<div class="guestbook-entries">
			</div>
		</div>
	</div>

<?php
	include "./partials/footer.php";
	include "./partials/html_end.html";
?>