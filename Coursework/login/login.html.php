<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
    <div class="wrapper">
        <form action="login.php" method="POST">
            <h1>Sign up</h1>
            <?php if (isset($_SESSION['login_error'])): ?>
                <div class="error-message">
                    <?= htmlspecialchars($_SESSION['login_error']) ?>
                    <?php unset($_SESSION['login_error']); ?>
                </div>
            <?php endif; ?>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bx-user' ></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="register.html.php">Register</a></p>
        </form>
</div>

<body>
    
</body>
</html>