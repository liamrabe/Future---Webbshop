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

	if($db->IsLoggedIn()) {
		$username = $db->GetUsername();
	}

?>
<div class="navbar">
	<div class="navbar-wrapper">
		<div class="left">
			<a href="/home" class="nav-link">Hem</a>
			<a href="/about" class="nav-link">Om oss</a>
			<a href="/home#produkter" class="nav-link">Våra produkter</a>
			<a href="/blog" class="nav-link">Blogg</a>
			<a href="/contact" class="nav-link">Kontakt</a>
			<a href="/guestbook" class="nav-link">Gästbok</a>
			<a href="/forum" class="nav-link">Forum</a>
		</div>
		<div class="right">
			<?php if($db->IsLoggedIn()) { ?>
				<a href="/cart" class="nav-link">
					<span class="fas fa-shopping-cart"></span>
					<span class="item-count">0</span>
				</a>
				<a href="/profile/<?= $username; ?>" class="nav-link">Min profil</a>
				<?php if($db->IsAdmin()) { ?>
					<a href="/admin/dashboard" class="nav-link">Admin översikt</a>
				<?php } ?>
				<a href="/signout" class="nav-link">Logga ut</a>
			<?php } else { ?>
				<a href="/login" class="nav-link">Logga in</a>
				<a href="/register" class="nav-link">Bli medlem</a>
			<?php } ?>
		</div>
	</div>
</div>