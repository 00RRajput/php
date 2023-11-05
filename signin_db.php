<?php
session_start();
require_once 'conn_db.php';
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header('Location: signin.php');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header('Location: signin.php');
    } elseif (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header('Location: signin.php');
    } else {
        // Prepare
        $sql = "SELECT * FROM users WHERE email = ?";
        $star_data = $conn->prepare($sql);
        // Bind parameter
        $star_data->bindparam(1, $email);
        // Execute
        $star_data->execute();
        $row = $star_data->fetch(PDO::FETCH_ASSOC);

        // Check if there is data in the database
        if ($star_data->rowCount() > 0) {
            if ($email == $row["email"]) {
                //เช็ครหัสผ่านตรงกันหรือไม่
                if (password_verify($password, $row["password"])) {
                    if ($row['urole'] == 'admin') {
                        $_SESSION['admin_login'] = $row['user_id'];
                        header('Location: showstudent.php');
                    } else {
                        $_SESSION['user_login'] = $row['user_id'];
                        header('Location: user.php');
                    }
                } else {
                    $_SESSION['error'] = 'รหัสผ่านผิดพลาด';
                    header('Location: signin.php');
                }
            } else {
                $_SESSION['error'] = 'อีเมลไม่ถูกต้อง';
                header('Location: signin.php');
            }
        } else {
            $_SESSION['error'] = 'ไม่พบข้อมูล';
            header('Location: signin.php');
        }
    }
}
