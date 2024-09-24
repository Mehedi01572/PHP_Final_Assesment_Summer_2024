<?php
session_start();
require_once('../Models/alldb.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = trim($_POST['id']);
    $password = trim($_POST['password']);

    // Check if the user is an admin
    $adminResult = adCheck($id);
    $adminData = mysqli_fetch_assoc($adminResult);

    if ($adminData && $adminData['pass'] === $password) {
        $_SESSION['admin_id'] = $id; // Store admin ID in session
        header("Location: ../Views/adminhome.php");
        exit();
    }

    // Check if the user is an employee
    $employeeResult = empCheck($id);
    if ($employeeResult && $row = mysqli_fetch_assoc($employeeResult)) {
        if (password_verify($password, $row['Pass'])) {
            $_SESSION['employee_id'] = $row['ID'];
            $_SESSION['employee_name'] = $row['Name'];
            header("Location: ../Views/employeehome.php");
            exit();
        } else {
            $error = "Invalid ID or password.";
        }
    } else {
        $error = "Employee not found.";
    }
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

        <form action="login.php" method="POST">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
