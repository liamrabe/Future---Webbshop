<?php

	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_begin.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/navbar.php";

	$id = $_GET["id"];

	$pdo = $db->Login();

	$stmt = $pdo->prepare("SELECT user_id, title, content,created FROM posts WHERE id = :id");
	$stmt->bindParam(":id", $id, PDO::PARAM_INT);

	$stmt->execute();

	$post = $stmt->fetchAll(PDO::PARAM_STR)[0];

	$content = preg_replace(
		"/\\n/",
		"<div class=\"line-break\"></div>",
		$post["content"]
	);

?>

<div class="forum-post">
	<div class="forum-post-wrapper">
		<div class="post-title"><?= $post["title"]; ?></div>
		<div class="post-timestamp">
			<?= date("Y-m-d H:i", strtotime($post["created"])); ?>
		</div>
		<div class="post-content">
			<div class="post-content"><?= $content; ?></div>
		</div>
	</div>
	<div class="new-comment">
		<form action="/forum/post/<?= $id; ?>">
			<textarea class="comment" name="comment" placeholder="Kommentar"></textarea>
			<button class="submit" type="submit">Lägg upp</button>
		</form>
	</div>
	<div class="comments"></div>
</div>

<?php
	//include "./partials/footer.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_end.php";
?>