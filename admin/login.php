<?php
session_start();
require_once "db.php";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';

    try {
        $pdo = db();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_email = :email");
        $stmt->execute(['email' => $email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData && $pass === $userData['password']) {
            $_SESSION['user_id'] = $userData['user_id'];
            $_SESSION['email'] = $userData['user_email'];
            $_SESSION['logged_in'] = true;
            $_SESSION['user_name'] = $userData['user_name'];
            $_SESSION['role'] = $userData['role'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Invalid email or password";
        }
    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liberty Global - Login</title>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo">
                <div class="torch"></div>
                <h1>Horizon</h1>
            </div>
            <div class="tagline">Language Academy</div>
        </div>

        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <div class="input-wrapper">
                    <span class="input-icon">👤</span>
                    <input type="text" name="email" placeholder="email" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-wrapper">
                    <span class="input-icon">🔑</span>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <span class="toggle-password" onclick="togglePassword()">👁</span>
                </div>
            </div>

            <div class="forgot-link">
                <a href="forgot-password.php">Forgotten your username or password?</a>
            </div>

            <button type="submit" class="login-btn">Log in</button>
        </form>

        <div class="divider">———</div>

        <div class="guest-access">
            Some courses may allow guest access
        </div>

        <button type="button" class="guest-btn" onclick="window.location.href='guest.php'">
            Access as a guest
        </button>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
        }
    </script>
</body>
</html>
