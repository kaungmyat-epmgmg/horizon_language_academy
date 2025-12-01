<?php
require_once 'auth.php';
require_once 'db.php';

$isLoggedIn = requireLogin();

require_once 'recent_pages.php';
$role = strtolower($_SESSION['role']);

if (!$isLoggedIn) {
    header('Location: login.php');
}

if (!$isLoggedIn || $role === "visasupportofficer") {
    header('Location: index.php');
}

$user_id = $_SESSION['user_id'];
$role = strtolower($_SESSION['role']);

$pdo = db();

if ($role === "student") {
    $sql = "
    SELECT
        c.course_id,
        c.course_name,
        t.teacher_id,
        u.user_name AS teacher_name,
        b.batch_no
    FROM student AS s
    INNER JOIN batch AS b
        ON s.batch_id = b.batch_no
    INNER JOIN course AS c
        ON b.course_id = c.course_id
    INNER JOIN teacher AS t
        ON c.course_id = t.course_id
    INNER JOIN users AS u
        ON t.teacher_id = u.user_id
    WHERE s.student_id = '$user_id';
    ";
}
else if ($role === "admin") {
    $sql = "
    SELECT
        c.course_id,
        c.course_name,
        t.teacher_id,
        u.user_name AS teacher_name
    FROM admin AS a
    INNER JOIN admin_course AS ac
        ON a.admin_id = ac.admin_id
    INNER JOIN course AS c
        ON ac.course_id = c.course_id
    INNER JOIN teacher AS t
        ON c.course_id = t.course_id
    INNER JOIN users AS u
        ON t.teacher_id = u.user_id
    WHERE a.admin_id = '$user_id';
    ";
}

$stmt = $pdo->prepare($sql);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <!-- Dashboard Content -->
            <div class="dashboard-content about-container">
                <h2 class="page-title">My Courses</h2>

                 <!-- Courses Section -->
                <section class="courses">
                    <div class="activity-cards">
                        <?php foreach ($courses as $course): ?>
                          <a href="language.php?course_id=<?= $course['course_id']; ?>" class="activity-card">
                            <h4><?= htmlspecialchars($course['course_name']); ?></h4>
                            <p><?= htmlspecialchars($course['batch_no']); ?></p>
                            <p><?= htmlspecialchars($course['teacher_name']); ?></p>
                          </a>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
</html>
