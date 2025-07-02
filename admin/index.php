<?php
define('admin', true);
// Determine the base URL
$base_url = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] === 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ? 'https' : 'http';
$base_url .= '://' . rtrim($_SERVER['HTTP_HOST'], '/');
$base_url .= $_SERVER['SERVER_PORT'] == 80 || $_SERVER['SERVER_PORT'] == 443 || strpos($_SERVER['HTTP_HOST'], ':') !== false ? '' : ':' . $_SERVER['SERVER_PORT'];
$base_url .= '/' . ltrim(substr(str_replace('\\', '/', realpath(__DIR__)), strlen($_SERVER['DOCUMENT_ROOT'])), '/');
define('base_url', rtrim($base_url, '/') . '/');
session_start();
// Include the configuration file, this contains settings you can change.
include '../config.php';
// Include functions and connect to the database using PDO MySQL
include '../functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// If the user is not logged-in redirect them to the login page
if (!isset($_SESSION['account_loggedin'])) {
    header('Location: ' . url('../index.php?page=myaccount'));
    exit;
}
// If the user is not admin redirect them back to the shopping cart home page
$stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
$stmt->execute([ $_SESSION['account_id'] ]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$account || $account['role'] != 'Admin') {
    header('Location: ' . url('../index.php'));
    exit;
}
// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'dashboard';
if (isset($_GET['page']) && $_GET['page'] == 'logout') {
    session_destroy();
    header('Location: ' . url('../index.php'));
    exit;
}
// Output error variable
$error = '';
// Roles list
$roles_list = ['Admin', 'Workshop' ,'Member'];
// Icons for the table headers
$table_icons = [
    'asc' => '<svg width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M350 177.5c3.8-8.8 2-19-4.6-26l-136-144C204.9 2.7 198.6 0 192 0s-12.9 2.7-17.4 7.5l-136 144c-6.6 7-8.4 17.2-4.6 26s12.5 14.5 22 14.5h88l0 192c0 17.7-14.3 32-32 32H32c-17.7 0-32 14.3-32 32v32c0 17.7 14.3 32 32 32l80 0c70.7 0 128-57.3 128-128l0-192h88c9.6 0 18.2-5.7 22-14.5z"/></svg>',
    'desc' => '<svg width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M350 334.5c3.8 8.8 2 19-4.6 26l-136 144c-4.5 4.8-10.8 7.5-17.4 7.5s-12.9-2.7-17.4-7.5l-136-144c-6.6-7-8.4-17.2-4.6-26s12.5-14.5 22-14.5h88l0-192c0-17.7-14.3-32-32-32H32C14.3 96 0 81.7 0 64V32C0 14.3 14.3 0 32 0l80 0c70.7 0 128 57.3 128 128l0 192h88c9.6 0 18.2 5.7 22 14.5z"/></svg>'
];
// Get total number of accounts
$accounts_total = $pdo->query('SELECT COUNT(*) AS total FROM accounts')->fetchColumn();
// Get total number of orders
$orders_total = $pdo->query('SELECT COUNT(*) AS total FROM transactions')->fetchColumn();
// Include the requested page
include $page . '.php';
?>