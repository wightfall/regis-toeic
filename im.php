<?php
session_start();
if (empty($_SESSION["username"])) {
print "<script>alert('Pleaes login')</script>" ;
print "<script>window.location='index.html';</script>" ;
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.5.1.js"></script>
    <!-- <script src="DataTables/media/js/jquery.js"></script>
    <script src="DataTables/media/js/jquery.dataTables.min.js"></script> -->
    <link rel="stylesheet" href="DataTables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="./style.css">
    <title>เพิ่มข้อมูลนักศึกษา</title>
</head>
    <!-- Navbar -->
    <nav class="navbar navbar-primary bg-primary ">
        <ul class="nav">
        <li class="nav-item">
            <a class="navbar-brand" href="admin_show.php">Regis Toeic</a>
        </li>
        <li class="nav-item">
            <a class="nav-link justify-content-start" href="admin_show.php">หน้าหลัก</a>
        </li>
        <li class="nav-item">
            <a class="nav-link justify-content-start" href="dep.php">สาขา</a>
        </li>
        <li class="nav-item">
            <a class="nav-link justify-content-start" href="add_m.php">เพิ่มผู้ใช้งาน</a>
        </li>
        <li class="nav-item">
            <a class="nav-link justify-content-start" href="log_show.php">ข้อมูลการใช้งาน</a>
        </li>
        </ul>

        <form class="form-inline" action="logout.php">
            <label class="form-label mr-sm-2">
                ผู้ใช้งานระบบ : namo            </label>
            <button class="btn btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
        </form>
    </nav>

    <!-- Content -->
    <div class="container">
        <div class="card mt-3">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a href="im.php" class="nav-link  active">นำข้อมูลเข้า</a>
                    </li>
    

                </ul>
            </div>
            <div class="card-body col-md-10 col-lg-8 col-xl-7 mx-auto   " style="height: 515px;">
            <meta charset="UTF-8">
                <form enctype="multipart/form-data" method="post" class=" text-center mt-4 ">
                   <img src="ex.png"width="300"height="200">   <a href="eg.emsdata.csv" class="center" class="form-label"  style="font-family: 'Kanit', sans-serif;">ตัวอย่างไฟล์</a>
                
                    <center><div class="col-12 col-md-9 mb-md-0 mt-3 ">
                        <input type="file" class="form-control form-control-lg" name="file" id="file" >
                      <p style="margin-top: 15px;"class="form-label"  style="font-family: 'Kanit', sans-serif;"><h6>Only CSV UTF-8 format.</h6></p>
                    </div></center>
                    <div class="mt-3">
                        <button class="btn btn-primary btn-lg" name="submit" value="submit" style="font-family: 'Kanit', sans-serif;">เพิ่มข้อมูลนักศึกษา</button><br>
                      <?php
if(isset($_POST["submit"]))
{
     $file = $_FILES['file']['tmp_name'];
     $handle = fopen($file, "r");
     $c = 0;
     include 'connect.php';

     while(($filesop = fgetcsv($handle, 1500, ",")) !== false) {
         $c = $c + 1;
         $student_id = $filesop[0];
         $student_pre_thai = $filesop[1];
         $student_name = $filesop[2];
         $student_surname = $filesop[3];
         $faculty_major = $filesop[4];
         $member_dep_major = $filesop[5];
         $member_dep_name = $filesop[6];
         $member_dep_address = $filesop[7];


         $sql = "insert into dataems ('student_id,student_pre_thai,student_name,student_surname,faculty_major,faculty_major,member_dep_major,member_dep_name,member_dep_address)
          values ('$student_id','$student_pre_thai','$student_name','$student_surname','$faculty_major','$faculty_major','$member_dep_major','$member_dep_name',' $member_dep_address')";
         if ($c > 1 ) {
        $result = $conn -> query($sql) ;
            if ($result) {
            }
             else {
                print "$ems_id ข้อมูลซ้ำในฐานข้อมูล ไม่สามารถเพิ่มได้ กรุณาตรวจสอบ<BR>";
          }
        }
    } 
      print "บันทึกข้อมูลเรียบร้อยแล้ว";
 }
 ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>