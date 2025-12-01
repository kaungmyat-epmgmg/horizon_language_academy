<?php
session_start();

if (isset($_SESSION['show_success_modal'])) {
    echo "<script>window.addEventListener('load', function() { showModal(); });</script>";
    unset($_SESSION['show_success_modal']); // remove it after showing
}

require_once 'db.php';

$batch_id = $_GET['batch_id'];

$pdo = db();
$sql = "
SELECT
    b.batch_id,
    b.batch_no,
    b.start_date,
    b.end_date,
    c.course_name
FROM batch AS b
INNER JOIN course AS c
    ON b.course_id = c.course_id
WHERE b.batch_id = '$batch_id'
;
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$course = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_name = $_POST['fullName'];
    $student_email = $_POST['email'];
    $student_ph_no = $_POST['phoneNumber'];

    $sql = "
    INSERT INTO
        enrollment (student_name, student_email, student_ph_no, batch_id)
    VALUES (:student_name, :student_email, :student_ph_no, :batch_id)
    ;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":student_name", $student_name);
    $stmt->bindParam(":student_email", $student_email);
    $stmt->bindParam(":student_ph_no", $student_ph_no);
    $stmt->bindParam(":batch_id", $batch_id);

    if ($stmt->execute()) {
        echo "<script>showModal();</script>";
        $_SESSION['show_success_modal'] = true;
        header("Location: enroll_now.php?batch_id=$batch_id"); // redirect to prevent resubmit
        exit;
    } else {
        echo "<p>Error: " . implode(", ", $stmt->errorInfo()) . "</p>";
    }
}
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
                <div class="enroll-banner">
                    <h2 class="program-title"><?php echo $course[0]['course_name'] ?></h2>
                    <p class="program-details">
                        Batch <?php echo $course[0]['batch_no'] ?> • <?php echo $course[0]['start_date'] ?>
                    </p>
                </div>
                <!-- Input Form -->
                <form class="enroll-form" method="POST">
                    <div class="input-group">
                        <input type="text" name="fullName" placeholder="Full Name" required>
                    </div>

                    <div class="input-group">
                        <input type="text" name="phoneNumber" placeholder="Phone Number" required>
                    </div>

                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>

                    <button type="submit" class="enroll-btn">Enroll Now</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'popup.php'; ?>

    <script>
    function showModal() {
        document.getElementById('successModal').style.display = 'flex';
    }

    // Close modal on X click
    document.querySelector('.close-btn').addEventListener('click', () => {
        document.getElementById('successModal').style.display = 'none';
    });

    // Close modal if clicking outside the content
    window.addEventListener('click', (e) => {
        const modal = document.getElementById('successModal');
        if (e.target === modal) modal.style.display = 'none';
    });
    </script>
</body>
</html>
