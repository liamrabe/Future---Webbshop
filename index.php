<?php
	require_once "./lib/database.php";
	$db = new Database();

	include "./partials/html_begin.php";
	include "./partials/navbar.php";

?>

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

	<?php $products = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/products")); ?>
	<div class="products" id="produkter">
		<div class="products-wrapper">
			<h1 class="products-title">Våra produkter</h1>
			<?php if($products->status == 200) { ?>
				<?php foreach($products->products->product as $product) { ?>
					<div class="product">
						<div class="product-image" style="background-image: url('<?= $product->image; ?>');"></div>
						<div class="product-info-wrapper">
							<div class="product-info">
								<div class="product-title">
									Future <?= $product->name; ?>
								</div>
								<div class="product-description">
									<?= $product->description; ?>
								</div>
							</div>
							<div class="product-interact">
								<a href="product/<?= $product->url; ?>" class="product-viewproduct">
									<span class="fas fa-laptop"></span>
									Visa produkt
								</a>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } else { ?>
				<div class="error">
					<?= $products->message; ?>
				</div>
			<?php } ?>
		</div>
	</div>

</div>

<?php
	include "./partials/footer.php";
	include "./partials/html_end.html";
?>