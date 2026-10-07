<?php
require 'config/database.php'; require 'includes/auth.php';
$id=(int)($_GET['id']??0);
$stmt=$pdo->prepare("SELECT r.*,u.name AS owner_name,u.email AS owner_email FROM rooms r JOIN users u ON u.id=r.user_id WHERE r.id=?");
$stmt->execute([$id]); $room=$stmt->fetch();
if(!$room){http_response_code(404);exit('ไม่พบประกาศ');}
$title=$room['title']; require 'includes/header.php';
?>
<div class="card">
<h1><?=e($room['title'])?></h1>
<p class="price"><?=number_format((float)$room['price'],2)?> บาท/เดือน</p>
<p><?=nl2br(e($room['description']))?></p>
<p><b>สถานที่:</b> <?=e($room['location'])?></p>
<p><b>เบอร์โทร:</b> <?=e($room['phone'])?></p>
<p><b>ผู้ประกาศ:</b> <?=e($room['owner_name'])?></p>
<?php if(is_logged_in() && (int)$_SESSION['user_id']===(int)$room['user_id']): ?>
<div class="actions"><a class="btn" href="room_edit.php?id=<?=$room['id']?>">แก้ไข</a><a class="btn danger" href="room_delete.php?id=<?=$room['id']?>">ลบ</a></div>
<?php endif; ?>
</div>
<?php require 'includes/footer.php'; ?>
