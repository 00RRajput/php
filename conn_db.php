<?php
$servername = "localhost";
$databasename = "mydb6438";
$username = "root";
$password = "";

try {
    // เชื่อมต่อกับฐานข้อมูล MySQL
    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    // ตั้งค่า PDO error mode เพื่อให้แสดงข้อผิดพลาดเป็น Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "เชื่อมต่อฐานข้อมูลสำเร็จเเล้วนะจ๊ะ";
    // เพิ่มโค้ดส่วนอื่น ๆ ที่ทำการดำเนินการกับฐานข้อมูลที่เปิดต่อไว้ ยกตัวอย่างเช่น:

} catch (PDOException $e) {
    // ในกรณีเกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล หรือในคำสั่ง SQL
    echo "พบข้อผิดพลาด: " . $e->getMessage();
}


?>