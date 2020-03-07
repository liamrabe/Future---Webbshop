<?php

	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_begin.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/navbar.php";

?>

<div class="admin">
	<div class="admin-wrapper">
		<div class="admin-title">Översikt</div>
		<div class="admin-links">
			<a class="admin-link" href="/admin/orders">Beställningar</a>
			<a class="admin-link" href="/admin/entries">Gästbok inlägg</a>
			<a class="admin-link" href="/admin/blog">Blogg inlägg</a>
			<a class="admin-link" href="/admin/write">Skriv ett blogginlägg</a>
		</div>
	</div>
</div>

<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_end.php";
?>