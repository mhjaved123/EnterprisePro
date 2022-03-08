<?php
include_once 'chooseproject.php';

    //initialize variables
    $studentNo = "";
    $fName = "";
    $lName = "";
    $project = "";
    $sprvisor = "";
    $update = false;
    
    
// connect to server address, username, password, then database name
$connection=mysqli_connect("localhost","root","","enterprise pro");

//if 'Update' button is clicked
if(isset($_POST['update'])) {
    $project = mysqli_real_escape_string($connection, $_POST['project']);

    mysqli_query($connection, "UPDATE students s SET s.project = '$project'
    WHERE s.studentNo = {$_SESSION['userID']}");
    $_SESSION['msg'] = "Allocated Project Updated";
    header('location: http://localhost/enterprisepro/student/chooseproject/chooseproject.php');
}

?>