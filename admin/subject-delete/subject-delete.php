<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (!isset($_SESSION['aid'])) {
    header("Location: ../../index.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Subject Delete</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../bootstrap-4.1.1-dist/css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="../../css/style.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> <!-- cdn google icons -->
        <script src="../../jquery/jquery-3.3.1.js"></script> <!-- jquery js -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            require_once '../../master-layout/admin/master-page-admin.php';
            ?>
            <?php
            require_once '../../Connection.php';
            $connection = new Connection();
            $conn = $connection->createConnection("college");

            $dept_id = $_SESSION['a_dept_id'];
            $sql = "select * from subject where dept_id = $dept_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                ?>
                <form action="subject-delete.php" method="post">
                    <div class="row form-group" style="margin-top: 2%;">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <select name="subject" class="form-control">
                                <option value="" disabled selected>--Select Subject--</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $row['subject_code'] ?>"><?php echo $row['subject_name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <input type="submit" class="form-control btn btn-danger" name="btnSubmit" id="btnSubmit"/>
                        </div>
                    </div>
                </form>
                <?php
            }else{
                ?>
                <div class="text-center" style="margin-top: 3%;">
                    <h5>No Subject Detail Available</h5>
                </div>
                <?php
            }    
        if(isset($_POST['subject']) && $_POST['subject']!="")
        {
            $sql = "delete from subject where subject_code=".$_POST['subject'];
            if(mysqli_query($conn, $sql))
            {
                ?>
                    <div class="alert alert-success">Record Delete Sucessfully...Redirecting</div>
                    <script>
                        setTimeout(function(){
                            window.location.href='subject-delete.php';
                        },1000);
                    </script>
                <?php
            }
        }
                ?>
        </div>
    </body>
</html>
