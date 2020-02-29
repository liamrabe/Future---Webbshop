<?php
	require_once "./lib/database.php";
	$db = new Database();

	include "./partials/html_begin.html";

?>

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
		<div class="products" id="produkter">
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
								<div class="product-description">
									<?= $product["description"]; ?>
								</div>
							</div>
							<div class="product-interact">
								<button class="product-addtocart">
									<span class="fas fa-shopping-cart"></span>
									Lägg till i varukorg
									<b>
										<?= number_format((int)$product["price"], 0, " ", " "); ?> kr
									</b>
								</button>
								<a href="product/<?= $product["url"]; ?>" class="product-viewproduct">
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

	<?php
		include "./partials/footer.php";
		include "./partials/html_end.html";
	?>