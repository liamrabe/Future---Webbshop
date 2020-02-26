<?php
	class Database {

		private $username = "liam";
		private $password = "iAfHDXc7WKGy7VFxJvkT8Dwh7";
		private $database = "future";
		private $hostname = "localhost";

		private function Login() {
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

		public function GetProducts() {
			$pdo = $this->Login();
			$stmt = $pdo->prepare("SELECT name, image, description, price FROM products");
			$stmt->execute();
			$res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $res;
		}

	}
?>