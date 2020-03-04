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
<div class="navbar">
	<ul class="navbar-wrapper">
		<div class="left">
			<li class="nav-item"><a href="/" class="nav-link">Hem</a></li>
			<li class="nav-item">
				<a class="nav-link">
					Vårt företag
					<span class="fas fa-angle-down icon-left"></span>
				</a>
				<ul class="nav-dropdown">
					<li class="dropdown-item">
						<a href="/about" class="dropdown-link">Vår historia</a>
					</li>
					<li class="dropdown-item">
						<a href="/contact" class="dropdown-link">Kontakta oss</a>
					</li>
				</ul>
			</li>
			<li class="nav-item"><a href="/" class="nav-link">Blogg</a></li>
			<li class="nav-item">
				<a class="nav-link">
					Våra produkter
					<span class="fas fa-angle-down icon-left"></span>
				</a>
				<ul class="nav-dropdown">
					<?php foreach($products->product as $product) { ?>
						<li class="dropdown-item">
							<a class="dropdown-link" href="/product/<?= $product->url; ?>">
								<?= $product->name; ?>
							</a>
						</li>
					<?php } ?>
				</ul>
			</li>
			<li class="nav-item"><a href="/guestbook" class="nav-link">Gästbok</a></li>
		</div>
		<div class="right">
			<?php if($db->IsLoggedIn()) { ?>
				<li class="nav-item">
					<a class="nav-link">
						<img class="avatar" src="<?= $user->avatar; ?>">
						<?= $user->username; ?>
						<span class="fas fa-angle-down icon-left"></span>
					</a>
					<ul class="nav-dropdown">
						<li class="dropdown-item">
							<a href="/profile" class="dropdown-link">Profil</a>
						</li>
						<?php if($db->IsAdmin()) { ?>
							<li class="dropdown-item">
								<a href="/admin/overview" class="dropdown-link">
									Admin översikt
								</a>
							</li>
						<?php } ?>
						<li class="dropdown-item">
							<a href="/profile/my-orders" class="dropdown-link">
								Mina beställningar
							</a>
						</li>
						<li class="dropdown-item">
							<a href="/settings" class="dropdown-link">Inställningar</a>
						</li>
						<li class="dropdown-item">
							<a href="/signout" class="dropdown-link">Logga ut</a>
						</li>
					</ul>
				</li>
				<li class="nav-item"><a href="/forum" class="nav-link">Forum</a></li>
			<?php } else { ?>
				<li class="nav-item">
					<a href="/login" class="nav-link">
						Logga in
					</a>
				</li>
				<li class="nav-item">
					<a href="/register" class="nav-link">
						Bli medlem
					</a>
				</li>
			<?php } ?>
		</div>
	</ul>
</div>