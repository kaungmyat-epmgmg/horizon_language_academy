<?php
$isLoggedIn = $_SESSION['logged_in'];
$role = strtolower($_SESSION['role']);
?>

<div class="col-lg-2 col-md-3 col-4 main-sidebar">
            <div class="sidebar-item" data-page="index.php">
                <i class="bi bi-house"></i>
                <a href="index.php">Site Home</a>
            </div>

            <?php if ($isLoggedIn): ?>
                <div class="sidebar-item" data-page="dashboard.php">
                    <i class="bi bi-speedometer2"></i>
                    <a href="dashboard.php">Dashboard</a>
                </div>
            <?php endif; ?>

            <?php if ($isLoggedIn && $role !== "visasupportofficer"): ?>
                <div class="sidebar-item" data-page="mycourses.php">
                    <i class="bi bi-book"></i>
                    <a href="mycourses.php">My Courses</a>
                </div>
            <?php endif; ?>

            <?php if ($isLoggedIn && ($role === "visasupportofficer" || $role === "admin")): ?>
                <div class="sidebar-item" data-page="visaprocess.php">
                    <i class="bi bi-file-earmark"></i>
                    <a href="visaprocess.php">Visa Process</a>
                </div>
            <?php endif; ?>

            <?php if ($isLoggedIn && $role === "admin"): ?>
                <div class="sidebar-item" data-page="enroll_list.php">
                    <i class="bi bi-book"></i>
                    <a href="enroll_list.php">Enroll List</a>
                </div>
            <?php endif; ?>

            <div class="sidebar-item" data-page="aboutus.php">
                    <i class="bi bi-folder"></i>
                    <a href="aboutus.php">About Us</a>
            </div>
</div>

<script>
    // Simple hover effects for sidebar items
    document.addEventListener('DOMContentLoaded', function() {
        let currentPage = window.location.pathname.split("/").pop();
        const sidebarItems = document.querySelectorAll('.sidebar-item');

        if (currentPage === "visastatus.php") {
            currentPage = "visaprocess.php";
        }

        sidebarItems.forEach(item => {
            item.classList.remove("active");

            if (item.dataset.page === currentPage) {
                item.classList.add("active");
            }
        });

    });
</script>
