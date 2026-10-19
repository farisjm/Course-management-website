<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: display.php");
    exit;
}

$id     = filter_var($_POST["id"] ?? "", FILTER_VALIDATE_INT);
$course = trim($_POST["course"] ?? "");
$credit = filter_var($_POST["credit"] ?? "", FILTER_VALIDATE_INT);

if ($id === false || $course === "" || $credit === false || $credit < 1) {
    $title = "Edit Course";
    include "header.php";
    echo "<section class='panel narrow'><div class='msg err'>Enter a course name and a whole number of credits (1 or more).</div>";
    echo "<a class='btn' href='display.php'>Back to courses</a></section>";
    include "footer.php";
    exit;
}

$stmt = $conn->prepare("UPDATE Course SET course = ?, credit = ? WHERE id = ?");
$stmt->bind_param("sii", $course, $credit, $id);
$stmt->execute();
$stmt->close();

header("Location: display.php?status=updated");
exit;
