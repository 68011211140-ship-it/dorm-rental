<?php
require 'config/database.php'; require 'includes/auth.php';
$title='ประกาศหอพัก';
$stmt=$pdo->query("SELECT r.*,u.name AS owner_name FROM rooms r JOIN users u ON u.id=r.user_id WHERE r.status='active' ORDER BY r.created_at DESC");
$rooms=$stmt->fetchAll();
require 'includes/header.php';
?>
<h1>ประกาศหอพักทั้งหมด</h1>
<div class="grid">
<?php foreach($rooms as $room): ?>
<div class="card">
<h2><?=e($room['title'])?></h2>
<p class="price"><?=number_format((float)$room['price'],2)?> บาท/เดือน</p>
<p><?=e($room['description'])?></p>
<p class="meta">สถานที่: <?=e($room['location'])?></p>
<p class="meta">เจ้าของประกาศ: <?=e($room['owner_name'])?></p>
<a class="btn" href="room.php?id=<?=$room['id']?>">ดูรายละเอียด</a>
</div>
<?php endforeach; ?>
<?php if(!$rooms): ?><p>ยังไม่มีประกาศ</p><?php endif; ?>
</div>
<?php require 'includes/footer.php'; ?>
