<?php
require_once('db.php');

function getAllEmployees() {
    $conn = getConnection();
    $sql = "SELECT * FROM employee";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function addEmployee($name, $pass, $email, $phone, $salary) {
    $conn = getConnection();
    
    // Get the last employee ID
    $sql = "SELECT MAX(ID) AS max_id FROM employee";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    // Determine the new employee ID
    $new_id = isset($row['max_id']) ? $row['max_id'] + 1 : 201; // Start from 201 if no employees exist

    // Insert the new employee with the new ID
    $sql = "INSERT INTO employee (ID, Name, Pass, Email, Phone, Salary) VALUES ('$new_id', '$name', '$pass', '$email', '$phone', '$salary')";
    mysqli_query($conn, $sql);
}

function updateEmployee($id, $name, $pass, $email, $phone, $salary) {
    $conn = getConnection();
    $sql = "UPDATE employee SET Name='$name', Pass='$pass', Email='$email', Phone='$phone', Salary='$salary' WHERE ID='$id'";
    mysqli_query($conn, $sql);
}

function deleteEmployee($id) {
    $conn = getConnection();
    $sql = "DELETE FROM employee WHERE ID='$id'";
    mysqli_query($conn, $sql);
}

// Function to check if an admin exists by ID
function adCheck($id) {
    $conn = getConnection();
    $sql = "SELECT * FROM admin WHERE ID='$id'";
    $res = mysqli_query($conn, $sql);
    return $res;
}

// Function to check if an employee exists by ID
function empCheck($id) {
    $conn = getConnection();
    $sql = "SELECT * FROM employee WHERE ID='$id'";
    $res = mysqli_query($conn, $sql);
    return $res;
}

// Function to insert a new admin
function insertAdmin($id, $pass) {
    $conn = getConnection();
    $sql = "INSERT INTO admin (ID, pass) VALUES ('$id', '$pass')";
    $res = mysqli_query($conn, $sql);
    return $res;
}

// Function to insert a new employee
function insertEmployee($id, $name, $pass, $email, $phone, $salary) {
    $conn = getConnection();
    $sql = "INSERT INTO employee (ID, Name, Pass, Email, Phone, Salary) VALUES ('$id', '$name', '$pass', '$email', '$phone', '$salary')";
    $res = mysqli_query($conn, $sql);
    return $res;
}


// Function to retrieve all employees
function getEmployees() {
    $conn = getConnection();
    $sql = "SELECT * FROM employee";
    $res = mysqli_query($conn, $sql);
    return $res;
}

// Function to retrieve all admins
function getAdmins() {
    $conn = getConnection();
    $sql = "SELECT * FROM admin";
    $res = mysqli_query($conn, $sql);
    return $res;
}
?>
