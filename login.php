<?php

	include $_SERVER["DOCUMENT_ROOT"] . "/lib/CSRF.php";
	$CSRF = new CSRF();

	// Generera ett CSRF-token.
	if(!$CSRF->Generate()) {
		die("Din session är ogiltig, ladda om och försök igen.");
	}

	include "./partials/html_begin.php";
	include "./partials/navbar.php";

?>

<div class="form-body login">
	<div class="form-container">
		<form action="/login" id="form" autocomplete="off" method="post" id="form" class="form">

			<input type="hidden" name="token" value="<?= $CSRF->token; ?>">

			<h1 class="form-title">Logga in</h1>

			<label class="input-label" min="3" max="30" for="username">Användarnamn</label>
			<input type="text" id="username" placeholder="Användarnamn" name="username" class="input" id="username" required>
			
			<label class="input-label" for="password">Lösenord</label>
			<input type="password" id="password" placeholder="Lösenord" name="password" class="input" id="password" required>

			<div class="form_actions">
				<button type="submit" class="button submit">Bli medlem</button>
			</div>

			<span class="text">
				Har du inget konto? bli medlem
				<a href="/register" class="link">här</a>.
			</span>

		</form>
	</div>
</div>

<?php
	include "./partials/footer.php";
	include "./partials/html_end.php";
?>