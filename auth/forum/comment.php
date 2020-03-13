<?php

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/CSRF.php";
	$CSRF = new CSRF();

	if(!$CSRF->Validate()) {
		die("Din session är ogiltig.");
	}

	// Ta bort CSRF-token, vi behöver den inte längre.
	$CSRF->Remove();

	// Spara id från GET-request.
	$id = $_GET["id"];

	require $_SERVER["DOCUMENT_ROOT"] . "/lib/database.php";
	$db = new Database();

	if(!isset($_POST["comment"]) || empty($_POST["comment"])) {
		die("Din kommentar får inte vara tom.");
	}

	$comment = $_POST["comment"];

	// Ta bort HTML-taggar från kommentar.
	$comment = strip_tags($comment);

	$pdo = $db->Login();

	$stmt = $pdo->prepare(
		"INSERT INTO forum_comments (content, user_id, post_id)
		VALUES (:content, :user_id, :post_id)
		"
	);

	$user_id = $db->GetUserID();

	$stmt->bindParam(":content", $comment, PDO::PARAM_STR);
	$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
	$stmt->bindParam(":post_id", $id, PDO::PARAM_INT);

	try {
		$result = $stmt->execute();
		if($result) {
			header("location: /forum/post/$id");
		}
	}
	catch(PDOException $e) {
		die("Misslyckades att spara kommentar, försök igen.");
	}

?>