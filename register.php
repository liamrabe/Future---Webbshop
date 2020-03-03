<?php
	require_once "./lib/database.php";
	$db = new Database();

	include "./partials/html_begin.html";
	//include "./partials/navbar.php";

	$token = bin2hex(random_bytes(32));
	$db->setcookie("token", $token, "20minutes");

?>

<div class="form-body">
	<div class="form-container">
		<form action="/register" autocomplete="off" method="post" id="form" class="form register">

			<input type="hidden" value="<?= $token; ?>" name="token">

			<h1 class="form-title">Bli medlem</h1>

			<label class="input-label" for="firstname">Förnamn</label>
			<input type="text" placeholder="Förnamn" name="firstname" class="input" id="firstname" required>

			<label class="input-label" for="username">Efternamn</label>
			<input type="text" placeholder="Efternamn" name="lastname" class="input" id="efternamn" required>

			<label class="input-label" for="username">Användarnamn</label>
			<input type="text" placeholder="Användarnamn" name="username" class="input" id="username" required>

			<label class="input-label" for="password">Lösenord</label>
			<input type="password" placeholder="Lösenord" name="password" class="input" id="password" required>
			
			<label class="input-label" min="6" max="255" for="email">E-post</label>
			<input type="email" placeholder="E-post" name="email" class="input" id="email" required>
		
			<button type="submit" class="button submit">Bli medlem</button>
			<a class="btn-link" href="/home">Gå tillbaka</a>

			<span class="text">
				Har du ett konto? Logga in
				<a href="/login" class="link">här</a>.
			</span>

		</form>
	</div>
</div>


<?php
	//include "./partials/footer.php";
	include "./partials/html_end.html";
?>