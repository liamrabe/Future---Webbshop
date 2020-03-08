<?php
	class CSRF {

		public $token;

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

		private function Save($token) {
			// Sätt en kaka med namnnet token som kan valideras med alla förfrågningar.
			// Spara CSRF-token i 5 minuter.
			$cookie = setcookie("token", $token, strtotime("+5min"), $_SERVER["REQUEST_URI"], $_SERVER["SERVER_NAME"], true, false);
			if($cookie) {
				return true;
			}
			else {
				return false;
			}
		}

		public function Validate() {
			// Kolla om båda tokens har skickats med förfrågan.
			if(isset($_COOKIE["token"]) && $_POST["token"]) {
				// Kolla om båda tokens är likadana.
				if(hash_equals($_POST["token"], $_COOKIE["token"])) {
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