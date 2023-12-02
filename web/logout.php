<?php
// Start the session (if not already started)
session_start();

// Unset all session variables
$_SESSION = array();

// Delete the session cookie by setting its expiration time to the past
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Destroy the session
session_destroy();

// Delete all cookies by looping through them
if (!empty($_COOKIE)) {
    foreach ($_COOKIE as $cookie_name => $cookie_value) {
        // Set the expiration time in the past to delete the cookie
        setcookie($cookie_name, '', time() - 3600, '/');
    }
}

// Redirect to dangnhap.php
header("Location: dangnhap.php");
exit();
?>