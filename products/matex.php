<?php

	include "../partials/html_begin.html";
	include "../partials/navbar.php";
	
?>

<div class="main">
	<div class="product-price">
		<button class="product-addtocart">Add to cart</button>
		<div class="price">14 999 kr</div>
	</div>
	<div class="product-view">
		<h1 class="product-title">future mate x</h1>
		<h3 class="product-sub-title">Möt det som aldrig någonsin skådats</h3>
		<p class="product-paragraph">Världens snabbaste vikbara 5G-telefon</p>
		<div class="product-banner" style="background-image:url('https://127.0.0.1/product/matex/image/matex.jpg');"></div>
		<h1 class="product-title">Innovativ skärmflexibilitet</h1>
		<p class="product-paragraph">Vi definierar en ny kategori inom mobiltelefoni genom att anta flexibel display. Den mjuka skärmen kan böjas och vikas ut flera gånger utan kompromiss i kvalitet. Förbered dig på att bli överraskad över telefonens innovation och banbrytande prestanda.</p>
		<small class="product-small">Tryck nedan för att se skärmflexibiliteten</small>
		<video class="product-video" onclick="(this.paused) ? this.play(): this.pause();">
			<source type="video/mp4" src="https://127.0.0.1/product/matex/video/matex-fold.mp4">
		</video>
		<h1 class="product-title">Lås upp med ett knapptryck</h1>
		<p class="product-paragraph">Strömbrytaren är integrerad med fingeravtrycksläsaren i en snabb och säker knapp. Lås upp telefonen på en sekund och starta dagen med bara en knapptryckning.</p>
		<div class="product-banner" style="background-image:url('https://127.0.0.1/product/matex/image/matex-power.png');"></div>
	</div>
</div>

<?php
	include "../partials/footer.php";
	include "../partials/html_end.html";
?>