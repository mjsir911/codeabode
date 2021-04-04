<?php
$walker = new Revwalk($repo->repo);
$walker->push_ref($ref);
$commits = new LimitIterator($walker->getIterator(), 0, 20);
$data = array("commits" => $commits);
require "log.phtml";
?>
