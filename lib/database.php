<?php
	class Database {

		private $username = "liam";
		private $password = "iAfHDXc7WKGy7VFxJvkT8Dwh7";
		private $database = "future";
		private $hostname = "localhost";

		function __construct() {

			// Starta en session tillsammans med start av databas-klassen.
			session_start();

		}

		public function Login() {
			try {
				$db = new PDO(
					"mysql:host=$this->hostname;dbname=$this->database",
					$this->username, $this->password
				);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $db;
			}
			catch(PDOException $e) {
				return false;
			}
		}

		public function IsLoggedIn() {
			if(isset($_COOKIE["access_token"]) && !empty($_COOKIE["access_token"])) {
				return true;
			}
			else {
				return false;
			}
		}

		public function GetUserID() {

			$access_token = $_COOKIE["access_token"];

			$pdo = $this->Login();
			$stmt = $pdo->prepare("SELECT id FROM users WHERE access_token = :access_token");
			$stmt->bindParam(":access_token", $access_token, \PDO::PARAM_STR);
			$stmt->execute();
			$username = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			return $username[0]["id"];

		}

		public function IsAdmin() {

			$user_id = $this->GetUserID();

			$pdo = $this->Login();
			$stmt = $pdo->prepare(
				"SELECT role FROM users WHERE role = 'admin'
				AND id = :id
			");
			$stmt->bindParam(":id", $user_id, \PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			if(count($result) == 1) {
				return true;
			}
			else {
				return false;
			}

		}

		public function GetUser() {

			$id = $this->GetUserID();
			$pdo = $this->Login();

			$stmt = $pdo->prepare("
				SELECT id,username,email,avatar,firstname,lastname,reg_date
				FROM users
				WHERE id = :id
			");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();

			$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $user[0];

		}

		public function GetUserByID($id) {

			$pdo = $this->Login();

			$stmt = $pdo->prepare("
				SELECT id,username,email,avatar,firstname,lastname
				FROM users
				WHERE id = :id
			");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();

			$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $user[0];

		}

		public function GetCommentCountFromPostID($id) {

			$pdo = $this->Login();

			$stmt = $pdo->prepare("SELECT count(*) FROM comments WHERE post_id = :id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();

			$count = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $count[0]["count(*)"];

		}

		public function Pagination(string $table) {

			$pdo = $this->Login();

			// Hämta totala mängden inlägg i databasen.
			$total = $pdo->query("SELECT count(*) FROM $table")->fetchColumn();

			// Max 20 resultat per sida.
			$limit = 20;

			// Antalet sidor tillgängliga.
			$pages = ceil($total / $limit);

			$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
				'options' => array(
					'default'   => 1,
					'min_range' => 1,
				),
			)));

			$offset = ($page - 1) * $limit;
			
			$start = $offset + 1;
			$end = min(($offset + $limit), $total);

			return [
				"offset" => $offset,
				"limit" => $limit,
				"pages" => $pages,
				"total" => $total,
				"start" => $start,
				"page" => $page,
				"end" => $end,
			];

		}

	}
?>