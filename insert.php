<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$course = trim($_POST["course"] ?? "");
$credit = filter_var($_POST["credit"] ?? "", FILTER_VALIDATE_INT);

if ($course === "" || $credit === false || $credit < 1) {
    $title = "Add Course";
    include "header.php";
    echo "<section class='panel narrow'><div class='msg err'>Enter a course name and a whole number of credits (1 or more).</div>";
    echo "<a class='btn' href='index.php'>Back to form</a></section>";
    include "footer.php";
    exit;
}

$stmt = $conn->prepare("INSERT INTO Course (course, credit) VALUES (?, ?)");
$stmt->bind_param("si", $course, $credit);
$stmt->execute();
$stmt->close();

header("Location: display.php?status=added");
exit;
