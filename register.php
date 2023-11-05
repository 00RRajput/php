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
    <title>register</title>
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
        <form action="register_db.php" method="post">
            <!-- ปิดแท็ก h3 ให้ถูกต้อง -->
            
            <?php if(isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger" role="alert">
        <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        ?>
    </div>
<?php } ?>

<?php if(isset($_SESSION['success'])) { ?>
    <div class="alert alert-success" role="alert">
        <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        ?>
    </div>
<?php } ?>
<?php if(isset($_SESSION['warning'])) { ?>
    <div class="alert alert-warning" role="alert">
        <?php
            echo $_SESSION['warning'];
            unset($_SESSION['warning']);
        ?>
    </div>
<?php } ?>
             <h3 class="mt-4">register</h3>
            <hr>
            <div class="mb-3">
                <label for="firstname" class="form-label">firstname</label>
                <input type="firstname" class="form-control" name="firstname">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">lastname</label>
                <input type="lastname" class="form-control" name="lastname">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">confirmpassword</label>
                <input type="text" class="form-control" name="confirm_password">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary"name="register">submit</button>
            </div>
        </form>
        <hr>
        <p class=text-start>เป็นสมาชิกเเล้วใช่หรือไม่ คลิกตรงนี้เพื่อ<a href=signin.php>
                <เข้าสู่ระบบ>
    </div>
</body>

</html>