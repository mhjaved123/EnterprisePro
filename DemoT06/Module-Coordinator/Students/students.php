<?php include('student-crud.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>View Students - Final Year Project Allocation System</title>
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

/* 'Add New Student' & 'Update Student Records' Form */
.form {
  border: 2px solid black;
  width: 1230px;
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
  <a href="http://localhost/enterprisepro/module-coordinator/students/students.php">Students</a>
  <a href="http://localhost/enterprisepro/module-coordinator/supervisors/supervisors.php">Supervisors</a>
  <a href="http://localhost/enterprisepro/module-coordinator/projects/projects.php">Projects</a>
  <a href="http://localhost/enterprisepro/login/login.php">Logout</a>
</div>

  <!-- Main Body -->
  <div class="main">
    <h2> Welcome, Module Coordinator </h2>
    <p> View and edit student records </p>
    <br>

    <!-- Message displayed when records added, updated or deleted -->
    <?php if (isset($_SESSION['msg'])): ?>
  <div class ="msg">
    <?php
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
    ?>
  </div>
<?php endif ?>
<br>

<?php
//Fetch the record to be updated
if (isset($_GET['update'])) {
  $studentNo = $_GET['update'];
  $update = true;
  $rec = mysqli_query($connection, "SELECT * FROM students WHERE studentNo=$studentNo");
  $record = mysqli_fetch_array($rec);
  $studentNo = $record['studentNo'];
  $fName = $record['fName'];
  $lName = $record['lName'];
  $project = $record['project'];
  $sprvisorNo = $record['sprvisorNo'];
  $sprvisor = $record['sprvisor'];
}
?>

<!-- 'Add New Student' & 'Update Student Info' Form' -->
   <form autocomplete="off" class="form" method="POST" action="student-crud.php">
   <?php if ($update == false): ?>
    <h2 class="form-header"> Add a New Student: </h2>
  <?php else: ?>
    <h2 class="form-header"> Update Student Information: </h2>
    <?php endif ?>
    <div class="form-input">
      <label>Student ID: </label>
      <input type="number" name="studentNo" required value="<?php echo $studentNo; ?>">
   </div>
   <div class="form-input">
      <label>First Name: </label>
      <input type="text" name="fName" required value="<?php echo $fName; ?>">
   </div>
   <div class="form-input">
      <label>Last Name: </label>
      <input type="text" name="lName" required value="<?php echo $lName; ?>">
   </div>
   <div class="form-input">
      <label>Allocated Project: </label>
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
   <div class="form-input">
      <label>Supervisor ID: </label>
      <select id="supervisorNo" name="sprvisorNo" value="<?php echo $sprvisorNo; ?>">
        <option value ="301">301</option>
        <option value ="302">302</option>
        <option value ="303">303</option>
        <option value ="304">304</option>
        <option value ="305">305</option>
        <option value ="306">306</option>
        <option value ="307">307</option>
        <option value ="308">308</option>
      </select>
   </div>
   <div class="form-input">
      <label>Supervisor: </label>
      <select id="supervisors" name="sprvisor" value="<?php echo $sprvisor; ?>">
        <option value ="Paul Trundle">Paul Trundle</option>
        <option value ="Rob Holton">Rob Holton</option>
        <option value ="Raluca Lefticaru">Raluca Lefticaru</option>
        <option value ="Karim Sadik">Karim Sadik</option>
        <option value ="Ci Lei">Ci Lei</option>
        <option value ="Apostolos Vourdas">Apostolos Vourdas</option>
        <option value ="Sohag Kabir">Sohag Kabir</option>
        <option value ="Savas Konur">Savas Konur</option>
      </select>
   </div>
   <div class="form-input">
     <?php if ($update == false): ?>
      <button type="submit" name="add" class="form-btn">Add Student</button>
    <?php else: ?>
      <button type="submit" name="update" class="form-btn">Update Record</button>
    <?php endif ?>
   </div>
 </form>
 <br>
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
          <th> Modify </th>
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
        $sql="SELECT studentNo, fName, lName, project, sprvisor FROM students";
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
          <td>
            <a href='students.php?update=". $row["studentNo"] . "' class='update-btn'>Update</a>
            <a href='student-crud.php?del=" . $row["studentNo"] . "' class='delete-btn'>Delete</a>
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