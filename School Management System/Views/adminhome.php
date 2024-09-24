<?php
require_once '../Models/alldb.php';

$error = '';
$message = '';

// Handle adding an employee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];

    addEmployee($id, $name, $pass, $email, $phone, $salary);
    $message = "Employee added successfully!";
}

// Handle updating an employee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];

    updateEmployee($id, $name, $pass, $email, $phone, $salary);
    $message = "Employee updated successfully!";
}

// Handle deleting an employee
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteEmployee($id);
    $message = "Employee deleted successfully!";
}

// Fetch all employees
$employees = getAllEmployees();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
</head>
<body>
    <div class="admin-home">
        <h2>Admin Home</h2>
        
        <?php if (!empty($message)): ?>
            <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <h3>All Employees</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($employees)): ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Pass']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Phone']; ?></td>
                        <td><?php echo $row['Salary']; ?></td>
                        <td>
                            <a href="?edit=<?php echo $row['ID']; ?>">Edit</a>
                            <a href="?delete=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Add / Update Employee</h3>
        <form action="adminhome.php" method="POST">
            <input type="hidden" name="id" value="<?php echo isset($_GET['edit']) ? $_GET['edit'] : ''; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required><br>
            <label for="salary">Salary:</label>
            <input type="number" id="salary" name="salary" required><br>
            <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update' : 'add'; ?>">
                <?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?>
            </button>

            </form>
            <br><br>
            <!-- Logout button -->
            <form action="../Controllers/logoutController.php" method="post">
            <button style="width: 100px; height: 30px;" name="logout"><font size="+1">Logout</font></button><br><br>
        </form>
    </div>
</body>
</html>
