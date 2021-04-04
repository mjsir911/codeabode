<?php
require "route.php";

require "model/App.class.php";

function cfg($section, $key) {
	return "hi";
}

$data = array("app" => new App(), "page" => null);

route("/static/(?<file>.+)", function($file) { return "static/" . $file ; });
route("/~(?<user>[^/]+)/(?<repo>[^/]+)", "repo/index.php", $data);
route("", "404.html");
?>
