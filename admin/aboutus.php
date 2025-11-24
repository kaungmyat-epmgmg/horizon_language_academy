<?php
session_start();
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon Language Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1ERo0BZlK" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
                .about-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
        }

        .about-container h1 {
            text-align: center;
            color: #4a4a9e;
            font-size: 2.5em;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #ddd;
        }

        .about-container h2 {
            color: #4a4a9e;
            font-size: 1.8em;
            margin: 20px 0;
        }

        .about-text {
            line-height: 1.8;
            color: #666;
            margin-bottom: 40px;
        }

        .about-text p {
            margin-bottom: 15px;
        }

        .founder-section {
            text-align: center;
            margin: 40px 0;
            padding: 30px;
            background-color: #f9f9f9;
            border: 2px solid #ddd;
        }

        .founder-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #e0e0e0;
            margin: 0 auto 20px;
            border: 3px solid #4a4a9e;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .founder-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .founder-name {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .founder-title {
            color: #666;
            font-size: 1.1em;
            border-bottom: 2px solid #4a4a9e;
            display: inline-block;
            padding-bottom: 5px;
        }

        .pictures-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 40px 0;
        }

        .picture-box {
            border: 2px solid #333;
            padding: 20px;
            text-align: center;
            background-color: #fafafa;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .picture-box img {
            max-width: 100%;
            height: auto;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }

        .contact-box {
            border: 2px solid #333;
            padding: 30px 20px;
            text-align: center;
            background-color: #f9f9f9;
        }

        .contact-icon {
            margin-bottom: 15px;
        }

        .contact-icon img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .contact-label {
            color: #333;
            font-size: 1.1em;
            font-weight: 500;
        }

        .social-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0 30px;
        }

        .social-box {
            border: 2px solid #333;
            padding: 40px 20px;
            text-align: center;
            background-color: #fafafa;
            transition: background-color 0.3s ease;
        }

        .social-box:hover {
            background-color: #e8e8e8;
        }

        .social-box a {
            color: #333;
            font-size: 1.2em;
            font-weight: bold;
            text-decoration: none;
        }

        .email-footer {
            text-align: center;
            padding: 20px;
            background-color: #f0f0f0;
            border: 2px solid #333;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .email-icon {
            font-size: 2em;
        }

        .email-footer a {
            color: #333;
            font-size: 1.2em;
            text-decoration: none;
        }

        .email-footer a:hover {
            color: #4a4a9e;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .about-container {
                padding: 20px;
            }

            .about-container h1 {
                font-size: 2em;
            }

            .about-container h2 {
                font-size: 1.5em;
            }

            .pictures-grid,
            .contact-grid,
            .social-grid {
                grid-template-columns: 1fr;
            }

            .email-footer {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <?php
        include "../connect.php";
        if(isset($_POST["btnPinsert"])){
            $name= $_POST["pname"];
            $qstr= "insert into programme (pname) values ('$name')";
            $con->query($qstr);
        }
    ?>

    <!-- Top Header -->
    <?php include 'header.php'; ?>

    <div class="row g-0">
        <!-- Left Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Content Area -->
                <div class="about-container">
            <h1>About Us</h1>

            <h2>Horizon Language Academy</h2>
            <div class="about-text">
                <p>Welcome to Horizon Language Academy, where we are dedicated to helping students expand their linguistic horizons and cultural understanding. Our academy provides comprehensive language education tailored to meet the needs of learners at all levels.</p>
            </div>

            <div class="founder-section">
                <div class="founder-avatar">
                    <img src="path/to/founder-image.jpg" alt="Frank Kaung">
                </div>
                <div class="founder-name">Frank Kaung</div>
                <div class="founder-title">Founder</div>
            </div>

            <div class="pictures-grid">
                <div class="picture-box">
                    <img src="path/to/picture-1.jpg" alt="Picture 1">
                </div>
                <div class="picture-box">
                    <img src="path/to/picture-2.jpg" alt="Picture 2">
                </div>
            </div>

            <h2>Contact Us</h2>

            <div class="contact-grid">
                <div class="contact-box">
                    <div class="contact-icon">
                        <img src="path/to/facebook-icon.jpg" alt="Facebook">
                    </div>
                    <div class="contact-label">Facebook</div>
                </div>
                <div class="contact-box">
                    <div class="contact-icon">
                        <img src="path/to/line-icon.jpg" alt="Line">
                    </div>
                    <div class="contact-label">Line</div>
                </div>
            </div>

            <div class="social-grid">
                <div class="social-box">
                    <a href="https://wa.me/your-number">WhatsApp</a>
                </div>
                <div class="social-box">
                    <a href="weixin://your-wechat-id">WeChat</a>
                </div>
            </div>

            <div class="email-footer">
                <span class="email-icon">✉️</span>
                <a href="mailto:horizonlanguage@gmail.com">horizonlanguage@gmail.com</a>
            </div>
        </div>
    </div>
</body>
</html>
