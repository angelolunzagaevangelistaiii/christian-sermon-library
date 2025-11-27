<?php
session_start();
require_once '../src/db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $mysqli->query("SELECT * FROM users WHERE email='$email'");
    $user = $res->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Incorrect email or password.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="style.css" rel="stylesheet">
</head>
<body>
<div class="container">
<h2>Login</h2>
<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button>Login</button>
</form>
<?php if($error) echo "<p class='error'>$error</p>"; ?>
<p>No account? <a href="register.php">Register here</a></p>
</div>
</body>
</html>
