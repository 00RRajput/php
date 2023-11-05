<?php
require_once "conn_db.php";
if (isset($_POST['id'])) {
    $del = $_POST['id'];

    //กระบวนการลบไฟล์ในโฟล์เดอร์อัพโหลด

    $select_stmt = $conn->prepare('SELECT * FROM students WHERE id = :id');
    $select_stmt->bindParam(':id', $del);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    unlink("upload/" . $row['student_photo']); // unlink function permanently remove your file

    //กระบวนการลบเเถวในDb
    $sql = "DELETE FROM students where id= :id";
    $delete_stmt = $conn->prepare($sql);
    $delete_stmt->bindParam(':id', $del);
    $delete_stmt->execute();
    echo "Delete Successfully";
    header("Location: showstudent.php");
}
