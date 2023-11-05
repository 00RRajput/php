<?php
// connect DB
require_once 'conn_db.php';
session_start();

if (isset($_POST['submit'])) {
    // สร้างตัวแปร เพื่อรับค่าจากฟอร์ม
    $stdID = $_POST['stdID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $phone = $_POST['phone_no'];
    $class = $_POST['class'];

    // ตรวจสอบความซ้้าซ้อนของรหัสนักศึกษาในฐานข้อมูล
    $check_stdID = $conn->prepare("SELECT student_id FROM students WHERE student_id = ?");
    $check_stdID->bindParam(1, $stdID);
    $check_stdID->execute();

    if (empty($stdID)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสนักศึกษา';
        header("location: insertStudent.php");
    } else if (empty($fname)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: insertStudent.php");
    } else if (empty($lname)) {
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        header("location: insertStudent.php");
    } else if (empty($address)) {
        $_SESSION['error'] = 'กรุณากรอกที่อยู่';
        header("location: insertStudent.php");
    } else if (empty($phone)) {
        $_SESSION['error'] = 'กรุณากรอกเบอร์โทร';
        header("location: insertStudent.php");
    } else if ($check_stdID->rowCount() > 0) {
        $_SESSION['warning'] = "มีรหัสนักศึกษานี้อยู่แล้ว";
        header("location: insertStudent.php");
    } else {
        try {

            if (isset($_FILES['photo_file']) && !empty($_FILES['photo_file']['name'])) {
                // เซ็ตต้าแหน่งที่จะบันทึกไฟล์รูป
                $targetDir = "upload/"; // แก้ไขต้าแหน่งเก็บรูปได้ตามที่คุณต้องการ
                $fileName = basename($_FILES['photo_file']['name']);
                $size = $_FILES['photo_file']['size'];
                $targetFilePath = $targetDir . $fileName;

                // ตรวจสอบว่าไฟล์เป็นรูปภาพหรือไม่
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                // Allow certain file formats
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'JPG', 'PNG');
                if (in_array($fileType, $allowTypes)) {
                    if (!file_exists($targetFilePath)) { // check file not exist in your upload folder path
                        if ($size < 5000000) { // check file size 5MB
                            if (move_uploaded_file($_FILES['photo_file']['tmp_name'], $targetFilePath)) {
                                if (!isset($_SESSION['error'])) {
                                    $sql = "INSERT INTO students (student_id, student_name, student_surname, student_address, student_phone, student_photo, room_id) VALUES (?,?,?,?,?,?,?)";

                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(1, $stdID);
                                    $stmt->bindParam(2, $fname);
                                    $stmt->bindParam(3, $lname);
                                    $stmt->bindParam(4, $address);
                                    $stmt->bindParam(5, $phone);
                                    $stmt->bindParam(6, $fileName); // เก็บต้าแหน่งของไฟล์รูป
                                    $stmt->bindParam(7, $class);

                                    $result = $stmt->execute();

                                    // echo "Success";
                                    // sweetalert
                                    echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>";

                                    if ($result) {

                                        echo "<script>setTimeout(function(){
                                                Swal.fire({
                                                    position: 'center',
                                                    icon: 'success',
                                                    title: 'บันทึกข้อมูลสำเร็จ',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function(){
                                                    window.location = 'showstudent.php';
                                                });
                                            }
                                                
                                                ,1000);
                                                </script>";
                                    } else {
                                        echo "<script>setTimeout(function(){
                                                Swal.fire({
                                                    position: 'center',
                                                    icon: 'error',
                                                    title: 'บันทึกข้อมูลไม่สำเร็จ',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function(){
                                                    window.location = 'showstudent.php';
                                                });
                                            }
                                                
                                                ,1000);
                                                </script>";
                                    }
                                } else {
                                    $_SESSION['error'] = "มีข้อผิดพลาด";
                                    header("location: insertStudent.php");
                                }
                            } else {
                                $_SESSION['error'] = "มีข้อผิดพลาดในการอัปโหลดไฟล์รูป";
                                header("location: insertStudent.php");
                            }
                        } else {
                            $_SESSION['warning'] = "ขนาดไฟล์ใหญ่เกิน 5MB";
                            header("location: insertStudent.php");
                        }
                    } else {
                        $_SESSION['warning'] = "มีไฟล์นี้อยู่แล้ว..กรุณาเปลี่ยนชื่อไฟล์";
                        header("location: insertStudent.php");
                    }
                } else {
                    $_SESSION['warning'] = "เฉพาะไฟล์รูปภาพเท่านั้นที่อนุญาตให้อัปโหลด (jpg, jpeg, png, gif)";
                    header("location: insertStudent.php");
                }
            } else {
                $_SESSION['error'] = "กรุณาเลือกไฟล์รูป";
                header("location: insertStudent.php");
            }

            //************************************************************************************** 

            // *************************************************************************
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
