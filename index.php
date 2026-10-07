<?php
$title='หน้าแรก';
require 'includes/header.php';
?>
<section class="hero">
<h1>ระบบประกาศเช่าหอพัก</h1>
<p>ค้นหาและลงประกาศหอพักได้ง่ายในระบบเดียว</p>
<a class="btn" href="rooms.php">ดูประกาศหอพัก</a>
<?php if (!is_logged_in()): ?><a class="btn secondary" href="register.php">สมัครสมาชิก</a><?php endif; ?>
</section>
<?php require 'includes/footer.php'; ?>
