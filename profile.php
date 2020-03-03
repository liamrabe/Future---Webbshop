<?php
	require_once "./lib/database.php";
	$db = new Database();

	if(!$db->IsLoggedIn()) {
		header("location: /");
	}

	include "./partials/html_begin.html";
	include "./partials/navbar.php";

	$user = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/user/".$db->GetUserID()));

?>

<div class="profile">
	<div class="profile-wrapper">
		<div class="profile-header">
			<img src="<?= $user->avatar; ?>" class="avatar">
			<div class="profile-details">

				<div class="title">Användarnamn</div>
				<div class="text"><?= $user->username; ?></div>

				<div class="title">Medlem sedan</div>
				<div class="text">
					<?= date("Y-m-d", strtotime($user->registered)); ?>
				</div>

			</div>
		</div>
	</div>
</div>

<?php
	//include "./partials/footer.php";
	include "./partials/html_end.html";
?>