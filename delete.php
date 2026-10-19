<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: display.php");
    exit;
}

$id = filter_var($_POST["id"] ?? "", FILTER_VALIDATE_INT);
if ($id === false) {
    header("Location: display.php?status=missing");
    exit;
}

$stmt = $conn->prepare("DELETE FROM Course WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$deleted = $stmt->affected_rows > 0;
$stmt->close();

// Show the updated course list
header("Location: display.php?status=" . ($deleted ? "deleted" : "missing"));
exit;
