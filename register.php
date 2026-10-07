<?php
require 'config/database.php';
require 'includes/auth.php';
if (is_logged_in()) { header('Location: index.php'); exit; }
$title='สมัครสมาชิก'; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    check_csrf();
    $name=trim($_POST['name']??''); $email=trim($_POST['email']??'');
    $password=$_POST['password']??''; $confirm=$_POST['confirm']??'';
    if ($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<8 || $password!==$confirm) {
        $error='กรุณากรอกข้อมูลให้ถูกต้อง และรหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร';
    } else {
        $stmt=$pdo->prepare('SELECT id FROM users WHERE email=?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) $error='อีเมลนี้ถูกใช้งานแล้ว';
        else {
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $stmt=$pdo->prepare('INSERT INTO users(name,email,password_hash,role) VALUES(?,?,?,?)');
            $stmt->execute([$name,$email,$hash,'user']);
            header('Location: login.php?registered=1'); exit;
        }
    }
}
require 'includes/header.php';
?>
<form class="form" method="post">
<h2>สมัครสมาชิก</h2>
<?php if($error): ?><div class="error"><?=e($error)?></div><?php endif; ?>
<input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
<label>ชื่อ</label><input name="name" required value="<?=e($_POST['name']??'')?>">
<label>Email</label><input type="email" name="email" required value="<?=e($_POST['email']??'')?>">
<label>รหัสผ่าน</label><input type="password" name="password" minlength="8" required>
<label>ยืนยันรหัสผ่าน</label><input type="password" name="confirm" minlength="8" required>
<br><br><button class="btn">สมัครสมาชิก</button>
</form>
<?php require 'includes/footer.php'; ?>
