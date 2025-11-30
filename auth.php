<?php
function requireLogin() {
    session_start();
    $isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    if (!$isLoggedIn) {
        header('Location: login.php');
        exit();
    }
    return $isLoggedIn;
}
?>