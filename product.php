<?php

	require_once "./lib/database.php";
	$db = new Database();

	$product = $db->GetProduct(urldecode($_GET["name"]));
	$product = $product[0];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="https://192.168.0.5/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://192.168.0.5/js/fontawesome.js"></script>
	<title>Future - <?= $product["name"]; ?></title>
	<meta charset="UTF-8">
</head>
<body>

	<div class="navbar">
		<div class="navbar-wrapper">
			<div class="left">
				<a href="/home" class="nav-link">Hem</a>
				<a href="/about" class="nav-link">Om oss</a>
				<a href="#produkter" class="nav-link">Produkter</a>
				<a href="/blog" class="nav-link">Blogg</a>
				<a href="/contact" class="nav-link">Kontakt</a>
				<a href="/guestbook" class="nav-link">Gästbok</a>
			</div>
			<div class="right">
				<a href="/cart" class="nav-link">
					<span class="fas fa-shopping-cart"></span>
					<span class="item-count">0</span>
				</a>
				<a href="/register" class="nav-link">Skapa konto</a>
				<a href="/login" class="nav-link">Logga in</a>
			</div>
		</div>
	</div>
	<div class="product_banner" style="
		background-image:url('https://liam.se/image/<?= $product["banner"]; ?>');
		background-color:<?= $product["color"]; ?>;
		background-size:<?= $product["bgSize"]; ?>;
	">
		<div class="banner-container">
			<div class="banner-wrapper">
				<div class="banner-title"><?= $product["name"]; ?></div>
				<div class="banner-paragraph"><?= $product["tagline"]; ?></div>
			</div>
		</div>
	</div>

	<div class="main">
	</div>

	<div class="footer">
		<div class="footer-wrapper">
			<div class="left">
				<div class="footer-title">future</div>
				<div class="sitemap">
					<div class="sitemap-title">Översikt</div>
					<a href="/" class="sitemap-link">Home</a>
					<a href="/" class="sitemap-link">Home</a>
					<a href="/" class="sitemap-link">Home</a>
					<a href="/" class="sitemap-link">Home</a>
					<a href="/" class="sitemap-link">Home</a>
					<a href="/" class="sitemap-link">Home</a>
					<a href="/" class="sitemap-link">Home</a>
				</div>
			</div>
			<div class="right">
				
			</div>
			<div class="copyright">
				&copy; Viggo Stenroth & Future - 2020
			</div>
		</div>
	</div>
</body>
</html>