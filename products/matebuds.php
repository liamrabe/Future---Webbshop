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
	<div class="product-showcase matebuds">
		<div class="product-interact">
			<span class="product-price">1 299 kr</span>
			<form action="/order" method="post">
				<input type="hidden" name="token" value="<?= $CSRF->token; ?>">
				<input type="hidden" name="product_id" value="3">
				<button type="submit" id="order-btn" class="product-add-to-cart">
					Beställ
				</button>
			</form>
		</div>
	</div>
	<div class="product-view dark">
		<div style="display:inline-block;">
			<h1 class="product-title">Auto På & Koppling</h1>
			<p class="product-paragraph">
				Future MateBuds sätter på sig och kopplar sig till varandra
				automatisk när du tar ut dom ur deras laddningsfodral så du kan
				forsätta vara hands-free.
			</p>
		</div>
	</div>
	<div class="product-view light">
		<div style="display:inline-block;">
			<h1 class="product-title">Klass 1 Bluetooth 5 Koppling</h1>
			<p class="product-paragraph">
				Vi definierar en ny kategori inom mobiltelefoni genom
				att anta flexibel display. Den mjuka skärmen kan böjas
				och vikas ut flera gånger utan kompromiss i kvalitet.
				Förbered dig på att bli överraskad över telefonens
				innovation och banbrytande prestanda
			</p>
		</div>
	</div>
</div>

<?php

	include "../partials/footer.php";
	include "../partials/html_end.php";

?>