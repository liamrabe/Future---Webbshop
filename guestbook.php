<?php

	include "./partials/html_begin.php";

	// Spara token i cookie innan headers har skickats.
	$token = bin2hex(random_bytes(32));
	$db->setcookie("token", $token, "20minutes");

	include "./partials/navbar.php";

	if(!isset($_GET["page"])) {
		$page = 1;
	}
	else {
		$page = $_GET["page"];
	}

	$entries = new SimpleXMLElement(file_get_contents("https://liam.se/api/guestbook/entries/$page"));

	if($entries->status == 200) {
		// Skicka användaren till sista sidan om
		// dom går för långt.
		if($page > $entries->lastPage) {
			header("location: /guestbook/".$entries->lastPage);
		}
	}

?>

	<div class="main">
		<div class="guestbook">

			<h1 class="guestbook-title">Skriv ett meddelande</h1>
			<h3 class="guestbook-sub-title">Alla inlägg är offentliga</h3>

			<form action="/guestbook" autocomplete="off" method="post" class="guestbook-form">
				<input type="hidden" name="token" value="<?= $token; ?>">
				<input type="text" placeholder="Ditt namn" id="name" name="name" required>
				<textarea placeholder="Ditt meddelande" id="message" name="message" required></textarea>
				<button type="submit" id="submit" class="send-btn">Skicka</button>
			</form>

			<div class="guestbook-entries">

				<?php
					if($entries->status == 200) {
						foreach($entries->entries->entry as $entry) {

							$message = preg_replace(
								"/\\n/",
								"<div class=\"line-break\"></div>",
								$entry->message
							);

							echo "<div class=\"guestbook-entry\">";
								echo "<div class=\"entry-title\">";
									echo "<span class=\"name\">$entry->name</span>";
								echo "</div>";
								echo "<div class=\"entry-timestamp\">";
									echo date("Y-m-d", strtotime($entry->created));
								echo "</div>";
								echo "<div class=\"entry-message\">$message</div>";
							echo "</div>";
						}
						if($entries->lastPage != 1) {
							echo "<div class=\"pagination\">";
								echo "<div class=\"pagination-page\">$entries->page / $entries->lastPage</div>";
								echo "<div class=\"pagination-links\">";
									if($page > 1) {
										echo "<a class=\"pagination-link\" href=\"/guestbook/".floor($page - 1)."\">Förgående sida</a>";
									}
									if($page < $entries->lastPage) {
										echo "<a class=\"pagination-link\" href=\"/guestbook/".floor($page + 1)."\">Nästa sida</a>";
									}
								echo "</div>";
							echo "</div>";
						}
					}
					else if($entries->status == 404) {
						echo "<div class=\"message\">$entries->message</div>";
					}
				?>

			</div>
		</div>
	</div>

<?php
	include "./partials/footer.php";
	include "./partials/html_end.php";
?>