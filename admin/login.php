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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 500px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .torch {
            width: 50px;
            height: 60px;
            position: relative;
        }

        .torch::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 40px;
            background-color: #333;
            clip-path: polygon(30% 0%, 70% 0%, 100% 100%, 0% 100%);
        }

        .torch::after {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 30px;
            background-color: #dc1f2e;
            border-radius: 50% 50% 0 0;
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        }

        .logo h1 {
            font-size: 42px;
            font-weight: 700;
            color: #000;
        }

        .tagline {
            color: #dc1f2e;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 15px 20px;
            transition: border-color 0.3s;
        }

        .input-wrapper:focus-within {
            border-color: #dc1f2e;
        }

        .input-icon {
            color: #666;
            margin-right: 15px;
            font-size: 20px;
        }

        input[type="text"],
        input[type="password"] {
            border: none;
            outline: none;
            width: 100%;
            font-size: 16px;
            color: #333;
        }

        input::placeholder {
            color: #999;
        }

        .toggle-password {
            cursor: pointer;
            color: #666;
            font-size: 20px;
        }

        .forgot-link {
            text-align: center;
            margin: 20px 0;
        }

        .forgot-link a {
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-link a:hover {
            color: #dc1f2e;
        }

        .login-btn {
            width: 100%;
            background-color: #c41e3a;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 18px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-btn:hover {
            background-color: #a01829;
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            color: #999;
            font-size: 14px;
        }

        .guest-access {
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
            color: #666;
        }

        .guest-btn {
            width: 100%;
            background-color: white;
            color: #333;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .guest-btn:hover {
            border-color: #dc1f2e;
            color: #dc1f2e;
        }

        .error-message {
            background-color: #fee;
            color: #c41e3a;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
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
