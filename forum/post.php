<?php

	include $_SERVER["DOCUMENT_ROOT"] . "/lib/CSRF.php";
	$CSRF = new CSRF();

	// Generera ett CSRF-token.
	if(!$CSRF->Generate()) {
		die("Din session är ogiltig, ladda om och försök igen.");
	}

	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_begin.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/navbar.php";

	$id = $_GET["id"];

	$pdo = $db->Login();

	$stmt = $pdo->prepare("SELECT user_id, title, content,created FROM posts WHERE id = :id");
	$stmt->bindParam(":id", $id, PDO::PARAM_INT);

	$stmt->execute();

	$post = $stmt->fetchAll(PDO::PARAM_STR)[0];

	// Hämta dom senaste 100 kommentarerna.
	$stmt = $pdo->prepare(
		"SELECT created, content, user_id
		FROM forum_comments WHERE post_id = :id"
	);
	$stmt->bindParam(":id", $id, PDO::PARAM_INT);

	$stmt->execute();

	$comments = $stmt->fetchAll(PDO::PARAM_STR);

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
		<div class="post-content"><?= $content; ?></div>
	</div>
	<?php if($db->IsLoggedIn()) { ?>
		<div class="compose">
			<form method="post" class="compose-form" action="/forum/post/<?= $id; ?>">
				<input type="hidden" name="token" value="<?= $CSRF->token; ?>">
				<textarea class="comment" name="comment" placeholder="Kommentar"></textarea>
				<button class="submit" type="submit">Lägg upp</button>
			</form>
		</div>
	<?php } ?>
	<div class="comments">
		<?php if(count($comments) > 0) { ?>
			<?php foreach($comments as $comment) { ?>
				<div class="comment">
					<div class="comment-timestamp"><?= $comment["created"]; ?></div>
					<div class="comment-content"><?= $comment["content"]; ?></div>
				</div>
			<?php } ?>
		<?php } else { ?>
			<div class="no-comments">Här var det tomt ...</div>
		<?php } ?>
	</div>
</div>

<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/footer.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/partials/html_end.php";
?>