<?php

	include $_SERVER["DOCUMENT_ROOT"] . "/lib/CSRF.php";
	$CSRF = new CSRF();

	$CSRF->Set("path", "/order");

	// Generera ett CSRF-token.
	if(!$CSRF->Generate()) {
		die("Din session är ogiltig, ladda om och försök igen.");
	}

	include "../partials/html_begin.php";
	include "../partials/navbar.php";

?>

<div class="product">
	<div class="product-showcase matebook">
		<div class="product-interact">
			<span class="product-price">11 999 kr</span>
			<form action="/order" method="post">
				<input type="hidden" name="token" value="<?= $CSRF->token; ?>">
				<input type="hidden" name="product_id" value="2">
				<button type="submit" id="order-btn" class="product-add-to-cart">
					Beställ
				</button>
			</form>
		</div>
	</div>
	<div class="product-view dark">
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
	<div class="product-view light">
		<div style="display:inline-block;">
			<h1 class="product-title">Fånga ögonblicket med fingrarna.</h1>
			<p class="product-paragraph">
				MateBook är utrustad med en känslig pekskärm och låter dig bläddra,
				zooma, välja och interagera mycket effektivt och intuitivt.
				Nu kan du till och med svepa ner med tre fingrar för att fånga skärmen
				utan problem.
			</p>
		</div>
	</div>
	<div class="product-view dark">
		<div style="display:inline-block;">
			<h1 class="product-title">Elegant, elegant, otroligt bärbar.</h1>
			<p class="product-paragraph">
				En professionell bärbar dator som också är bärbar.
				Den eleganta metallkroppen med utsökt CNC-diamantskärning och
				sandblästbehandling är bara 14,6 mm tunn och väger endast
				1,33 kg, bekvämt att ta med var som helst.
			</p>
		</div>
	</div>
</div>

<?php

	include "../partials/footer.php";
	include "../partials/html_end.php";

?>