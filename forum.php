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

	$pdo = $db->Login();

	$stmt = $pdo->prepare("SELECT url, id, name FROM communities");
	$stmt->execute();

	$communities = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="forum">
	<div class="forum-wrapper">
		<div class="forum-title">Diskussioner</div>
		<div class="posts">
			<?php
				foreach($posts as $post) {
					$user = $db->GetUserByID($post->user_id);
					echo "<div class=\"post\">";
						echo "<div class=\"post-header\">";
							echo "<span class=\"head-text\">Skrivet av</span>";
							echo "<a href=\"/profile/".$user["username"]."\" class=\"author\">".$user["username"]."</a>";
							echo "<span class=\"timestamp\">".date("Y-m-d H:i", strtotime($post->created))."</span>";
						echo "</div>";
						echo "<div class=\"post-content\">".$post->content."</div>";
						echo "<a class=\"post-comments\" href=\"/post/$post->id\">";
							echo $db->GetCommentCountFromPostID($post->id) . " Kommentar(er)";
						echo "</a>";
					echo "</div>";
				}
			?>
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