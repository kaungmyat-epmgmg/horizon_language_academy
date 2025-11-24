<?php
session_start();
require_once 'db.php';
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

if (!$isLoggedIn || strtolower($_SESSION['role']) != "visasupportofficer") {
        header('Location: index.php');
}

$course = $_GET['course'];
$batch = $_GET['batch'];

$pdo = db();
$sql = "
SELECT
    s.student_id,
    s.student_name,
    s.student_email,
    s.student_ph_no
FROM student AS s
WHERE batch_id = '$batch'
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

    <style>
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #333;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #e8e8e8;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .name-col {
            text-align: left;
            font-weight: 500;
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
            <h1><?php echo $course?> - <?php echo $batch ?></h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Conversion</th>
                        <th>1<sup>st</sup> Extension</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td class="id-col"><?php echo $student['student_id'] ?></td>
                            <td class="name-col"><?php echo $student['student_name'] ?></td>
                            <td class="email-col"><?php echo $student['student_email'] ?></td>
                            <td class="phone-col"><?php echo $student['student_ph_no'] ?></td>
                            <td>Completed</td>
                            <td>Completed</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
