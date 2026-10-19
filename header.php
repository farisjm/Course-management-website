<?php require_once __DIR__ . "/helpers.php"; $page = basename($_SERVER["SCRIPT_NAME"]); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? "Course Management System") ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="bar">
    <div class="bar-in">
        <span class="brand"><span class="logo">C</span> University Courses</span>
        <nav>
            <a href="display.php" class="<?= $page === 'display.php' ? 'active' : '' ?>">Courses</a>
            <a href="index.php" class="<?= $page === 'index.php' ? 'active' : '' ?>">Add Course</a>
        </nav>
    </div>
</header>
<main class="wrap">
