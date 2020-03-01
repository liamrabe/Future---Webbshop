<?php

	setcookie("token", null, 1);
	session_destroy();

	header("location: /home");

?>