<?php
	require_once "./lib/database.php";
	$db = new Database();

	include "./partials/html_begin.html";
	//include "./partials/navbar.php";
	
?>

<div class="form-body">
	<div class="form-container">
		<form action="/register" method="post" class="form register">

			<h1 class="form-title">Logga in</h1>

			<label class="input-label" for="username">Användarnamn</label>
			<input type="text" placeholder="Användarnamn" name="username" class="input" id="username" required>
			
			<label class="input-label" for="password">Lösenord</label>
			<input type="password" placeholder="Lösenord" name="password" class="input" id="password" required>

			<button class="button submit">Logga in</button>
			<a class="btn-link" href="/home">Gå tillbaka</a>

			<span class="text">
				Har du inget konto? Registrera dig
				<a href="/register" class="link">här</a>
			</span>

		</form>
	</div>
</div>


<?php
	//include "./partials/footer.php";
	include "./partials/html_end.html";
?>