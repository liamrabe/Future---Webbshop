<?php

	include "../partials/html_begin.php";

	$token = bin2hex(random_bytes(32));
	$db->setcookie("token", $token, "20minutes");

	include "../partials/navbar.php";

?>

<div class="main">
	<div class="product-price">
		<form action="/order" method="post">
			<input type="hidden" value="<?= $token; ?>" name="token">
			<input type="hidden" value="3" name="product_id">
			<button class="product-addtocart">Beställ</button>
		</form>
		<div class="price">1 299 kr</div>
	</div>
	<div class="product-view">
		<h1 class="product-title">future matebuds</h1>
		<h3 class="product-sub-title">Auto På & Koppling</h3>
		<p class="product-paragraph">
			Future MateBuds sätter på sig och kopplar sig till varandra
			automatisk när du tar ut dom ur deras laddningsfodral så du kan
			forsätta vara hands-free.
		</p>
		<div class="product-banner" style="background-image:url('../../static/images/matebuds/charging-case.jpg');background-size: 40%;height:400px;"></div>
		<h1 class="product-sub-title">Klass 1 Bluetooth 5 Koppling</h1>
		<p class="product-paragraph">Vi definierar en ny kategori inom mobiltelefoni genom att anta flexibel display. Den mjuka skärmen kan böjas och vikas ut flera gånger utan kompromiss i kvalitet. Förbered dig på att bli överraskad över telefonens innovation och banbrytande prestanda.</p>
		<div class="product-banner" style="background-image:url('../../static/images/matebuds/matebuds.jpg');background-size:40%;height: 400px;"></div>
	</div>
</div>

<?php
	include "../partials/footer.php";
	include "../partials/html_end.php";
?>