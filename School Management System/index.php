<?php
require_once 'Models/alldb.php'; 
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Check if the user is an admin
    $adminResult = adCheck($id);
    $adminData = mysqli_fetch_assoc($adminResult);

    if ($adminData && $adminData['pass'] === $password) {
        // Redirect to admin home page
        header('Location: Views/adminhome.php');
        exit();
    }

    // Check if the user is an employee
    $employeeResult = empCheck($id);
    $employeeData = mysqli_fetch_assoc($employeeResult);

    if ($employeeData && $employeeData['Pass'] === $password) { // Direct comparison
        // Set session variables for the employee
        session_start();
        $_SESSION['employee_id'] = $employeeData['ID'];
        $_SESSION['employee_name'] = $employeeData['Name'];
        
        // Redirect to employee home page
        header('Location: Views/employeehome.php');
        exit();
    }

    // If no match found, set an error message
    $error = 'Invalid ID or Password!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="index.php" method="POST">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" required><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
<br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
