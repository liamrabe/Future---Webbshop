<?php
	class User {

		public $id;
		public $username;
		public $email;
		public $firstname;
		public $lastname;
		public $birthday;
		public $gender;
		public $registered;

		// Konvertera assoc array till klass array.
		public function Set($user) {
			$this->id = $user[0]["id"];
			$this->username = $user[0]["username"];
			$this->email = $user[0]["email"];
			$this->firstname = $user[0]["firstname"];
			$this->lastname = $user[0]["lastname"];
			$this->birthday = $user[0]["birthday"];
			$this->gender = $user[0]["gender"];
			$this->registered = $user[0]["reg_date"];
		}

	}
?>