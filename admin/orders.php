<?php

	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_begin.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/navbar.php";

	$pdo = $db->Login();

	$stmt = $pdo->prepare("SELECT id, user_id, product_id FROM orders");
	$stmt->execute();

	$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="admin">
	<div class="admin-wrapper">
		<div class="admin-list">
			
		</div>
	</div>
</div>

<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_end.php";
?>