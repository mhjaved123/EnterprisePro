<?php include('sprhomecrud.php'); 
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Supervisor Home - Final Year Project Allocation System</title>
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

/* Alert message when adding/updating/deleting records */
.msg {
  padding: 10px;
  background-color: #63D35B;
  text-align: center;
  color: black;
  border: 2px solid black;
  border-color: #33632B;
  width: 35%;
  margin: 30px auto;
  border-radius: 10px;
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

/* Update Button */
.update-btn {
  background: #00A2D3;
  color: black;
  padding: 2px;
  margin: 8px;
  border-radius: 2px;
  transition-duration: 0.4s;
}

/* Change colour of Update button when hovered over */
.update-btn:hover {
  background-color: #00C7FF;
}

/* Delete Button */
.delete-btn {
  background: #EA0000;
  color: black;
  padding: 2px;
  margin: 8px;
  border-radius: 2px;
  transition-duration: 0.4s;
}

/* Change colour of Delete button when hovered over */
.delete-btn:hover {
  background-color: #FF0000;
}

/* 'Add New Project' & 'Update Project' Form */
.form {
  border: 2px solid black;
  width: 1130px;
  height:120px;
  background: #E8E8E8;
  border-radius: 10px;
  padding: 10px;
  display: flex;
  align-items: center;
}

.form-header {
  text-align: center;
  position: relative;
  top: -53px;
  display: inline-block;
  white-space: nowrap;
}

.form-input {
  padding: 12px;
  text-align: left;
  position: relative;
  left: -225px;
  margin-top: 10px;
}

.form-btn {
  border-radius: 8px;
  background: #0082B2;
  border: none;
  cursor: pointer;
  font-size: 14px;
  padding: 10px;
  transition-duration: 0.4s;
}

.form-btn:hover {
  background-color: #00A9ED;
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
  <a href="http://localhost/enterprisepro/supervisor/home/sprhome.php">Home</a>
  <a href="http://localhost/enterprisepro/supervisor/viewstudents/viewstudents.php">View Allocated Students</a>
  <a href="http://localhost/enterprisepro/login/login.php">Logout</a>
</div>

  <!-- Main Body -->
  <div class="main">
    <h2> Welcome, Supervisor </h2>
    <p> View and modify your project(s) </p>
    <br>

    
    <!-- Update Project Form -->
    <!--
    <form autocomplete="off" class="form" method="POST" action="sprhomecrud.php">
    <h2 class="form-header"> Update Project Information: </h2>
    <div class="form-input">
      <label>Project Name: </label>
      <input type="text" name="projectName" required value="<?php echo $projectName; ?>">
   </div>
   <button type="submit" name="update" class="form-btn">Update Record</button>
   </div>
 </form>
 <br>
 <br>
-->


<!-- MYSQL Database Table -->
<table class="table">
      <thead>
        <tr>
          <th> Supervisor ID </th>  
          <th> First Name </th>
          <th> Last Name </th>
          <th> Managing Project </th>
          <th> Modify Project </th>
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
    $sql="SELECT sprvisorNo, fName, lName, project
    FROM supervisors a INNER JOIN users b ON a.sprvisorNo = b.userID
    WHERE a.sprvisorNo = '{$_SESSION['userID']}'";
    $results=mysqli_query($connection,$sql);  
    
    //reads data from database
    if (mysqli_num_rows($results)>0) {
    while($row=mysqli_fetch_array($results)) {
      echo "<tr>
      <td>" . $row["sprvisorNo"] . "</td>
      <td>" . $row["fName"] . "</td>
      <td>" . $row["lName"] . "</td>
      <td>" . $row["project"] . "</td>
      <td>
      <a href='sprhome.php?update=". $row["sprvisorNo"] . "' class='update-btn'>Update</a>
      <a href='sprhome.php?del=" . $row["sprvisorNo"] . "' class='delete-btn'>Delete</a>
    </tr>";
    }
    }

    // if 'Update' button is clicked
    if (isset($_POST['update'])) {
        $project = mysqli_real_escape_string($connection, $_POST['project']);
        
        mysqli_query($connection, "UPDATE supervisors SET project='$project' 
        WHERE sprvisorNo=$sprvisorNo");
        $_SESSION['msg'] = "Record updated";
        header("location:http://localhost/enterprisepro/supervisor/home/sprhome.php?id=".$id);

    }

    ?>
    </tbody>
  </table>
  <br>

</body>
</html>    