<?php
require 'config/database.php'; require 'includes/auth.php'; require_login();
$id=(int)($_GET['id']??0);
$stmt=$pdo->prepare('DELETE FROM rooms WHERE id=? AND user_id=?');
$stmt->execute([$id,$_SESSION['user_id']]);
header('Location: my_rooms.php');exit;
