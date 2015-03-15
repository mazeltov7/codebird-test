<?php

require_once("config.php");
require_once("codebird.php");

session_start();

$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(), '', time()-86400, '/codebird-test/');
}

session_destroy();

header('Location: ' . SITE_URL);
