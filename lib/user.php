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
		public $avatar;

		// Konvertera assoc array till klass array.
		public function Set($user) {
			$this->id = $user["id"];
			$this->username = $user["username"];
			$this->email = $user["email"];
			$this->firstname = $user["firstname"];
			$this->lastname = $user["lastname"];
			$this->birthday = date("Y-m-d", strtotime($user["birthday"]));
			$this->gender = $user["gender"];
			$this->registered = date("Y-m-d", strtotime($user["reg_date"]));
			$this->avatar = $user["avatar"];
		}

	}
?>