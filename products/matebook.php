<?php

	include $_SERVER["DOCUMENT_ROOT"] . "/lib/CSRF.php";
	$CSRF = new CSRF();

	// Generera ett CSRF-token.
	if(!$CSRF->Generate()) {
		die("Din session är ogiltig, ladda om och försök igen.");
	}

	include "../partials/html_begin.php";
	include "../partials/navbar.php";

?>

<div class="product">
	<div class="product-showcase" style="background-image:url('https://<?= $_SERVER["SERVER_NAME"] ?>/product/MateBook/image/matebook.jpg');">
		<div class="product-interact">
			<span class="product-price">11 999 kr</span>
			<button class="product-add-to-cart">
				Lägg till i varukorg
			</button>
		</div>
	</div>
	<div class="product-view">
		<div style="display:inline-block;">
			<h1 class="product-title">En skärm som låter dig se bredare och ljusare.</h1>
			<p class="product-paragraph">
				Med det anmärkningsvärda 91% skärm-till-kropp-förhållandet1,
				ger 3K FullView-skärmen dig en massiv bild med levande
				detaljer. Bildformatet 3: 2 är perfekt för att läsa och
				skriva. Och det 100% sRGB2 breda färgutbudet gör bilder och
				videor mer levande och realistiska som om de var verkliga.
			</p>
		</div>
	</div>
</div>

<?php
	//include "../partials/footer.php";
	include "../partials/html_end.php";
?>