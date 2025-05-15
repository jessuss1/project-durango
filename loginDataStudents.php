<?php
session_start();
include_once("DBConnect.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from POST request
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Initialize PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Using prepared statement with MySQLi
    $stmt = $conn->prepare("SELECT name FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found
        // Proceed with further authentication

        // Fetch the result
        $user = $result->fetch_assoc();

        // Using prepared statement with PDO
        $stmt = $pdo->prepare("SELECT id, name, email FROM students WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Passwords match
            // Redirect to landing page or do further processing
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            //Set cookie for a day
            setcookie("email", $email, time() + 86400, "/");
            header('Location: index_students.php');
            exit();
        } else {
            // Passwords do not match
            header('Location: login.php?status=invalid_login');
            exit();
        }
    } else {
        // No user found with the given email
        header('Location: login.php?status=invalid_username');
        exit();
    }
}
?>
