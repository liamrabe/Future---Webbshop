<?php

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$db->destroycookie("access_token");
	session_destroy();

	header("location: /home");

?>