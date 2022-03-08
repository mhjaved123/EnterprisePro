<?php include('chooseprojectcrud.php'); 
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Choose Project - Final Year Project Allocation System</title>
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

/* Alert message when updating records */
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


/* 'Update Project' Form */
.form {
  border: 2px solid black;
  width: 275px;
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
  display: inline-block;
  top: -55px;
  white-space: nowrap;
}

.form-input {
  padding: 12px;
  text-align: left;
  position: relative;
  left: -235px;
  margin-top: 10px;
}

.form-btn {
    border-radius: 8px;
    /*background-color: #0082B2; */
    border: none;
    cursor: pointer;
    font-size: 14px;
    padding: 7px; 
    position: relative; 
    left: -100px;
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
    <h2> Choose project </h2>
    <p> View all projects and choose your preferred one </p>
    <br>

    <!-- Alert Message when updating project -->
    <?php if (isset($_SESSION['msg'])): ?>
     <div class="msg">
        <?php
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        ?>   
     </div>
    <?php endif ?> 

        <!-- Update Project Form -->
    <form autocomplete="off" class="form" method="POST" action="chooseprojectcrud.php">
    <h2 class="form-header"> Select from the list: </h2>
        <div class="form-input">
      <label>Choose a new Project: </label>
      <select id="projects" name="project" value="<?php echo $project; ?>">
        <option value ="Face Detection">Face Detection</option>
        <option value ="Online Auction System">Online Auction System</option>
        <option value ="Eye Tracker">Eye Tracker</option>
        <option value ="e-Authentication System">e-Authentication System</option>
        <option value ="Crime Rate Prediction">Crime Rate Prediction</option>
        <option value ="Symbol Recognition">Symbol Recognition</option>
        <option value ="Search Engine">Search Engine</option>
        <option value ="Online eBook Maker">Online eBook Maker</option>
      </select>
   </div>
   <div class="form-btn">
      <button type="submit" name="update" class="form-btn">Update</button>
   </div>
 </form>
 <br>
 <br>

     <!-- MYSQL Database Table -->
     <table class="table">
      <thead>
        <tr>
          <th> Project ID </th>
          <th> Project Name </th>
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
        $sql="SELECT projectNo, projectName, sprvisor FROM projects";
        $results=mysqli_query($connection,$sql);

        //reads data from database
        if (mysqli_num_rows($results)>0) {
        while($row=mysqli_fetch_array($results)) {
          echo "<tr>
          <td>" . $row["projectNo"] . "</td>
          <td>" . $row["projectName"] . "</td>
          <td>" . $row["sprvisor"] . "</td>
        </tr>";
        }
        }

        //close the database connection
        mysqli_close($connection);

     
    ?>
    </tbody>
  </table>
  <br>
  

</body>
</html>