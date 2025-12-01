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
    <link rel="stylesheet" href="static/style.css">

</head>
    <body>
        <!-- Top Header -->
        <?php include 'header.php'; ?>

        <div class="row g-0">
            <!-- Left Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Main Content Area -->
            <div class="col-lg-10 col-md-9 col-8 main-content">
                <div class="about-container">
                <h1>About Us</h1>

                <h2>“Expanding Horizons Through Language.”</h2>

                <h3>Mission Statement</h3>
                <div class="about-text">
                    <p>To provide high-quality, student-focused language education that builds confidence,
                        practical communication skills, and cross-cultural understanding for learners at all levels.</p>
                </div>

                <h3>Vision Statement</h3>
                <div class="about-text">
                    <p> To be a leading international language academy that empowers students to grow globally, connect across
                        cultures, and unlock new opportunities through transformative learning.</p>
                </div>

                <div class="founders-row">
                    <div class="founder-section">
                        <div class="founder-avatar">
                            <img src="static/FrankKaung.png" alt="Frank Kaung">
                        </div>
                        <div class="founder-name">Frank Kaung</div>
                        <div class="founder-title">Founder</div>
                    </div>

                    <div class="founder-section">
                        <div class="founder-avatar">
                            <img src="static/FrankKaung.png" alt="Founder 2">
                        </div>
                        <div class="founder-name">Founder 2</div>
                        <div class="founder-title">Co-Founder</div>
                    </div>

                    <div class="founder-section">
                        <div class="founder-avatar">
                            <img src="static/FrankKaung.png" alt="Founder 3">
                        </div>
                        <div class="founder-name">Founder 3</div>
                        <div class="founder-title">Co-Founder</div>
                    </div>
                </div>

                <div class="pictures-grid">
                    <div class="picture-box">
                        <img src="static/classroom.jpg" alt="Picture 1">
                    </div>
                    <div class="picture-box">
                        <img src="static/classroom2.jpg" alt="Picture 2">
                    </div>
                </div>

                <h2>Contact Us</h2>

                <div class="contact-grid">
                    <div class="contact-box">
                        <div class="contact-icon">
                            <img src="static/facebook_logo.jpg" alt="Facebook">
                        </div>
                        <div class="contact-label">Facebook</div>
                    </div>
                    <div class="contact-box">
                        <div class="contact-icon">
                            <img src="static/line_logo.png" alt="Line">
                        </div>
                        <div class="contact-label">Line</div>
                    </div>
                    <div class="contact-box">
                        <div class="contact-icon">
                            <img src="static/whatsapp_logo.jpg" alt="WhatsApp">
                        </div>
                        <div class="contact-label">WhatsApp</div>
                    </div>
                    <div class="contact-box">
                        <div class="contact-icon">
                            <img src="static/wechat_logo.png" alt="WeChat">
                        </div>
                        <div class="contact-label">WeChat</div>
                    </div>
                </div>
                <div class="email-footer">
                    <span class="email-icon">✉️</span>
                    <a href="mailto:horizonlanguage@gmail.com">horizonlanguage@gmail.com</a>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
