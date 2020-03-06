<?php

	include "./partials/html_begin.php";
	include "./partials/navbar.php";

	$pdo = $db->Login();

	$stmt = $pdo->prepare("SELECT url, id, name FROM communities");
	$stmt->execute();

	$communities = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$posts = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/posts/1"));
	$posts = $posts->posts->post;

?>

<div class="forum">
	<div class="forum-wrapper">
		<div class="forum-showcase">
			<?php foreach($communities as $community) { ?>
				<a href="/forum/<?= $community["url"]; ?>"><?= $community["name"]; ?></a>
			<?php } ?>
		</div>
		<div class="forum-title">Inlägg</div>
		<div class="posts">
			<?php
				foreach($posts as $post) {
					$author = new SimpleXMLElement(file_get_contents("https://".$_SERVER["SERVER_NAME"]."/api/user/".$post->user_id."/".$db->api_key));
					echo '<div class="post">';
						echo '<div class="post-title">'.$post->title.'</div>';
					echo '</div>';
				}
			?>
		</div>
	</div>
</div>

<?php
	//include "./partials/footer.php";
	include "./partials/html_end.php";
?>