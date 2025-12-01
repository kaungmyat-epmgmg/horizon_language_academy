<?php
$current_page = basename($_SERVER['PHP_SELF']);  // e.g. "dashboard.php"

// If array not created yet
if (!isset($_SESSION['recent_pages'])) {
    $_SESSION['recent_pages'] = [];
}

// Avoid duplicates when refreshing page
if (end($_SESSION['recent_pages']) !== $current_page) {
    // Add page to history
    $_SESSION['recent_pages'][] = $current_page;

    // Keep only last 3
    if (count($_SESSION['recent_pages']) > 3) {
        array_shift($_SESSION['recent_pages']);
    }
}
?>
