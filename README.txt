ระบบประกาศเช่าหอพัก DormRent
PHP 8+ / MySQL / PDO

วิธีติดตั้ง XAMPP
1. แตกโฟลเดอร์ dorm_rental ไปไว้ใน htdocs
2. เปิด Apache และ MySQL
3. เข้า phpMyAdmin แล้ว Import ไฟล์ database.sql
4. ตรวจ config/database.php ให้ตรงกับ MySQL ของเครื่อง
5. เปิด http://localhost/dorm_rental/
6. สมัครสมาชิก 1 บัญชี
7. หากต้องการให้เป็น Admin ให้รัน:
   UPDATE users SET role='admin' WHERE email='อีเมลบัญชี';
8. Logout แล้ว Login ใหม่ จะเห็นเมนู Admin

Security ที่มีในโปรเจกต์:
- password_hash/password_verify
- PDO prepared statements ป้องกัน SQL Injection
- htmlspecialchars ป้องกัน XSS ตอนแสดงข้อมูล
- CSRF token สำหรับฟอร์ม
- session_regenerate_id หลัง login
- Role-based access control สำหรับ Admin
- Owner authorization: user_id ต้องตรงกับผู้ล็อกอินก่อนแก้ไข/ลบ
- Server-side validation
- จำกัดสถานะประกาศด้วย ENUM

หมายเหตุ:
- ระบบนี้เป็นโครงงานพื้นฐานสำหรับการเรียน
- ก่อนขึ้น Host ควรเปลี่ยนรหัสผ่านฐานข้อมูลใน config/database.php
- ควรตั้ง HTTPS บน Host จริง
