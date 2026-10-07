<?php
require 'config/database.php'; require 'includes/auth.php'; require_login();
$id=(int)($_GET['id']??0);
$stmt=$pdo->prepare('SELECT * FROM rooms WHERE id=?');$stmt->execute([$id]);$room=$stmt->fetch();
if(!$room){http_response_code(404);exit('ไม่พบประกาศ');}
if((int)$room['user_id']!==(int)$_SESSION['user_id']){http_response_code(403);exit('คุณไม่มีสิทธิ์แก้ไขประกาศของผู้ใช้อื่น');}
$title='แก้ไขประกาศ';$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 check_csrf();
 $name=trim($_POST['title']??'');$desc=trim($_POST['description']??'');$price=(float)($_POST['price']??0);$loc=trim($_POST['location']??'');$phone=trim($_POST['phone']??'');
 if($name===''||$desc===''||$price<=0||$loc===''||$phone==='')$error='กรุณากรอกข้อมูลให้ครบ';
 else{
  $stmt=$pdo->prepare('UPDATE rooms SET title=?,description=?,price=?,location=?,phone=? WHERE id=? AND user_id=?');
  $stmt->execute([$name,$desc,$price,$loc,$phone,$id,$_SESSION['user_id']]);
  header('Location: my_rooms.php');exit;
 }
}
require 'includes/header.php';
?>
<form class="form" method="post">
<h2>แก้ไขประกาศ</h2><?php if($error):?><div class="error"><?=e($error)?></div><?php endif;?>
<input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
<label>ชื่อหอพัก</label><input name="title" required value="<?=e($room['title'])?>">
<label>รายละเอียด</label><textarea name="description" required><?=e($room['description'])?></textarea>
<label>ราคา/เดือน</label><input type="number" name="price" min="1" step=".01" required value="<?=e((string)$room['price'])?>">
<label>สถานที่</label><input name="location" required value="<?=e($room['location'])?>">
<label>เบอร์โทร</label><input name="phone" required value="<?=e($room['phone'])?>">
<br><br><button class="btn">บันทึกการแก้ไข</button>
</form>
<?php require 'includes/footer.php'; ?>
