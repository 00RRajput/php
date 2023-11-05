<?php
session_start();
require_once 'header.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.72.0">
    <title>login</title>
    <!-- เพิ่ม URL ของ Bootstrap CSS ให้ถูกต้อง -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .new_container {
        width: 600px;
        padding: 20px;
        boarder: 1px solid #ccc;
        border-radius: 5px;
        background-color: aqua;
    }
</style>

<body>
    <div class="container new_container mt-5">
        <form action="signin_db.php" method="post">
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <!-- ปิดแท็ก h3 ให้ถูกต้อง -->
            <h3 class="mt-4">login</h3>
            <hr>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="d-grid">
                <button type="submit" name="signin" class=" btn btn-primary">submit</button>
            </div>
        </form>
        <hr>
        <p class=text-start>ยังไม่เป็นสมาชิกใช่หรือ่ไม่คลิกที่นี่<a href=register.php>
                <ลงทะเบียน>
    </div>
</body>

</html>