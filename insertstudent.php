<?php
session_start();
require_once 'conn_db.php';
require_once 'header2.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.72.0">
    <title>insert student</title>
    <!-- เพิ่ม URL ของ Bootstrap CSS ให้ถูกต้อง -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 border border-secondary rounded p-3" style="width: 600px;">
        <form action="insertstudentscrip.php" method="post" enctype="multipart/form-data">
            <h1>Add Student Data</h1>
            <?php
            if (isset($_SESSION['error'])) {
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php
            if (isset($_SESSION['success'])) {
            ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php  } ?>
            <?php
            if (isset($_SESSION['warning'])) {
            ?>
                <div class="alert alert-warning" role="alert">
                    <?php
                    echo $_SESSION['warning'];
                    unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>
            <!-- ปิดแท็ก h3 ให้ถูกต้อง -->
            <div class="mb-2">
                <label for="studentID" class="form-label">Student ID:</label>
                <input type="text" class="form-control" name="stdID">
            </div>
            <div class="mb-2">
                <label for="fname" class="form-label">Firstname:</label>
                <input type="text" name="fname" class="form-control">
            </div>
            <div class="mb-2">
                <label for="lname" class="form-label">Lastname:</label>
                <input type="text" name="lname" class="form-control">
            </div>
            <div class="mb-2">
                <label for="address" class="form-label">Address:</label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="mb-2">
                <label for="phone_no" class="form-label">Phone Number:</label>
                <input type="text" name="phone_no" class="form-control">
            </div>
            <div class="mb-2">
                <label for="class" class="form-label">Class:</label>
                <select id="class" name="class" class="form-select">
                    <?php
                    $sql = "SELECT * FROM rooms";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($rooms as $room) :
                    ?>
                        <option value="<?php echo $room['room_id'] ?>"><?php echo $room['room_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="phone_no" class="form-label">Student Photo:</label>
                <input type="file" name="photo_file" class="form-control streched-link" accept="image/gif, image/jpeg, image/png">
                <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
            </div>
            <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
        <hr>
        <p class="text-end"><a href="index.php">กลับหน้าหลัก</a></p>
    </div>
</body>

</html>