<?php
session_start();
require_once 'db.php';
require_once 'recent_pages.php';
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$role = strtolower($_SESSION['role']);

if (!$isLoggedIn && ($role !== "visasupportofficer" || $role !== "admin")) {
        header('Location: index.php');
}

$course = $_GET['course'];
$batch_id = $_GET['batchID'];
$batch_no = $_GET['batchNo'];

$pdo = db();
$sql = "
SELECT
    s.student_id,
    u.user_name AS student_name,
    u.user_email AS student_email,
    u.user_ph_no AS student_ph_no,
    v.visa_application_type,
    v.visa_status
FROM student AS s
INNER JOIN users AS u
    ON s.student_id = u.user_id
INNER JOIN visa_application AS v
    ON s.student_id = v.student_id
WHERE s.batch_id = '$batch_id'
;
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <h1><?php echo $course?> (Batch - <?php echo $batch_no ?>)</h1>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Application Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): ?>
                                    <tr>
                                        <td class="id-col"><?php echo $student['student_id'] ?></td>
                                        <td class="name-col"><?php echo $student['student_name'] ?></td>
                                        <td class="email-col"><?php echo $student['student_email'] ?></td>
                                        <td class="phone-col"><?php echo $student['student_ph_no'] ?></td>
                                        <td class="application-col"><?php echo $student['visa_application_type'] ?></td>
                                        <td class="status-col"><?php echo $student['visa_status'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
