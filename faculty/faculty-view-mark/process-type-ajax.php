<?php
$conn = mysqli_connect("localhost", "root", "", "college");

if(!$conn){
    die('Failed');
}

session_start();

$fid = $_SESSION['fid'];

$sub_code = $_POST['subject'];
$lectype = $_POST['lectype'];

$sql = "SELECT DISTINCT(type) as type FROM subject_faculty_allocation where subject_code = $sub_code and faculty_id =$fid and lecture_type='theory'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
    echo "<option value='null'>--Select Division--</option>";
    while($row = mysqli_fetch_assoc($result)){
        $type = $row['type'];
        echo "<option value='".$type."'>".$type."</option>";
        
    }
}else{
    echo mysqli_error($conn);
}
