<?php
session_start();
$type =$_SESSION["username"];
include 'connect.php';
// log
date_default_timezone_set('Asia/Bangkok');
$date = new DateTime("now"); 
$LoginTime = $date->format('Y-m-d H:i:s');
$userLogin = $_SESSION["user"];
$ip = $_SERVER['REMOTE_ADDR'];

$sql_log = "INSERT into tbl_logdata values ('','$LoginTime','$userLogin','$ip','edit User')";
$result_log = $conn->query($sql_log);

$id = $_GET['id'];

$sql_info = "SELECT * FROM tbl_member,tbl_member_type,tbl_member_dep 
WHERE tbl_member.member_department = tbl_member_dep.member_dep_code and tbl_member.member_type = tbl_member_type.member_type_code and tbl_member.member_username = '$id'";
//tbl_member.member_type = tbl_member_type.member_type_code
$result_info = $conn->query($sql_info);
if ($result_info) {
    $row = $result_info->fetch_assoc();
    $member_username =$row['member_username'];
    $member_password =$row['member_password'];
    $member_mail =$row['member_mail'];
    $member_card_id =$row['member_card_id'];
    $member_name =$row['member_name'];
    $dep_name = $row['member_dep_name'];
    $dep_major = $row['member_dep_major'];
    $dep_faculty  = $row['member_dep_faculty'];
    $dep_address  = $row['member_dep_address'];
    $dep_code =$row["member_dep_code"];
}




// กำหนดหน้า
// if (!isset($_GET['page'])) {
//     $page = 1;
//  }
//  else {
//     $page = $_GET['page'];
//  }

 // เช็ค type user
//  if (!isset($_POST['txtsearch'])) {

//     $sql_count = "SELECT  *  FROM  tbl_score where student_id = '$id'";
        
//     $result = $conn -> query($sql_count)  ;
//     /* หาจำนวน Record ทั้งหมด */
//     $total_records=mysqli_num_rows($result);
//     $show_record = 10 ;
//     $amountOfPage=(int)($total_records/$show_record) ;
//     if($total_records%$show_record != 0) $amountOfPage++;
     
//     $startRec = ($page*$show_record) - $show_record ;
     
//     $sql_show = "SELECT  *  FROM  tbl_score where student_id = '$id'
//     limit $startRec,$show_record";
// }
// // กรณีค้นหา
// else{
//     $search = $_POST['txtsearch'];
//         $sql_count = "SELECT  *  FROM  tbl_score where student_id = '$id'";
        
//         $result = $conn -> query($sql_count)  ;
//         /* หาจำนวน Record ทั้งหมด */
//         $total_records=mysqli_num_rows($result);
//         $show_record = 10 ;
//         $amountOfPage=(int)($total_records/$show_record) ;
//         if($total_records%$show_record != 0) $amountOfPage++;
     
//         $startRec = ($page*$show_record) - $show_record ;
     
//         $sql_show = "SELECT  *  FROM  tbl_score where student_id = '$id' limit $startRec,$show_record";
// }



?>
<!DOCTYPE html>
<html lang="en">

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
    <title>Score</title>
</head>

<body>
    <!-- nav bar -->
    <nav class="navbar navbar-primary bg-primary ">
    <ul class="nav">
        <li class="nav-item">
            <a class="navbar-brand" href="user_show.php">Regis Toeic</a>
        </li>
        <li class="nav-item">
            <a class="nav-link justify-content-start" href="user_show.php">หน้าหลัก</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link justify-content-start" href="Editonly.php?id=<?php print $type ?>">ข้อมูลผู้ใช้งาน</a>
        </li>
    
        </ul>

        <form class="form-inline" action="logout.php" class="justify-content-end">
            <label class="form-label mr-sm-2" >
                ผู้ใช้งานระบบ : <?php print $_SESSION["user"]; ?>
            </label>
            <button class="btn btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
        </form>
    </nav>

    <!-- card -->
    <div class="container-fluid mt-0 pt-3" style="text-align: center; border-radius: 25px;">
        <div class="card bg-info text-white text-left p-3" style="text-align: center; border-radius: 25px;">
            <!-- head -->
            <div class="card-header bg-info text-white justify-content-between">
                <div class="form-inline justify-content-between">
                    <h3>ข้อมูลผู้ใช้งานของ : <?php print $member_name."/".$member_username; ?> </h3>

                    <form method="post" action="up_user.php?id=<?php print $id?>"  name="txtid" class="form-inline ">
                            <button class="btn btn-success my-2 my-sm-0" type="submit">บันทึก</button>
                    
                </div>


            </div>

            <!-- body -->
                <table class="table table-borderless text-white">
                    <tbody>
                        <tr>
                        <th scope="row">
                            <label class="form-label mr-sm-2" for="inlineFormCheck">
                                ชื่อผู้ใช้งาน : 
                                </label>
                                <input type="text" class="form-control" name="txtmember_name" value="<?php print $member_name; ?>">
                             </th>
                            
                             <th scope="row">
                            <label class="form-label mr-sm-2" for="inlineFormCheck">
                                Password : 
                                </label>
                                <input type="text" class="form-control" name="txtmember_password" value="<?php print $member_password; ?>">
                             </th>
                             <th scope="row">
                            <label class="form-label mr-sm-2" for="inlineFormCheck">
                                E-mail : 
                                </label>
                                <input type="text" class="form-control" name="txtmember_mail" value="<?php print $member_mail; ?>">
                             </th>
                        </tr>
                        <tr>

                        <th scope="row">
                            <label class="form-label mr-sm-2" for="inlineFormCheck">
                                Card Id : 
                                </label>
                                <input type="text" class="form-control" name="txtmember_card_id" value="<?php print $member_card_id; ?>">
                             </th>

                            <th scope="row">
                            <label class="form-label mr-sm-2" for="inlineFormCheck">
                            สังกัด :
                            </label>
                            </div>
                           
                           
                            <?php $sql1 = "SELECT * FROM tbl_member_dep ";
                            $result1 = $conn->query($sql1);
                            if ($result1) {
                                
                                $dep_name = $row['member_dep_name'];
                                $dep_major = $row['member_dep_major'];
                                $dep_faculty  = $row['member_dep_faculty'];
                                $dep_address  = $row['member_dep_address'];
                                $dep_code =$row["member_dep_code"];
                                $Full = $row['member_dep_name']." ".$row['member_dep_major']." ".$row['member_dep_faculty']."".$row['member_dep_address'];
                            }?> 
                    
                    <select name="txtdepcode" class="form-control">
                            <option value=""><?php print $Full; ?></option>
                           
                        </select>
                        
                        </div>
                  
                      
                            <th scope="row">
                            <label class="form-label mr-sm-2" for="inlineFormCheck">  
                            ระดับ : 
                                </label>
                            </div>
                           
                           
                            <?php $sql2 = "SELECT * FROM tbl_member_type ";
                            $result2 = $conn->query($sql2);
                            if ($result2) {
                                $member_type_code = $row['member_type_code'];
                                $member_type_name = $row['member_type_name'];
                            }?> 
                    
                    <select name="txttypecode" class="form-control" >
                    <option value="<?php print $member_type_name; ?>"><?php print $member_type_name; ?></option>
                    </select>
                        
                        </div>
                  
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>