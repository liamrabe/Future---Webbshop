<?php

	setcookie("access_token", null, 1, "/", $_SERVER["SERVER_NAME"], true, false);
	session_destroy();

	header("location: /home");

?>