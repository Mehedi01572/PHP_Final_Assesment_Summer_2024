<?php
session_start(); // Start the session to access session variables
require_once('../Models/alldb.php');

if (empty($_SESSION['employee_id'])) {
    header("Location: ../Views/login.php");
    exit();
}

// Get the employee ID from the session
$employeeId = $_SESSION['employee_id'];

// Function to get employee details by ID
function getEmployeeById($id) {
    $conn = getConnection();
    $sql = "SELECT * FROM employee WHERE ID = '$id'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    return mysqli_fetch_assoc($result); // Fetch as associative array
}

// Fetch employee details from the database
$employee = getEmployeeById($employeeId);

if (!$employee) {
    die("Employee not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Profile</title>
</head>
<body>
  <form action="../Controllers/logoutController.php" method="post">
    <center>
      <font size="+2">This is the employee profile page</font><br><br>  
      <h1>Welcome <?php echo $employee['Name']; ?></h1><br><br> 

      <!-- Display employee details in a table -->
      <font size="+2">
        <table border="1">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Salary</th>
          </tr>
          <tr>
            <td><?php echo $employee['ID']; ?></td>
            <td><?php echo $employee['Name']; ?></td>
            <td><?php echo $employee['Email']; ?></td>
            <td><?php echo $employee['Phone']; ?></td>
            <td><?php echo $employee['Salary']; ?></td>
          </tr>
        </table>
      </font>

      <br>
      <!-- Logout button -->
      <button style="width: 100px; height: 30px;" name="logout"><font size="+1">Logout</font></button><br><br>
    </center>
  </form>
</body>
</html>
