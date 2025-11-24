<div class="top-header">
    <div class="d-flex justify-content-between align-items-center">
        <div class="logo-section">
            <div class="logo-box">H</div>
            <span class="brand-title">Horizon Language Academy</span>
        </div>
        <?php if ($_SESSION['logged_in']): ?>
            <div class="header-icons">
                <p class="icon-btn"><?php echo $_SESSION['user_name']?></p>
                <p class="icon-btn"><?php echo $_SESSION['role']?></p>
                <form method="post" action="logout.php" style="display: inline;">
                    <button type="submit" class="icon-btn">Logout</button>
                </form>
            </div>
        <?php else: ?>
            <div class="sidebar-item">
                <i class="bi bi-file-earmark"></i>
                <a href="login.php">Login</a>
            </div>
        <?php endif; ?>
    </div>
</div>
