<?php
session_start();
require_once '../src/db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($mysqli->query("INSERT INTO users(name,email,password) VALUES('$name','$email','$password')")) {
        $_SESSION['user_id'] = $mysqli->insert_id;
        $_SESSION['name'] = $name;
        header("Location: index.php");
        exit;
    } else {
        $error = "Email already exists.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="style.css" rel="stylesheet">
</head>
<body>
<div class="container">
<h2>Create Account</h2>
<form method="POST">
<input type="text" name="name" placeholder="Full Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button>Register</button>
</form>
<?php if($error) echo "<p class='error'>$error</p>"; ?>
<p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
