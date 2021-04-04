<?php
class User {
	public $canonical_name;
	public $username;
	public $id;
	public function __construct($username) {
		$this->username = $username;
		$this->canonical_name = "~" . $username;
		$this->id = base64_encode($username);
	}
}
?>
