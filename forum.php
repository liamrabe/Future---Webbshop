<?php

	if(!isset($_GET["page"])) {
		header("location: /forum/1");
	}

	$page = $_GET["page"];
	$result = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/posts/$page"));
	
	if($page > $result->lastPage) {
		header("location: /forum/$result->lastPage");
	}

	$posts = $result->posts->post;

	include "./partials/html_begin.php";
	include "./partials/navbar.php";

?>

<div class="forum">
	<div class="forum-wrapper">
		<div class="posts">
			<?php foreach($posts as $post) { ?>
				<?php $comments = $db->GetCommentCountFromPostID($post->id); ?>
				<div class="post">
					<div class="post-timestamp"><?= $post->created; ?></div>
					<div class="post-title"><?= $post->title; ?></div>
					<a href="/forum/post/<?= $post->id; ?>" class="post-comments">
						<?= $comments; ?> kommentar(er)
					</a>
				</div>
			<?php } ?>
		</div>
		<div class="forum-pagination">
			<?php
				if($result->lastPage != 1) {
					echo "<div class=\"pagination\">";
						echo "<div class=\"pagination-page\">$result->page / $result->lastPage</div>";
						echo "<div class=\"pagination-links\">";
							if($page > 1) {
								echo "<a class=\"pagination-link\" href=\"/forum/".floor($page - 1)."\">Förgående sida</a>";
							}
							if($page < $result->lastPage) {
								echo "<a class=\"pagination-link\" href=\"/forum/".floor($page + 1)."\">Nästa sida</a>";
							}
						echo "</div>";
					echo "</div>";
				}
			?>
		</div>
	</div>
</div>

<?php
	include "./partials/footer.php";
	include "./partials/html_end.php";
?>