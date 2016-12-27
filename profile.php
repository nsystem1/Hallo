<!DOCTYPE html>
<html>
<body>
<?php
require_once 'user.php';
include_once 'db.php';

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    $st = $pdo->prepare('SELECT * FROM user WHERE BINARY uid=:uid');
    if (!$st->execute(array(':uid' => $uid))) {
        throw new Exception('DB connection failed. (~UP)');
    } elseif ($st->rowCount() > 0) {
        $user = $st->fetch(PDO::FETCH_ASSOC);
    }
} elseif (is_logged()) {
    $user = get_user();
    $uid = $user['uid'];
}

$pic = "./image/pic_{$uid}.jpg";
$nopic = false;
if (!isset($user['photo']) || !$user['photo'] || !file_exists($pic)) {
    $pic = "./image/def_{$user['gender']}.jpg";
    $nopic = true;
}

// for testing
// echo implode('|', $user);
$_GET['p'] = 1;
include_once 'hud.php';
?>
<link rel="stylesheet" href="css/profile.css">

<div class="nickname">
  <?php echo $user['nickname']; ?>
</div>

<div class="name">
  <?php echo $user['fname'].' '.$user['lname']; ?>
</div>

<div class="img">
  <a target="_blank" href="image/no_profile_pic.jpg">
    <img src=<?php echo $pic; ?>  width="300" height="200">
  </a>
  <div class="addpp">
    <a href="#">
    <?php if ($nopic):?>
    Add a Picture
  <?php else:?>
    Change Picture
  <?php endif; ?>
    </a>
  </div>
</div>

<?php
$_GET['p'] = 1;
include 'timeline.php';
?>
</body>
</html>
