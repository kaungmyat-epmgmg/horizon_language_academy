<?php
require_once 'db.php';

session_start();
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

$pdo = db();
$sql = "
SELECT
    b.batch_id,
    b.batch_no,
    b.start_date,
    b.course_id,
    c.course_name
FROM batch AS b
INNER JOIN course AS c
    ON b.course_id = c.course_id
WHERE b.start_date > CURDATE()
;
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$upcoming_classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon Language Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
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
            <!-- Welcome Banner Section -->
            <div class="welcome-banner" style="background-image: url('static/HLA_Reception.png');">
            </div>

            <!-- Upcoming Classes Section -->
            <div class="upcoming-classes-section">
                <h2 class="section-heading">Upcoming Classes</h2>
                <div class="row">
                    <?php foreach ($upcoming_classes as $c): ?>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <a href="enroll_now.php?batch_id=<?php echo $c['batch_id']; ?>">
                                <div class="batch-card">
                                    <h5 class="batch-title"><?php echo $c['course_name'];?></h5>
                                    <p class="batch-info">Batch-<?php echo $c['batch_no'];?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
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
                            <img src="static/Thai_Teacher_1.jpg" alt="">
                        </div>
                        <p class="lecturer-name">Teacher Chatri</p>
                    </div>
                    <div class="lecturer-card">
                        <div class="lecturer-avatar">
                            <img src="static/Thai_Teacher_2.jpg" alt="">
                        </div>
                        <p class="lecturer-name">Teacher Chaiya</p>
                    </div>
                    <div class="lecturer-card">
                        <div class="lecturer-avatar">
                            <img src="static/English_Teacher.jpg" alt="">
                        </div>
                        <p class="lecturer-name">Teacher Daniel</p>
                    </div>
                    <div class="lecturer-card">
                        <div class="lecturer-avatar">
                            <img src="static/Japanese_Teacher_2.jpg" alt="">
                        </div>
                        <p class="lecturer-name">Teacher Haru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
