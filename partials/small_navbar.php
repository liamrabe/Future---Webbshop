<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";

	// Kolla om variabel db finns och är en instans av Database-klassen.
	if(isset($db)) {
		if(!$db instanceof Database) {
			$db = new Database();
		}
	}
	else {
		$db = new Database();
	}

	$products = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/products"));
	$products = $products->products;

	if($db->IsLoggedIn()) {
		$user = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/user/".$_COOKIE["access_token"]));
		$user = $user->user;
	}

?>
<div class="small_navbar">
	<div class="navbar-bar">
		<button class="navbar-toggle-button" id="toggleNav">
			<span class="fas fa-bars"></span>
			meny
		</button>
	</div>
	<div class="navbar-links" id="navbar">
		<a href="/" class="nav-link">Hem</a>
		<a href="/about" class="nav-link">Om oss</a>
		<a href="/" class="nav-link">Produkter</a>
		<a href="/blog" class="nav-link">Blogg</a>
		<?php if($db->IsLoggedIn()) { ?>
			
		<?php } ?>
	</div>
</div>