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

<div class="form-body register">
	<div class="form-container">
		<form action="/register" autocomplete="off" method="post" id="form" class="form">

			<div style="display:inline-block;width:100%;">

				<input type="hidden" value="<?= $CSRF->token; ?>" name="token">

				<h1 class="form-title">Bli medlem</h1>

				<label class="input-label" for="firstname">Förnamn</label>
				<input type="text" placeholder="Förnamn" name="firstname" class="input" id="firstname" required>

				<label class="input-label" for="lastname">Efternamn</label>
				<input type="text" placeholder="Efternamn" name="lastname" class="input" id="lastname" required>

				<label class="input-label" for="username">Användarnamn</label>
				<input type="text" placeholder="Användarnamn" name="username" class="input" id="username" required>

				<label class="input-label" for="password">Lösenord</label>
				<input type="password" placeholder="Lösenord" name="password" class="input" id="password" required>

				<label class="input-label" min="6" max="255" for="email">E-post</label>
				<input type="email" placeholder="E-post" name="email" class="input" id="email" required>

				<label class="input-label" for="gender">Kön</label>
				<select name="gender" id="gender" class="input">
					<option value="male">Man</option>
					<option value="female">Kvinna</option>
					<option value="other">Annat</option>
				</select>

				<label class="input-label" for="birthday">Födelsedatum</label>
				<input type="date" name="birthday" id="birthday" class="input">

				<div class="form_actions">
					<button type="submit" class="button submit">Bli medlem</button>
				</div>

				<span class="text">
					Har du ett konto? Logga in
					<a href="/login" class="link">här</a>.
				</span>

			</div>

		</form>
	</div>
</div>


<?php
	include "./partials/footer.php";
	include "./partials/html_end.php";
?>