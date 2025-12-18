<?php
include_once  '../config/db.php';
session_start();

$db = new Database();
$conn = $db->getConnection();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === "" || $password === "") {
        $error = "All fields required";
    } else {
        $stmt = $conn->prepare(
            "SELECT id, password, role FROM users WHERE email = ?"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role']    = $user['role'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid login details";
        }
    }
}
?>
