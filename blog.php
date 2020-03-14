<?php

	include "./partials/html_begin.php";
	include "./partials/navbar.php";

	$pdo = $db->Login();

	// Hämta de senaste 20 blogginläggen.
	$posts = $pdo->query("SELECT id, title, content, created FROM blog_posts ORDER BY created DESC LIMIT 20")->fetchAll();

?>

<div class="blog">
	<div class="blog-wrapper">
		<?php if($db->IsLoggedIn() && $db->IsAdmin()) { ?>
			<div class="blog-title">Nytt blogginlägg</div>
			<div class="compose">
				<form action="/blog/new" method="post" class="form-compose">
					<input type="text" class="form-title" placeholder="Titel" name="title">
					<textarea class="form-content" name="content" placeholder="Markdown kod här"></textarea>
					<button class="form-submit" type="submit">Lägg upp</button>
				</form>
			</div>
		<?php } ?>
		<div class="blog-title">Blogg</div>
		<div class="posts">
			<?php if(count($posts) > 0) { ?>
				<?php foreach($posts as $post) { ?>
					<div class="post">
						<div class="post-title"><?= $post["title"]; ?></div>
						<div class="post-timestamp"><?= $post["created"]; ?></div>
						<div class="post-content"><?= $post["content"]; ?></div>
					</div>
				<?php } ?>
			<?php } else { ?>
				Inga inlägg ännu...
			<?php } ?>
		</div>
	</div>
</div>

<?php
	include "./partials/footer.php";
	include "./partials/html_end.php";
?>