<?php

	include "./partials/html_begin.php";
	include "./partials/navbar.php";

	if(!$db->IsLoggedIn()) {
		header("location: /");
	}

	$user = $db->GetUser();

?>

<div class="profile">
	<div class="profile-wrapper">
		<div class="profile-content">
			
		</div>
		<div class="profile-overview">
			<div class=""></div>
		</div>
	</div>
</div>

<?php
	//include "./partials/footer.php";
	include "./partials/html_end.php";
?>