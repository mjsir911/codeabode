<?php
require_once "model/User.class.php";

require_once "model/Repo.class.php";
// require "model/Commit.class.php";

$commits = new Revwalk($repo->repo);
$commits->push_range("HEAD~3..HEAD");

$data = array(
	"commits" => $commits,
	"view" => "summary"
);

route("", "summary.phtml", $data);
      
?>
