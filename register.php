<?php
	require_once "./lib/database.php";
	$db = new Database();

	include "./partials/html_begin.html";
	include "./partials/navbar.php";
	
?>

<div class="form-body">
	<div class="form-container">
		<form action="/register" method="post" class="form register">
			<h1 class="form-title">Bli medlem</h1>
			<input type="text" placeholder="Username" name="username" class="input" id="username" required>
			<input type="password" placeholder="Password" name="password" class="input" id="password" required>
			<input type="email" placeholder="Email" name="email" class="input" id="email" required>
			<button class="button submit">Bli medlem</button>
		</form>
	</div>
</div>


<?php
	include "./partials/footer.php";
	include "./partials/html_end.html";
?>