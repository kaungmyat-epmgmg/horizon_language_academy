<?php
require_once 'auth.php';
require_once 'recent_pages.php';
$isLoggedIn = requireLogin();

$arr =json_encode($_SESSION['recent_pages']);

echo "<script> console.log('$arr'); </script>";
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
                    <h2 class="page-title">Dashboard</h2>

                    <!-- Recent Activities Section -->
                    <section class="recent-activities">
                        <h3>Recent Activities</h3>
                        <div class="activity-cards">
                            <?php foreach (array_reverse($_SESSION['recent_pages']) as $page): ?>
                                <div class="activity-card">
                                    <a href="<?php echo $page; ?>">
                                        <h4><?php echo ucfirst(str_replace('.php', '', $page)); ?></h4>
                                        <p>Recently Visited</p>
                                        <span class="card-icon">🕒</span>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>

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
                        <h3 id="calendar-title">📅</h3>
                        <div class="calendar">
                            <div class="calendar-nav">
                                <button class="cal-nav-btn" onclick="changeMonth(-1)">&lt;</button>
                                <span class="cal-month" id="cal-month"></span>
                                <button class="cal-nav-btn" onclick="changeMonth(1)">&gt;</button>
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
                                <tbody id="calendar-body">
                                    <!-- Filled by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </body>
    <script>
    let currentDate = new Date();

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        // Update titles
        document.getElementById("cal-month").textContent =
            currentDate.toLocaleString("en-US", { month: "long", year: "numeric" });

        document.getElementById("calendar-title").textContent =
            "📅 " + currentDate.toLocaleString("en-US", { month: "long", year: "numeric" });

        const firstDay = new Date(year, month, 1).getDay(); // 0 = Sun
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Convert Sunday=0 → Make Monday index=0
        const startingDay = (firstDay === 0 ? 6 : firstDay - 1);

        const tbody = document.getElementById("calendar-body");
        tbody.innerHTML = ""; // Clear previous calendar

        let date = 1;
        let row;

        // Generate weeks
        for (let i = 0; i < 6; i++) {
            row = document.createElement("tr");

            for (let j = 0; j < 7; j++) {
                const cell = document.createElement("td");

                if (i === 0 && j < startingDay) {
                    cell.classList.add("other-month");
                    cell.textContent = "";
                } else if (date > daysInMonth) {
                    cell.classList.add("other-month");
                    cell.textContent = "";
                } else {
                    cell.textContent = date;

                    // Highlight today
                    const today = new Date();
                    if (
                        date === today.getDate() &&
                        month === today.getMonth() &&
                        year === today.getFullYear()
                    ) {
                        cell.classList.add("today");
                    }

                    date++;
                }

                row.appendChild(cell);
            }

            tbody.appendChild(row);
        }
    }

    function changeMonth(direction) {
        currentDate.setMonth(currentDate.getMonth() + direction);
        renderCalendar();
    }

    renderCalendar();
    </script>
</html>
