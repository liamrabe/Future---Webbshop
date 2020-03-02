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
		<form action="/login" id="form" autocomplete="off" method="post" id="form" class="form register">

			<input type="hidden" name="token" value="<?= $token; ?>">

			<h1 class="form-title">Logga in</h1>

			<label class="input-label" min="3" max="30" for="username">Användarnamn</label>
			<input type="text" id="username" placeholder="Användarnamn" name="username" class="input" id="username" required>
			
			<label class="input-label" for="password">Lösenord</label>
			<input type="password" id="password" placeholder="Lösenord" name="password" class="input" id="password" required>

			<button type="submit" class="button submit">Logga in</button>
			<a class="btn-link" href="/home">Gå tillbaka</a>

			<span class="text">
				Har du inget konto? Registrera dig
				<a href="/register" class="link">här</a>
			</span>

		</form>
	</div>
</div>

<script src="https://127.0.0.1/js/loginform.js"></script>
<?php
	//include "./partials/footer.php";
	include "./partials/html_end.html";
?>