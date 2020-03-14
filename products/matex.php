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
	<div class="product-showcase matex">
		<div class="product-interact">
			<span class="product-price">14 999 kr</span>
			<form action="/order" method="post">
				<input type="hidden" name="token" value="<?= $CSRF->token; ?>">
				<input type="hidden" name="product_id" value="1">
				<button type="submit" id="order-btn" class="product-add-to-cart">
					Beställ
				</button>
			</form>
		</div>
	</div>
	<div class="product-view dark">
		<div style="display:inline-block;width:100%;">
			<h1 class="product-title">Möt det som aldrig någonsin skådats</h1>
			<p class="product-paragraph">
				Världens snabbaste vikbara 5G-telefon
			</p>
		</div>
	</div>
	<div class="product-view light">
		<div style="display:inline-block;">
			<h1 class="product-title">Innovativ skärmflexibilitet</h1>
			<p class="product-paragraph">
				Vi definierar en ny kategori inom mobiltelefoni genom att
				anta flexibel display. Den mjuka skärmen kan böjas och
				vikas ut flera gånger utan kompromiss i kvalitet.
				Förbered dig på att bli överraskad över telefonens innovation
				och banbrytande prestanda.
			</p>
		</div>
	</div>
	<div class="product-view dark">
		<div style="display:inline-block;">
			<h1 class="product-title">Lås upp med ett knapptryck</h1>
			<p class="product-paragraph">
				Strömbrytaren är integrerad med fingeravtrycksläsaren
				i en snabb och säker knapp. Lås upp telefonen på en
				sekund och starta dagen med bara en knapptryckning.
			</p>
		</div>
	</div>
</div>

<?php

	include "../partials/footer.php";
	include "../partials/html_end.php";

?>