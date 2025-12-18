<?php
include_once  '../config/db.php';
session_start();

$db = new Database();
$conn = $db->getConnection();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    

    if ($name === "" || $email === "" || $password === "" || $confirm_password === "" ) {
        $error = "All fields required";
    } else {
        // check email exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email already registered";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
            );
            $stmt->bind_param("sss", $name, $email, $hash);
            $stmt->execute();

            $_SESSION['user_id'] = $stmt->insert_id;
            header("Location: index.php");
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Signup</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="login-box">
    <h1>
        <img src="assets/logo/Logo.png" style="width:400px; height: 400px; vertical-align:middle;">
    </h1>
    <h2>Let's register!!!</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="name" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Login</button>
    </form>

    <div class="links">
        Already have an account?
        <a href="index.php">Login In</a>
    </div>
</div>

</body>
</html>
