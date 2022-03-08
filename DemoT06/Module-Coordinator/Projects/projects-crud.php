<?php
include_once 'projects.php';
session_start();

    //initialize variables
    $projectNo = "";
    $projectName = "";
    $sprvisor = "";
    $update = false;
    
    
// connect to server address, username, password, then database 
$connection=mysqli_connect("localhost","root","","enterprise pro");

// if 'Add Project' button is clicked
if (isset($_POST['add'])){
    $projectNo = $_POST['projectNo'];
    $projectName = $_POST['projectName'];
    $sprvisor = $_POST['sprvisor'];

    $query = "INSERT INTO projects (projectNo, projectName, sprvisor) 
              VALUES ('$projectNo', '$projectName', '$sprvisor')";
    mysqli_query($connection, $query);
    $_SESSION['msg'] = "Project Record Added";
    header('location: projects.php'); //redirect to main page after insertion
}

// if 'Update Record' button is clicked
if (isset($_POST['update'])) {
    $projectNo = mysqli_real_escape_string($connection, $_POST['projectNo']);
    $projectName = mysqli_real_escape_string($connection, $_POST['projectName']);
    $sprvisor = mysqli_real_escape_string($connection, $_POST['sprvisor']);
    
    mysqli_query($connection, "UPDATE projects SET projectNo='$projectNo', 
    projectName='$projectName', sprvisor='$sprvisor' WHERE projectNo=$projectNo");
    $_SESSION['msg'] = "Record updated";
    header('location: projects.php');

}

// if 'Delete' button is clicked
if (isset($_GET['del'])) {
    $id=$_GET['del'];

    $query = "DELETE FROM projects WHERE projectNo='$id'";
    mysqli_query($connection, $query);
    $_SESSION['msg'] = "Project Record Deleted";
    header('location: projects.php');
}
?>
