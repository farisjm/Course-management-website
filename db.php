<?php
require_once __DIR__ . "/helpers.php";
// Database connection (database: university)
$conn = new mysqli("localhost", "root", "root", "university");

if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}
$conn->set_charset("utf8mb4");

