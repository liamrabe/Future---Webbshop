<?php

	// Skicka tillbaka användaren om dom inte är admin.
	if(!$db->IsLoggedIn() && !$db->IsAdmin()) { header("location: /"); }

	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_begin.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/navbar.php";


?>



<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/footer.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_end.php";
?>