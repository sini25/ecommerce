<?php

include_once __DIR__ . '/../config/db.php';


$db = new Database();
$conn = $db->getConnection();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="login-box">
    <h1>
        <img src="assets/logo/Logo.png" style="width:400px; height: 400px; vertical-align:middle;">
    </h1>
    <h2>Welcome Back</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="dashboard.php" >
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <div class="links">
        Don’t have an account?
        <a href="signup.php">Sign up</a>
    </div>
</div>

</body>
</html>
