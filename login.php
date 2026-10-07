<?php
require 'config/database.php';
require 'includes/auth.php';
if (is_logged_in()) { header('Location: index.php'); exit; }
$title='เข้าสู่ระบบ'; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    check_csrf();
    $email=trim($_POST['email']??''); $password=$_POST['password']??'';
    $stmt=$pdo->prepare('SELECT * FROM users WHERE email=? LIMIT 1');
    $stmt->execute([$email]); $user=$stmt->fetch();
    if ($user && password_verify($password,$user['password_hash'])) {
        login_user($user);
        header('Location: '.($user['role']==='admin'?'admin/index.php':'index.php')); exit;
    }
    $error='Email หรือรหัสผ่านไม่ถูกต้อง';
}
require 'includes/header.php';
?>
<form class="form" method="post">
<h2>เข้าสู่ระบบ</h2>
<?php if(isset($_GET['registered'])):?><div class="success">สมัครสมาชิกสำเร็จ กรุณาเข้าสู่ระบบ</div><?php endif;?>
<?php if($error):?><div class="error"><?=e($error)?></div><?php endif;?>
<input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
<label>Email</label><input type="email" name="email" required>
<label>รหัสผ่าน</label><input type="password" name="password" required>
<br><br><button class="btn">เข้าสู่ระบบ</button>
</form>
<?php require 'includes/footer.php'; ?>
