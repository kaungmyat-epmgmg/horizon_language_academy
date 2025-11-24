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
</head>
<body>
    <!-- Top Header -->
    <?php include 'header.php'; ?>

    <div class="row g-0">
        <!-- Left Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Content Area -->
        <div class="col-lg-10 col-md-9 col-8">
            <!-- Welcome Banner Section -->
            <div class="welcome-banner">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="welcome-title">Welcome to<br>Horizon Language Academy</h1>
                        <div class="advertisement-area">
                            <p class="ad-text">Advertisement Pictures...</p>
                            <div class="wave-decoration">
                                <svg viewBox="0 0 200 40" class="wave-svg">
                                    <path d="M0,20 Q50,0 100,20 T200,20" stroke="white" stroke-width="2" fill="none" opacity="0.5"/>
                                    <path d="M0,25 Q50,5 100,25 T200,25" stroke="white" stroke-width="1.5" fill="none" opacity="0.3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                        <div class="mountain-decoration">
                            <svg viewBox="0 0 150 100" class="mountain-svg">
                                <path d="M20,80 L50,30 L80,50 L120,20 L150,80 Z" fill="rgba(255,255,255,0.2)" stroke="rgba(255,255,255,0.4)" stroke-width="2"/>
                                <path d="M10,85 L40,40 L70,60 L100,35 L140,85 Z" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Classes Section -->
            <div class="upcoming-classes-section">
                <h2 class="section-heading">Upcoming Classes</h2>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="batch-card">
                            <h5 class="batch-title">Eng</h5>
                            <p class="batch-info">Batch-5</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="batch-card">
                            <h5 class="batch-title">Thai</h5>
                            <p class="batch-info">Batch-7</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="batch-card">
                            <h5 class="batch-title">Japan</h5>
                            <p class="batch-info">Batch-2</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Online Suggestion Box -->
            <div class="suggestion-box-section">
                <div class="suggestion-box">
                    <h3 class="suggestion-title">Online Suggestion Box</h3>
                    <form action="index.php" method="post" class="suggestion-form">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label for="pname" class="form-label">Programme Name</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="pname" name="pname" required class="form-control"
                                       placeholder="Enter programme name">
                            </div>
                            <div class="col-md-3">
                                <input type="submit" value="Insert Programme"
                                       class="btn btn-primary w-100" name="btnPinsert">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Course Categories Section -->
            <div class="course-categories-section">
                <h2 class="section-heading">Course Categories</h2>
                <div class="categories-grid">
                    <div class="category-item">
                        <span class="category-text">English Language Proficiency</span>
                    </div>
                    <div class="category-item">
                        <span class="category-text">Thai Language Proficiency</span>
                    </div>
                    <div class="category-item">
                        <span class="category-text">Japanese Language Proficiency</span>
                    </div>
                </div>
            </div>

            <!-- Lecturers Section -->
            <div class="lecturers-section">
                <h2 class="section-heading">Lecturers</h2>
                <div class="lecturers-grid">
                    <div class="lecturer-card">
                        <div class="lecturer-avatar">
                            <i class="bi bi-person"></i>
                        </div>
                        <p class="lecturer-name">Lecturer 1</p>
                    </div>
                    <div class="lecturer-card">
                        <div class="lecturer-avatar">
                            <i class="bi bi-person"></i>
                        </div>
                        <p class="lecturer-name">Lecturer 2</p>
                    </div>
                    <div class="lecturer-card">
                        <div class="lecturer-avatar">
                            <i class="bi bi-person"></i>
                        </div>
                        <p class="lecturer-name">Lecturer 3</p>
                    </div>
                    <div class="lecturer-card">
                        <div class="lecturer-avatar">
                            <i class="bi bi-person"></i>
                        </div>
                        <p class="lecturer-name">Lecturer 4</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple hover effects for sidebar items
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarItems = document.querySelectorAll('.sidebar-item');

            sidebarItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Remove active class from all items
                    sidebarItems.forEach(i => i.classList.remove('active'));
                    // Add active class to clicked item
                    this.classList.add('active');
                });
            });

            // Add wave animation
            const waves = document.querySelectorAll('.wave-svg path');
            waves.forEach((wave, index) => {
                wave.style.animation = `wave 3s ease-in-out infinite ${index * 0.5}s`;
            });
        });
    </script>
</body>
</html>
