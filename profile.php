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
		<div class="profile-header">
			<div class="profile-avatar">
				<img src="<?= $user->avatar; ?>?s=128">
			</div>
			<div class="profile-info">
				<div style="display:block;">
					<div class="profile-username"><?= strtolower($user->username); ?></div>
					<div class="profile-registered">
						Medlem sedan: <?= date("Y-m-d", strtotime($user->registered)); ?>
					</div>
					<div class="profile-stats">
						<div class="profile-stat">
							<span class="fas fa-mail-bulk"></span>
							20
						</div>
						<div class="profile-stat">
							<span class="fas fa-comments"></span>
							25
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	//include "./partials/footer.php";
	include "./partials/html_end.html";
?>