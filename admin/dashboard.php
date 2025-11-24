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
                <h2 class="page-title">Dashboard</h2>

                <!-- Recent Activities Section -->
                <section class="recent-activities">
                    <h3>Recent Activities</h3>
                    <div class="activity-cards">
                        <div class="activity-card">
                            <h4>Eng Topic 2</h4>
                            <p>Video Recording</p>
                            <span class="card-icon">🎥</span>
                        </div>
                        <div class="activity-card">
                            <h4>Eng Topic 3 Notes</h4>
                            <p>Study Materials</p>
                            <span class="card-icon">📝</span>
                        </div>
                        <div class="activity-card">
                            <h4>Eng Topic 3 Quiz</h4>
                            <p>Assessment</p>
                            <span class="card-icon">📋</span>
                        </div>
                    </div>
                </section>

                <!-- Information Cards Row -->
                <div class="info-row">
                    <div class="info-card student-info">
                        <h3>👤 Student Information</h3>
                        <div class="info-placeholder">
                            <img src="placeholder-student.jpg" alt="Student Info" onerror="this.style.display='none'">
                            <p>Your profile details and academic progress</p>
                        </div>
                    </div>
                    <div class="info-card teacher-info">
                        <h3>👨‍🏫 Teacher Information</h3>
                        <div class="info-placeholder">
                            <img src="placeholder-teacher.jpg" alt="Teacher Info" onerror="this.style.display='none'">
                            <p>Instructor contacts and office hours</p>
                        </div>
                    </div>
                </div>

                <!-- Class Information Section -->
                <section class="class-info">
                    <h3>👥 Class Information</h3>
                    <div class="class-content">
                        <div class="class-placeholder">
                            <img src="placeholder-class.jpg" alt="Class Info" onerror="this.style.display='none'">
                            <p>Current enrollment: <strong>25 students</strong></p>
                            <p>Next session: <strong>Monday, 10:00 AM</strong></p>
                            <p>Room: <strong>Language Lab 3</strong></p>
                        </div>
                    </div>
                </section>

                <!-- Calendar Section -->
                <section class="calendar-section">
                    <h3>📅 September 2025</h3>
                    <div class="calendar">
                        <div class="calendar-nav">
                            <button class="cal-nav-btn">&lt;</button>
                            <span class="cal-month">September 2025</span>
                            <button class="cal-nav-btn">&gt;</button>
                        </div>
                        <table class="calendar-table">
                            <thead>
                                <tr>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                    <th>Sun</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="current-day">1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>9</td>
                                    <td>10</td>
                                    <td>11</td>
                                    <td>12</td>
                                    <td>13</td>
                                    <td>14</td>
                                </tr>
                                <tr>
                                    <td class="today">15</td>
                                    <td>16</td>
                                    <td>17</td>
                                    <td>18</td>
                                    <td>19</td>
                                    <td>20</td>
                                    <td>21</td>
                                </tr>
                                <tr>
                                    <td>22</td>
                                    <td>23</td>
                                    <td>24</td>
                                    <td>25</td>
                                    <td>26</td>
                                    <td>27</td>
                                    <td>28</td>
                                </tr>
                                <tr>
                                    <td>29</td>
                                    <td>30</td>
                                    <td class="other-month">1</td>
                                    <td class="other-month">2</td>
                                    <td class="other-month">3</td>
                                    <td class="other-month">4</td>
                                    <td class="other-month">5</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
</html>
