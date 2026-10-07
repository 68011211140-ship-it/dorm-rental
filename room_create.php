<?php
require 'config/database.php'; require 'includes/auth.php'; require_login();
$title='เพิ่มประกาศ'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 check_csrf();
 $name=trim($_POST['title']??'');$desc=trim($_POST['description']??'');$price=(float)($_POST['price']??0);$loc=trim($_POST['location']??'');$phone=trim($_POST['phone']??'');
 if($name===''||$desc===''||$price<=0||$loc===''||$phone==='') $error='กรุณากรอกข้อมูลให้ครบถ้วน';
 else { $stmt=$pdo->prepare('INSERT INTO rooms(user_id,title,description,price,location,phone,status) VALUES(?,?,?,?,?,?,?)');$stmt->execute([$_SESSION['user_id'],$name,$desc,$price,$loc,$phone,'active']);header('Location: my_rooms.php');exit;}
}
require 'includes/header.php';
?>
<form class="form" method="post">
<h2>เพิ่มประกาศหอพัก</h2>
<?php if($error):?><div class="error"><?=e($error)?></div><?php endif;?>
<input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
<label>ชื่อหอพัก</label><input name="title" required value="<?=e($_POST['title']??'')?>">
<label>รายละเอียด</label><textarea name="description" required><?=e($_POST['description']??'')?></textarea>
<label>ราคา/เดือน</label><input type="number" name="price" min="1" step="0.01" required>
<label>สถานที่</label><input name="location" required>
<label>เบอร์โทร</label><input name="phone" required>
<br><br><button class="btn">ลงประกาศ</button>
</form>
<?php require 'includes/footer.php'; ?>
