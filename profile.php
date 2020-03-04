<?php
	require_once "./lib/database.php";
	$db = new Database();

	if(!$db->IsLoggedIn()) {
		header("location: /");
	}

	include "./partials/html_begin.html";
	include "./partials/navbar.php";

	$user = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/user/".$_COOKIE["access_token"]));

?>

<div class="profile">
	<div class="profile-wrapper">

		<div class="profile-sidebar">
			<div class="avatar" style="background-image: <?= $user->avatar; ?>?s=128;"></div>
			<div class="profile-info">
				<h3 class="profile-username"><?= $user->username; ?></h3>
				<p class="profile-registered">
					Medlem sedan: <?= date("Y-m-d", strtotime($user->registered)); ?>
				</p>
				<p class="profile-posts">
					<span class="fas fa-mail-bulk"></span>
					20
				</p>
				<p class="profile-comments">
					<span class="fas fa-comments"></span>
					20
				</p>
			</div>
		</div>

	</div>
</div>

<?php
	//include "./partials/footer.php";
	include "./partials/html_end.html";
?>