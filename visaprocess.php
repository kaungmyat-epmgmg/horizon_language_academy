<?php
require_once 'auth.php';
require_once 'db.php';
require_once 'recent_pages.php';

$isLoggedIn = requireLogin();
$role = strtolower($_SESSION['role']);

if (!$isLoggedIn && ($role !== "visasupportofficer" || $role !== "admin")) {
        header('Location: index.php');
}

$pdo = db();
$sql = "
SELECT
    c.course_id,
    c.course_name,
    GROUP_CONCAT(CONCAT(b.batch_id, ':', b.batch_no) ORDER BY b.batch_id) AS batches
FROM course AS c
LEFT JOIN batch AS b
    ON c.course_id = b.course_id
GROUP BY c.course_id, c.course_name
;
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($courses as &$course) {
    $course['batch_array'] = $course['batches']
        ? explode(',', $course['batches'])
        : [];
}

unset($course);
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
            <h2 class="page-title">Visa Process</h2>

            <!-- Language Course -->
            <?php foreach ($courses as $course): ?>
                <div class="course-dropdown">
                    <div class="course-header" onclick="toggleCourse('<?php echo $course['course_id']; ?>')">
                        <h5><?= htmlspecialchars($course['course_name']); ?></h5>
                        <span class="dropdown-icon" id="<?php echo $course['course_id'];?>-icon">▼</span>
                    </div>
                    <div class="course-content" id="<?php echo $course['course_id']; ?>">
                        <div class="course-details">
                            <?php foreach ($course['batch_array'] as $batch): ?>
                                <div class="detail-item" onclick="openBatch('<?php echo $course['course_name']?>',
                                            '<?php
                                                list($batch_id, $batch_no) = explode(':', $batch);
                                            echo $batch_id
                                            ?>',
                                            '<?php
                                                list($batch_id, $batch_no) = explode(':', $batch);
                                            echo $batch_no
                                            ?>',
                                            )">
                                    <div class="detail-left">
                                        <div class="detail-label">Batch Number</div>
                                        <div class="detail-value">
                                            <?php
                                                list($batch_id, $batch_no) = explode(':', $batch);
                                                echo $batch_no;
                                            ?>
                                        </div>
                                    </div>
                                    <span class="detail-arrow">→</span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

      <script>
        function toggleCourse(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById(id + "-icon");

            // Toggle the current course
            content.classList.toggle('open');
            icon.classList.toggle('open');
        }

         function openBatch(courseName, batchID, batchNo) {
            // Prevent event bubbling
            event.stopPropagation();

            // You can redirect to a batch detail page or show more information
            /* alert(`Opening ${courseName} - ${batchName}`); */

            // Example: Redirect to batch detail page
             window.location.href = `visastatus.php?course=${courseName}&batchID=${batchID}&batchNo=${batchNo}`;
        }
    </script>
</body>
</html>
