<?php
require 'config/database.php'; require 'includes/auth.php'; require_login();
$title='ประกาศของฉัน';
$stmt=$pdo->prepare('SELECT * FROM rooms WHERE user_id=? ORDER BY created_at DESC');$stmt->execute([$_SESSION['user_id']]);$rooms=$stmt->fetchAll();
require 'includes/header.php';
?>
<h1>ประกาศของฉัน</h1><a class="btn" href="room_create.php">+ เพิ่มประกาศ</a><br><br>
<div class="grid">
<?php foreach($rooms as $r):?><div class="card"><h2><?=e($r['title'])?></h2><p class="price"><?=number_format((float)$r['price'],2)?> บาท</p><p><?=e($r['location'])?></p><div class="actions"><a class="btn" href="room.php?id=<?=$r['id']?>">ดู</a><a class="btn secondary" href="room_edit.php?id=<?=$r['id']?>">แก้ไข</a><a class="btn danger" href="room_delete.php?id=<?=$r['id']?>">ลบ</a></div></div><?php endforeach;?>
</div>
<?php require 'includes/footer.php'; ?>
