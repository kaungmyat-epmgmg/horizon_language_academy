<?php
require_once 'auth.php';
$isLoggedIn = requireLogin();
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

        .course-dropdown {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        .course-dropdown:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .course-header {
            padding: 30px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            transition: background-color 0.2s;
        }

        .course-header:hover {
            background-color: #f8f9fa;
        }

        .course-title {
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

        .course-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
            background-color: #f8f9fa;
        }

        .course-content.open {
            max-height: 800px;
        }

        .course-details {
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
        <div class="col-lg-10 col-md-9 col-8">
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <h2 class="page-title">Visa Process</h2>

                 <!-- Recent Activities Section -->
                        <!-- English Language Course -->
        <div class="course-dropdown">
            <div class="course-header" onclick="toggleCourse('english-course')">
                <h2 class="course-title">English Language Course</h2>
                <span class="dropdown-icon" id="english-icon">▼</span>
            </div>
            <div class="course-content" id="english-course">
                <div class="course-details">
                    <div class="detail-item" onclick="openBatch('English', 'Batch-1')">
                        <div class="detail-left">
                            <div class="detail-label">Batch Number</div>
                            <div class="detail-value">Batch-1</div>
                        </div>
                        <span class="detail-arrow">→</span>
                    </div>
                    <div class="detail-item" onclick="openBatch('English', 'Batch-2')">
                        <div class="detail-left">
                            <div class="detail-label">Batch Number</div>
                            <div class="detail-value">Batch-2</div>
                        </div>
                        <span class="detail-arrow">→</span>
                    </div>
                    <div class="detail-item" onclick="openBatch('English', 'Batch-3')">
                        <div class="detail-left">
                            <div class="detail-label">Batch Number</div>
                            <div class="detail-value">Batch-3</div>
                        </div>
                        <span class="detail-arrow">→</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Japanese Language Course -->
        <div class="course-dropdown">
            <div class="course-header" onclick="toggleCourse('japanese-course')">
                <h2 class="course-title">Japanese Language Course</h2>
                <span class="dropdown-icon" id="japanese-icon">▼</span>
            </div>
            <div class="course-content" id="japanese-course">
                <div class="course-details">
                    <div class="detail-item" onclick="openBatch('Japanese', 'Batch-1')">
                        <div class="detail-left">
                            <div class="detail-label">Batch Number</div>
                            <div class="detail-value">Batch-1</div>
                        </div>
                        <span class="detail-arrow">→</span>
                    </div>
                    <div class="detail-item" onclick="openBatch('Japanese', 'Batch-2')">
                        <div class="detail-left">
                            <div class="detail-label">Batch Number</div>
                            <div class="detail-value">Batch-2</div>
                        </div>
                        <span class="detail-arrow">→</span>
                    </div>
                    <div class="detail-item" onclick="openBatch('Japanese', 'Batch-3')">
                        <div class="detail-left">
                            <div class="detail-label">Batch Number</div>
                            <div class="detail-value">Batch-3</div>
                        </div>
                        <span class="detail-arrow">→</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thai Language Course -->
        <div class="course-dropdown">
            <div class="course-header" onclick="toggleCourse('thai-course')">
                <h2 class="course-title">Thai Language Course</h2>
                <span class="dropdown-icon" id="thai-icon">▼</span>
            </div>
            <div class="course-content" id="thai-course">
                <div class="course-details">
                    <div class="detail-item" onclick="openBatch('Thai', 'Batch-1')">
                        <div class="detail-left">
                            <div class="detail-label">Batch Number</div>
                            <div class="detail-value">Batch-1</div>
                        </div>
                        <span class="detail-arrow">→</span>
                    </div>
                    <div class="detail-item" onclick="openBatch('Thai', 'Batch-2')">
                        <div class="detail-left">
                            <div class="detail-label">Batch Number</div>
                            <div class="detail-value">Batch-2</div>
                        </div>
                        <span class="detail-arrow">→</span>
                    </div>
                    <div class="detail-item" onclick="openBatch('Thai', 'Batch-3')">
                        <div class="detail-left">
                            <div class="detail-label">Batch Number</div>
                            <div class="detail-value">Batch-3</div>
                        </div>
                        <span class="detail-arrow">→</span>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

      <script>
        function toggleCourse(courseId) {
            const content = document.getElementById(courseId);
            const iconId = courseId.replace('-course', '-icon');
            const icon = document.getElementById(iconId);

            // Toggle the current course
            content.classList.toggle('open');
            icon.classList.toggle('open');
        }

         function openBatch(courseName, batchName) {
            // Prevent event bubbling
            event.stopPropagation();

            // You can redirect to a batch detail page or show more information
            alert(`Opening ${courseName} - ${batchName}`);

            // Example: Redirect to batch detail page
            // window.location.href = `batch-detail.php?course=${courseName}&batch=${batchName}`;
        }
    </script>
</body>
</html>
