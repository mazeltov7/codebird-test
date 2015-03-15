<?php
require_once('config.php');
require_once('codebird.php');

session_start();

if (empty($_SESSION['me'])) {
  header('Location:' . SITE_URL . 'login.php');
  exit;
}

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);

$cb = \Codebird\Codebird::getInstance();

$cb->setToken($_SESSION['me']['tw_access_token'], $_SESSION['me']['tw_access_token_secret']);


$tweets = (array) $cb->statuses_homeTimeline();
array_pop($tweets);



?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ホーム</title>
</head>
<body>
  <h1>ホーム画面</h1>
  <p><? echo h($_SESSION["me"]["tw_screen_name"]); ?>ログインしてる</p>
  <p><a href="logout.php">ログアウト</a></p>

  <ul>
  <? foreach ($tweets as $tweet) : ?>
  <? if (!$tweet->user->protected) : ?>
    <li><? echo h($tweet->text); ?></li>
  <? endif; ?>
  <? endforeach; ?>
  </ul>
</body>
</html>
