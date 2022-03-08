<?php
include_once 'supervisors.php';
session_start();

    //initialize variables
    $sprvisorNo = "";
    $fName = "";
    $lName = "";
    $project = "";
    $update = false;
    
    
// connect to server address, username, password, then database 
$connection=mysqli_connect("localhost","root","","enterprise pro");

// if 'Add Supervisor' button is clicked
if (isset($_POST['add'])){
    $sprvisorNo = $_POST['sprvisorNo'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $project = $_POST['project'];
    $userID = $_POST['sprvisorNo'];
    $username = substr($_POST['fName'], 0, 1) . '.' . $_POST['lName'];
    $password = 'supervisor123';
    $userType = 'supervisor';    

    //adds data to 'Supervisors' database (Creates new supervisor)
    $sql = "INSERT INTO supervisors (sprvisorNo, fName, lName, project) 
              VALUES ('$sprvisorNo', '$fName', '$lName', '$project')";
    $query = mysqli_query($connection, $sql);

    //adds data to 'Users' database (Creates new user account for supervisor)
    if($query) {
        $sql2 = "INSERT INTO users (userID, username, password, userType)
        VALUES ('$userID', '$username', '$password', '$userType')";
        $query2 = mysqli_query($connection, $sql2);
        }

    $_SESSION['msg'] = "Supervisor Record Added & User Account Created";
    header('location: supervisors.php'); //redirect to main page after insertion
}

// if 'Update Record' button is clicked
if (isset($_POST['update'])) {
    $sprvisorNo = mysqli_real_escape_string($connection, $_POST['sprvisorNo']);
    $fName = mysqli_real_escape_string($connection, $_POST['fName']);
    $lName = mysqli_real_escape_string($connection, $_POST['lName']);
    $project = mysqli_real_escape_string($connection, $_POST['project']);
    
    mysqli_query($connection, "UPDATE supervisors SET sprvisorNo='$sprvisorNo', 
    fName='$fName', lName='$lName', project='$project' WHERE sprvisorNo=$sprvisorNo");
    $_SESSION['msg'] = "Record updated";
    header('location: supervisors.php');

}

// if 'Delete' button is clicked
if (isset($_GET['del'])) {
    $id=$_GET['del'];

    //Deletes data from 'Supervisors' database 
    $sql = "DELETE FROM supervisors WHERE sprvisorNo='$id'";
    $query = mysqli_query($connection, $sql);

    //Deletes data from 'Users' database (Deletes user account)
    if($query) {
        $sql2 = "DELETE FROM users WHERE userID ='$id'";
        $query2 = mysqli_query($connection, $sql2);
    }

    $_SESSION['msg'] = "Supervisor Record & User Account Deleted";
    header('location: supervisors.php');
}
?>
