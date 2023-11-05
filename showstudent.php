<?php
session_start();
require_once 'conn_db.php';
require_once 'header2.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: signin.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show student data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
</head>

<body>
    <div class="container mt-4">
        <h1>show student data</h1>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="insertStudent.php" class="btn btn-primary">เพิ่มข้อมูล</a>
        </div>
        <hr>
        <table id="stdTable" class="table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Class</th>
                    <th>Teacher</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT students.*, rooms.*, teachers.*
FROM students
INNER JOIN rooms ON students.room_id = rooms.room_id
INNER JOIN teachers ON rooms.teacher_id = teachers.teacher_id;
";
                //$sql = "SELECT * FROM students";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $student) :
                    $imageURL = 'upload/' . $student['student_photo'];
                ?>
                    <tr>
                        <?php $student['student_id']; ?>
                        <td><?php echo $student['student_id']; ?></td>
                        <td><?php echo $student['student_name']; ?></td>
                        <td><?php echo $student['student_surname']; ?></td>
                        <td><?php echo $student['student_address']; ?></td>
                        <td><?php echo $student['student_phone']; ?></td>
                        <td><?php echo $student['room_name']; ?></td>
                        <td><?php echo $student['teacher_name']; ?></td>
                        <td><img src="<?php echo $imageURL ?>" style="width: 25px;" class="card-img w-10" onclick="showImage(src)"></td>

                        <td>
                            <form action="updateform.php" method="post" style="display:inline;">
                                <input type="hidden" name="order" value="<?php echo $student['id'] ?>">
                                <input type="submit" name="edit" value="เเก้ไข" class="btn btn-warning btn-sm" ;>
                            </form>
                            <form action="deletestudent.php" method="post" style="display:inline;">
                                <!-- <input type="hidden" name="order" value="<?php  // echo $student['ID']; 
                                                                                ?>">
                                    <input type="submit" name="delete" value="ลบ" class="btn btn-danger btn-sm" ;>-->


                                <button type="button" class="button_D btn btn-danger btn-sm deletbutton" data-student-id="<?php echo $student['id'] ?> ">ลบ</button>
                            </form>
            </tbody>
        <?php endforeach ?>
        </table>
        <div>
            <a href=" index.php" class="btn btn-primary">กลับหน้าหลัก</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="http://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <script>
        //ใช้งาน DataTable เมื่อเว็บโหลดเสร็จ
        $(document).ready(function() {
            //เลือกตารางข้อมูล และเปิดใช้งาน datatable
            $('#stdTable').DataTable();
        });
    </script>

    <script>
        // ฟังก์ชันสำหรับแสดงกล่องยืนยัน SweetAlert2
        function showDeleteConfirmation(studentId) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: 'คุณจะไม่สามารถเรียกคืนข้อมูลกลับได้!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ลบ',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {
                    // หากผู้ใช้ยืนยัน ให้ส่งค่าฟอร์มไปยัง delete.php เพื่อลบข้อมูล
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'deletestudent.php';
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'id';
                    input.value = studentId;
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // แนบตัวตรวจจับเหตุการณ์คลิกกับปุ่มลบทั้งหมดที่มีคลาส deletebutton
        const deleteButtons = document.querySelectorAll('.button_D');
        deleteButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const studentId = button.getAttribute('data-student-id');
                showDeleteConfirmation(studentId);
            });
        });

        function showImage(src) {
            Swal.fire({
                title: '',
                text: '',
                imageUrl: src,
                imageWidth: 500,
                imageHeight: 500,
                imageAlt: '',
            })
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>