<?php
session_start();

// Check if there's an error message and an attempted username in the session
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
$attempted_username = isset($_SESSION['attempted_username']) ? htmlspecialchars($_SESSION['attempted_username']) : '';

// Clear the attempted username after using it
unset($_SESSION['attempted_username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="wrapper">
    <form method="post" action="Userlogin.php">
        <h1>Login</h1>
        <?php if (!empty($error_message)): ?>
        <div id='error-message' class='error'><?php echo $error_message; ?></div>
        <?php unset($_SESSION['error_message']); // Clear the error message after displaying it ?>
    <?php endif; ?>
        <div class="input-box">
            <input type="text" placeholder="Username" name="username" id="username" 
                value="<?php echo $attempted_username; ?>" required>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" name="password" id="password" required>
            <i class='bx bx-low-vision eye-icon'></i>
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox">Remember Me</label>
            <a href="#">Forgot Password</a>
        </div>
        <button type="submit" class="btn">Log in</button>
    </form>
</div>
</body>
</html>
