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
			if($requri != "/login" && $requri != "/register") {
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
				"127.0.0.1",
				true, false
			);
		}

		public function destroycookie($name) { return setcookie($name, null, 1); }

		public function GetProducts() {
			$pdo = $this->Login();
			$stmt = $pdo->prepare("SELECT name, image, description, price, url FROM products");
			$stmt->execute();
			$res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $res;
		}

		public function GetProduct($name) {
			$pdo = $this->Login();
			$stmt = $pdo->prepare(
				"SELECT name, image, banner, description, price, tagline, url
				FROM products WHERE name = :name
			");
			$stmt->bindParam(":name", $name, \PDO::PARAM_STR);
			$stmt->execute();
			$res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $res;
		}

		public function IsLoggedIn() {
			if(isset($_COOKIE["access_token"]) && !empty($_COOKIE["access_token"])) {
				return true;
			}
			else {
				return false;
			}
		}

		public function GetUsername() {

			$access_token = $_COOKIE["access_token"];

			$pdo = $this->Login();
			$stmt = $pdo->prepare("SELECT username FROM users WHERE access_token = :access_token");
			$stmt->bindParam(":access_token", $access_token, \PDO::PARAM_STR);
			$stmt->execute();
			$username = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			return $username[0]["username"];

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
			$stmt = $pdo->prepare("SELECT user_id FROM admins WHERE user_id = :user_id");
			$stmt->bindParam(":user_id", $user_id, \PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			if(count($result) == 1) {
				return true;
			}
			else {
				return false;
			}

		}

	}
?>