<?php
class Enum {
	public $value;
	public function __construct($value) {
		$this->value = $value;
	}
}
class Repo {
	public $name;
	public $owner;
	public $id;
	public $visibility; // one of `public`, `private`, or `unlisted`
	public $owner_id;
	public $git;
	public $description;
	public function __construct($name, $owner) {
		$this->name = $name;
		$this->owner = $owner;
		// $this->git = Git::open('/home/msirabella/Documents/projects/coffey/');
		$this->repo = Repository::open_bare("/home/msirabella/Documents/projects/coffey/.git");
		$this->visibility = new Enum("public");
	}

	public function url() {
		return "http://localhost:8001/{$this->owner->canonical_name}/{$this->name}";
	}
}
?>
