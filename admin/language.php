<?php
require_once 'auth.php';
require_once 'db.php';

$isLoggedIn = requireLogin();

if (!$isLoggedIn) {
    header('Location: login.php');
}

$user_id = $_SESSION['user_id'];
$course_id = $_GET['course_id'];

$pdo = db();
$stmt = $pdo->prepare("
SELECT
    c.course_name,
    t.topic_id,
    t.topic_name
FROM topic AS t
INNER JOIN course AS c
    ON t.course_id = c.course_id
WHERE t.course_id = '$course_id'
");

$stmt->execute();
$topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <style>
        .page-title {
            font-size: 42px;
            font-weight: 600;
            color: #333;
            margin-bottom: 40px;
        }

        .courses-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .topic-dropdown {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        .topic-dropdown:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .topic-header {
            padding: 30px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            transition: background-color 0.2s;
        }

        .topic-header:hover {
            background-color: #f8f9fa;
        }

        .topic-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .dropdown-icon {
            font-size: 20px;
            color: #666;
            transition: transform 0.3s ease;
        }

        .dropdown-icon.open {
            transform: rotate(180deg);
        }

        .topic-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
            background-color: #f8f9fa;
        }

        .topic-content.open {
            max-height: 800px;
        }

        .topic-details {
            padding: 20px 30px;
        }

        .detail-item {
            background-color: white;
            padding: 20px 25px;
            margin-bottom: 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            border: 2px solid transparent;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .detail-item:hover {
            background-color: #e3f2fd;
            border-color: #0066cc;
            transform: translateX(5px);
        }

        .detail-item:last-child {
            margin-bottom: 0;
        }

        .detail-left {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .detail-label {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 20px;
            color: #333;
            font-weight: 600;
        }

        .detail-arrow {
            font-size: 18px;
            color: #0066cc;
        }

        .batch-divider {
            height: 1px;
            background-color: #dee2e6;
            margin: 20px 30px;
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <?php include 'header.php'; ?>

    <div class="row g-0">
        <!-- Left Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Content Area -->
        <div class="col-lg-10 col-md-9 col-8">
            <!-- Dashboard Content -->
            <div class="dashboard-content">
            <h2 class="page-title"><?php echo $topics[0]['course_name']?></h2>

                <!-- Topics  -->
                <?php foreach ($topics as $topic): ?>
                    <div class="topic-dropdown">
                        <div class="topic-header" onclick="toggleTopic('<?php echo $topic['topic_id']; ?>')">
                        <h2 class="topic-title"><?php echo $topic["topic_name"] ?></h2>
                        <span class="dropdown-icon" id="<?php echo $topic['topic_id'];?>-icon">▼</span>
                        </div>
                        <div class="topic-content" id="<?php echo $topic['topic_id']; ?>">
                            <div class="topic-details">
                                <div class="detail-item">
                                    <div class="detail-left">
                                        <div class="detail-label">Lecture Video</div>
                                    </div>
                                    <span class="detail-arrow">→</span>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-left">
                                        <div class="detail-label">Notes</div>
                                    </div>
                                    <span class="detail-arrow">→</span>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-left">
                                        <div class="detail-label">Quizzes</div>
                                    </div>
                                    <span class="detail-arrow">→</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
    </div>

      <script>
        function toggleTopic(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById(id + "-icon");

            // Toggle the current course
            content.classList.toggle('open');
            icon.classList.toggle('open');
        }
    </script>
</body>
</html>
