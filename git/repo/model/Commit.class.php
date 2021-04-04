<?php
class CommitUser {
	public $email;
	public $name;

	public function __construct($email, $name) {
		$this->email = $email;
		$this->name = $name;
	}
}

class Base64String {
	private $base64;
	public $hex;
	public function __construct($data) {
		$this->hex = bin2hex($data);
		$this->base64 = base64_encode($data);
	}

	public function __toString() {
		return $this->base64;
	}
}

class Commit {
	public $id;
	public $short_id;
	public $author;
	public $commiter;
	public $timestamp;
	public $message;
	public $tree;
	public $parents;
	public $signature;

	public $oid;
	public function __construct($id, $message) {
		$this->id = new Base64String($id);
		$this->message = $message;
		$this->author = new CommitUser("marco@sirabella.org", "Marco Sirabella");
	}
}
?>
