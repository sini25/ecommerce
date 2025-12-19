<?php
session_start();
include_once '../config/db.php';

$db = new Database();
$conn = $db->getConnection();

$error = "";

function write_log($message) {
    $logFile = __DIR__ . "/log.txt";
    $timestamp = date("Y-m-d H:i:s");
    if (file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND) === false) {
        echo "Failed to write log!";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if ($email === "" || $password === "") {
        $error = "All fields required";
        write_log("Login failed: empty fields");
        exit;
    }

    $stmt = $conn->prepare("SELECT id, name,  role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
            
            // SUCCESS: User is registered and password is correct
            session_regenerate_id(true);
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['role']     = $user['role'];

            write_log("Login success: {$user['name']} ({$email})");
            header("Location: index.php");
            exit;

        } else {
            // FAILURE: Either email not found or password incorrect
            $error = "Invalid email or password.";
            write_log("Login failed: credentials mismatch for {$email}");
        }
    }
