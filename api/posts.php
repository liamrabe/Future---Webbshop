<?php

	header("Content-Type: text/xml");

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	$pdo = $db->Login();

	$page = $_GET["page"];

	try {

		$pagination = $db->Pagination("forum_posts");
		if($page > $pagination["pages"]) {
			header("location: /api/posts/".$pagination["pages"]);
		}

		$stmt = $pdo->prepare(
			"SELECT user_id, id, title, content, created
			FROM forum_posts
			ORDER BY created DESC
			LIMIT :limit
			OFFSET :offset
		");

		$stmt->bindParam(":limit", $pagination["limit"], PDO::PARAM_INT);
		$stmt->bindParam(":offset", $pagination["offset"], PDO::PARAM_INT);

		$stmt->execute();

		$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

		echo '<?xml version="1.0" encoding="UTF-8"?>';
		if(count($posts) > 0) {
			echo '<response>';
				echo '<status>200</status>';
				echo "<page>".$pagination["page"]."</page>";
				if($pagination["page"] != $pagination["pages"]) {
					echo "<nextPage>".floor($pagination["page"]+1)."</nextPage>";
				}
				echo "<lastPage>".$pagination["pages"]."</lastPage>";
				echo '<posts>';
				foreach($posts as $post) {
					echo '<post>';
						echo '<user_id>'.$post["user_id"].'</user_id>';
						echo '<id>'.$post["id"].'</id>';
						echo '<title>'.$post["title"].'</title>';
						echo '<content>'.$post["content"].'</content>';
						echo '<created>'.$post["created"].'</created>';
						echo '<updated>'.$post["updated"].'</updated>';
					echo '</post>';
				}
				echo '</posts>';
			echo '</response>';
		}
		else {
			echo '<response>';
				echo '<status>404</status>';
				echo '<message>Inga inlägg hittades.</message>';
			echo '</response>';
		}
	}
	catch(PDOException $e) {
		echo '<response>';
			echo '<status>404</status>';
			echo '<message>Inga inlägg hittades.</message>';
		echo '</response>';
	}

?>