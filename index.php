<?php
	require_once "./lib/database.php";
	$db = new Database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="https://192.168.0.5/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://192.168.0.5/js/fontawesome.js"></script>
	<title>Viggo Slutuppgift - Hem</title>
	<meta charset="UTF-8">
</head>
<body>

	<?php include "./partials/navbar.php"; ?>
	<div class="main">
		<div class="banner homepage">
			<div class="banner-container">
				<div class="banner-wrapper">
					<div class="banner-title">future</div>
					<div class="banner-paragraph">
						Stilren design, Stilren framtid
					</div>
				</div>
			</div>
		</div>

		<?php $products = $db->GetProducts(); ?>
		<div class="products">
			<div class="products-wrapper">
				<h1 class="products-title">Våra produkter</h1>
				<?php foreach($products as $product) { ?>
					<div class="product">
						<div class="product-image" style="background-image: url('https://192.168.0.5/image/<?= $product["image"]; ?>.png');"></div>
						<div class="product-info-wrapper">
							<div class="product-info">
								<div class="product-title">
									Future <?= $product["name"]; ?>
								</div>
								<div class="product-price">
									<?= number_format((int)$product["price"], 0, " ", " "); ?> kr
								</div>
								<div class="product-description">
									<?= $product["description"]; ?>
								</div>
							</div>
							<div class="product-interact">
								<button class="product-addtocart">
									<span class="fas fa-shopping-cart"></span>
									Lägg till i varukorg
								</button>
								<a href="product/<?= urlencode($product["name"]); ?>" class="product-viewproduct">
									<span class="fas fa-shopping-cart"></span>
									Visa produkt
								</a>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

	</div>

	<?php include("./partials/footer.php"); ?>

</body>
</html>