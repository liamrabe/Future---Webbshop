<?php

	include "./partials/html_begin.php";
	include "./partials/navbar.php";

	$id = $_GET["id"];

	$pdo = $db->Login();

	$stmt = $pdo->prepare("SELECT user_id, title, content,created FROM posts WHERE id = :id");
	$stmt->bindParam(":id", $id, PDO::PARAM_INT);

	$stmt->execute();

	$post = $stmt->fetchAll(PDO::PARAM_STR)[0];

	$user = $db->GetUserByID($post["user_id"]);

	$content = preg_replace(
		"/\\n/",
		"<div class=\"line-break\"></div>",
		$post["content"]
	);

?>

<div class="forum-post">
	<div class="forum-post-wrapper">
		<div class="post-title"><?= $post["title"]; ?></div>
		<div class="post-header">
			<div class="avatar"><img src="<?= $user["avatar"]; ?>?s=64"></div>
			<div class="user-info">
				<a class="post-username"><?= $user["username"]; ?></a>
				<div class="post-timestamp"><?= date("Y-m-d H:i", strtotime($post["created"])); ?></div>
			</div>
		</div>
		<div class="post-content">
			<div class="post-content"><?= $content; ?></div>
		</div>
	</div>
</div>

<?php
	//include "./partials/footer.php";
	include "./partials/html_end.php";
?>