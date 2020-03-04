<?php
	class Database {

		private $username = "liam";
		private $password = "iAfHDXc7WKGy7VFxJvkT8Dwh7";
		private $database = "future";
		private $hostname = "localhost";

		function __construct() {

			// Starta en session tillsammans med start av databas-klassen.
			session_start();

			// Ta bort CSRF-token om användaren inte behöver dom.
			$requri = $_SERVER["REQUEST_URI"];

			$CSRF_Forms = [
				"/guestbook",
				"/register",
				"/login",
			];

			if(in_array($requri, $CSRF_Forms)) {
				$this->destroycookie("token");
			}

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

		public function VerifyCSRFToken() {
			if(!isset($_POST["token"]) || empty($_POST["token"]) && !isset($_COOKIE["token"]) || empty($_COOKIE["token"])) { 
				return false;
			}
			else if(!hash_equals($_COOKIE["token"], $_POST["token"])) {
				return false;
			}
			else {
				return true;
			}
		}

		public function setcookie(string $name, string $value, string $age) {
			return setcookie(
				$name,
				$value,
				strtotime("+$age"),
				"/",
				$_SERVER["SERVER_NAME"],
				true, false
			);
		}

		public function destroycookie(string $name) {
			return setcookie($name, "", -1, "/", $_SERVER["SERVER_NAME"], true, false);
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