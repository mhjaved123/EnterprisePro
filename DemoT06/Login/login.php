<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title>Login - Final Year Project Allocation System</title>
</head>

<style>

body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #007BAF;
}

/* Header */
.header {
  background: #004C6D;
  text-align: center;
  padding: 15px;
  color: white;
}

/* Increase Title font size */
.header h1 {
  font-size: 40px;
}

/* Login Form */
.form {
  border: 2px solid black;
  width: 300px;
  height:225px;
  background: #E8E8E8;
  border-radius: 10px;
  padding: 10px;
  align-items: center;
  position: relative;
  top: 40%;
  left: 40%;
  box-shadow: 15px 15px 12px #006587;
}

.form-header {
    text-align: center;
}

.form-input {
    position: absolute;
    left: 95px;
}

.submit-button {
    display: block;
    width: 100%;
    background-color: #0083B7;
    border: none;
    border-radius: 4px;
    padding: 7px;
    cursor: pointer;
    text-align: center;  
}

.submit-button:hover {
    background-color: #009DDB;
}

}

</style>

<body>

<!-- Page Title -->
<div class="header">
  <h1>Final Year Project Allocation System</h1>
  <p>By Team Horizon</p>
</div> 
<br><br><br><br><br><br>

    <!-- Login Form -->
    <form autocomplete="off" class="form" action="#" method="POST">
    <h2 class="form-header"> Enter your Details: </h2>
    <br>
    <div>
        <label class="label">User ID: </label>
        <input class="form-input" type ="number" name="userID" required>
    </div>   
    <br>
    <div>
        <label class="label">Username: </label>
        <input class="form-input" type ="text" name="username" required>
    </div>   
    <br> 
    <div>
        <label class="label">Password: </label>
        <input class="form-input" type ="password" name="password" required>
    </div>  
    <div>
     <br>
        <input class="submit-button" type="submit" value="Login">
    </div>   
    </form>
</body>   
</html> 

<?php

    // connect to server address, username, password, then database 
    $connection=mysqli_connect("localhost","root","","enterprise pro");

    //checks whether the database connection is successful or not
    if ($connection) {
        echo "";
        } else { 
        die("Connection failed");
        }

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $userID=$_POST["userID"];
        $username=$_POST["username"];
        $password=$_POST["password"];

        //executes the correct columns from the SQL Database
        $sql="SELECT userID, username, password, usertype FROM users 
        WHERE userID = '" . $userID . "' AND username= '" . $username . "' AND password= '" . $password . "' ";
        $result=mysqli_query($connection, $sql);

        //reads data from database
        $row=mysqli_fetch_array($result);

        //redirect to the correct page based on usertype
        if($row["usertype"] == "student") {
            $_SESSION["userID"] = $userID;
            $id = $row['userID'];
            header("location: http://localhost/enterprisepro/student/home/studhome.php?id=".$id);
        }

        elseif($row["usertype"] == "supervisor") {
            $_SESSION["userID"] = $userID;
            $id = $row['userID'];
            header("location:http://localhost/enterprisepro/supervisor/home/sprhome.php?id=".$id);
        }

        elseif($row["usertype"] == "module coordinator") {
            $_SESSION["userID"] = $userID;
            $id = $row['userID'];
            header("location: http://localhost/enterprisepro/module-coordinator/students/students.php?id=".$id);
        }

        elseif($row["usertype"] == null) {
            header("location: http://localhost/enterprisepro/login/login.php");
        }

    }    

?>