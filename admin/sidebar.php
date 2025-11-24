<div class="col-lg-2 col-md-3 col-4 main-sidebar">
            <div class="sidebar-item active">
                <i class="bi bi-house"></i>
                <a href="index.php">Site Home</a>
            </div>
            
            <?php if ($isLoggedIn): ?>
                <div class="sidebar-item">
                    <i class="bi bi-speedometer2"></i>
                    <a href="dashboard.php">Dashboard</a>
                    <!-- <span class="d-md-inline d-none">Dashboard</span> -->
                </div>
                
                <div class="sidebar-item">
                    <i class="bi bi-book"></i>
                    <a href="mycourses.php">My Courses</a>
                </div>
                
                <div class="sidebar-item">
                    <i class="bi bi-file-earmark"></i>
                    <a href="visaprocess.php">Visa Process</a>
                </div>
            <?php endif; ?>
            
            <div class="sidebar-item">
                    <i class="bi bi-folder"></i>
                    <a href="aboutus.php">About Us</a>
            </div>
</div>