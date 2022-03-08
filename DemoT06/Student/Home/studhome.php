<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Student Home - Final Year Project Allocation System</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Header */
.header {
  background: #004C6D;
  text-align: center;
  padding: 75px;
  color: white;
}

/* Increase Title font size */
.header h1 {
  font-size: 40px;
}

/* Navigation bar */
.navbar {
  background-color: #007BAF;
  overflow: hidden;
}

/* Navigation bar links */
.navbar a {
  display: block;
  padding: 14px 20px;
  color: black;
  float: left;
  text-align: center;
  text-decoration: none;
  position: relative;
  left: 500px;
}

/* Change Navigation bar links on hover */
.navbar a:hover {
  background-color: #00A4E5;
  color: black;
}

/* Main body */
.main {   
  padding: 20px;
}

/* When screen is less than 400px wide, navbar links adjust*/
@media screen and (max-width: 400px) {
  .navbar a {
    width:100%;
    float: none;
  }
}

/* Database Table */
table, td, th {
  border: 1.2px solid black;
  padding: 5px;
}

table{
  border-collapse: collapse;
  width: 75%;
}

th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #008EC6;
  color: black;
}

/* Change colour of table rows when hovered over */
tr:nth-child(even) {background-color: #E8E8E8}
tr:hover {background-color: #CCCCCC}

td {
  text-align: center;
}

</style>
</head>
<body>

<!-- Page Title -->
<div class="header">
  <h1>Final Year Project Allocation System</h1>
  <p>By Team Horizon</p>
</div>

<!-- Navigation bar Links -->
<div class="navbar">
  <a href="http://localhost/enterprisepro/student/home/studhome.php">Home</a>
  <a href="http://localhost/enterprisepro/student/chooseproject/chooseproject.php">Choose Project</a>
  <a href="http://localhost/enterprisepro/login/login.php">Logout</a>
</div>

  <!-- Main Body -->
  <div class="main">
    <h2> Welcome, Student </h2>
    <p> View your details and allocated project </p>
    <br>

<!-- MYSQL Database Table -->
<table class="table">
      <thead>
        <tr>
          <th> Student ID </th>  
          <th> First Name </th>
          <th> Last Name </th>
          <th> Allocated Project </th>
          <th> Supervisor </th>
        </tr>
    </thead>

    <tbody>
    <?php

    // connect to server address, username, password, then database 
    $connection=mysqli_connect("localhost","root","","enterprise pro");

    //checks whether the database connection is successful or not
    if ($connection) {
    echo "";
    } else { 
    die("Connection failed");
    }

    //executes the correct columns from the SQL Database
    $_SESSION["userID"];
    $sql="SELECT studentNo, fName, lName, project, sprvisor
    FROM students s INNER JOIN users u ON s.studentNo = u.userID
    WHERE s.studentNo = '{$_SESSION['userID']}'";
    $results=mysqli_query($connection,$sql);  
    
    //reads data from database
    if (mysqli_num_rows($results)>0) {
    while($row=mysqli_fetch_array($results)) {
      echo "<tr>
      <td>" . $row["studentNo"] . "</td>
      <td>" . $row["fName"] . "</td>
      <td>" . $row["lName"] . "</td>
      <td>" . $row["project"] . "</td>
      <td>" . $row["sprvisor"] . "</td>
    </tr>";
    }
    }

    ?>
    </tbody>
  </table>
  <br>

</body>
</html>    