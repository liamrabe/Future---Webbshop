<?php

	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_begin.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/navbar.php";

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/user.php";
	$user = new User();

	$user->Set($db->GetUser());

?>

<div class="profile">
	<div class="profile-wrapper">
		<div class="profile-banner">
			<img src="<?= $user->avatar; ?>?s=128" class="avatar">
			<div class="user-info">
				<div style="display:inline-block;">
					<div class="user-username"><?= $user->username; ?></div>
					<div class="user-registered"><?= $user->registered; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	//include $_SERVER["DOCUMENT_ROOT"] . "/partials/footer.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_end.php";
?>