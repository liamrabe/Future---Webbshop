<?php

	$dir = $_SERVER["DOCUMENT_ROOT"];

	include "$dir/lib/database.php";
	$db = new Database();

	include "$dir/partials/html_begin.php";
	include "$dir/partials/navbar.php";

?>