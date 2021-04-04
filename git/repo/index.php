<?php
require "model/User.class.php";

function url_for($key, $owner=null, $username=null, $repo=null, $owner_name=null, $repo_name=null, $ref=null) {
  return "hi";
}

function trim_commit($msg) {
	$a = strpos($msg, "\n");
	if ($a == false) {
		$a = strlen($msg);
	}
	return substr($msg, 0, $a);
}

function clone_urls($repo) {
	return array(
		"https://git.sr.ht/~mjsir911/brainfuck-asm",
		"git@git.sr.ht:~sircmpwn/meta.sr.ht",
	);
}

function is_annotated($tag) {
	return true;
}

function lookup_user($email) {
	return new User("mjsir911");
}
function static_resource($path) {return $path;}

function icon($name, $cls=null) { return "icon"; }

function csrf_token() { return "csrf"; }

require "model/Repo.class.php";
// require "model/Commit.class.php";

$user = new User($user);
$repo = new Repo($repo, $user);

$data = array(
	"repo" => $repo,
	"owner" => $user,
	"current_user" => null,
	"default_branch" => "master",
	"latest_tag" => array("0.53.15"),
	"current_user" => new User("bob"),
);

route("/(?<view>tree)", "tree/index.php", $data);
route("/(?<view>refs)", "refs/index.php", $data);
route(
	"/log(/(?<ref>[^/]+)(/(?<path>.+))?)?", "log.php", 
	array_merge($data, array("ref" => "HEAD", "path" => "/"))
);
route("/(?<view>[^/]+)", fn($view) => "{$view}.php", $data);
route("^/?$", "summary.php", $data);
      
?>
