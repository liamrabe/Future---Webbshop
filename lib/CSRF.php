<?php
	class CSRF {

		public $token;

		private $cookieOptions = [
			"expires" => "",
			"path" => "",
			"domain" => "",
			"secure" => true,
			"httpOnly" => false
		];

		function __construct() {
			$this->cookieOptions["path"] = $_SERVER["REQUEST_URI"];
			$this->cookieOptions["domain"] = $_SERVER["SERVER_NAME"];
			$this->cookieOptions["expires"] = strtotime("+5min");
		}

		public function Set($endpoint, $value) {
			$this->cookieOptions[$endpoint] = $value;
		}

		public function Generate() {
			// Generera och spara token i CSRF-klassen.
			$this->token = bin2hex(random_bytes(256));
			if($this->Save($this->token)) {
				return true;
			}
			else {
				return false;
			}
		}

		private function Save(string $token) {
			// Sätt en kaka med namnnet token som kan valideras med alla förfrågningar.
			// Spara CSRF-token i 5 minuter.
			$cookie = setcookie("token", $token, $this->cookieOptions);
			if($cookie) {
				return true;
			}
			else {
				return false;
			}
		}

		public function Validate() {
			// Kolla om båda tokens har skickats med förfrågan.
			if(isset($_COOKIE["token"]) && isset($_POST["token"])) {
				// Kolla om båda tokens är likadana.
				if(hash_equals($_COOKIE["token"], $_POST["token"])) {
					return true;
				}
				else {
					return false;
				}
			}
			else {
				return false;
			}
		}

		public function Remove() {
			// Ta bort CSRF-token.
			$cookie = setcookie("token", null, 1, $_SERVER["REQUEST_URI"], $_SERVER["SERVER_NAME"], true, false);
			$this->token = null;
		}

	}
?>