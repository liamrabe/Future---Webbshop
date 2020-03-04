<?php
	require_once "./lib/database.php";
	$db = new Database();

	if(!$db->IsLoggedIn()) {
		header("location: /");
	}

	include "./partials/html_begin.php";
	include "./partials/navbar.php";

	$user = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/user/".$_COOKIE["access_token"]));
	$user = $user->user;

?>

<div class="profile">
	<div class="profile-header">
		<div class="profile-background">
			<div class="profile-wrapper">
				<div class="profile-avatar">
					<img src="<?= $user->avatar; ?>?s=128">
				</div>
				<div class="profile-info">
					<div>
						<div class="profile-title">
							<?= $user->firstname . " " . $user->lastname; ?>
						</div>
						<div class="profile-text">
							Medlem sedan
							<?= date("Y-m-d", strtotime($user->registered)); ?>
						</div>
						<div class="profile-stats">
							<div class="profile-stat">
								<span class="fas fa-mail-bulk"></span>
								20
							</div>
							<div class="profile-stat">
								<span class="fas fa-comments"></span>
								200
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="profile-navbar">
		<div class="profile-navbar-wrapper">
			<a href="/profile/my-posts" class="nav-link">Mina inlägg</a>
			<a href="/profile/my-comments" class="nav-link">Mina kommentarer</a>
		</div>
	</div>
</div>

<?php
	//include "./partials/footer.php";
	include "./partials/html_end.html";
?>