<?php
require_once 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare('SELECT id, course, credit FROM Course WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$courseData = $result->fetch_assoc();
$stmt->close();

if (!$courseData) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['confirm'] ?? '') === 'yes') {
        $stmt = $conn->prepare('DELETE FROM Course WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Delete Course</h1>

        <div class="card">
            <p>Are you sure you want to delete <strong><?= htmlspecialchars($courseData['course'], ENT_QUOTES, 'UTF-8') ?></strong> (<?= (int) $courseData['credit'] ?> credits)?</p>
            <form method="post" action="delete.php?id=<?= (int) $id ?>" class="actions-row">
                <button type="submit" name="confirm" value="yes" class="danger">Yes, Delete</button>
                <button type="submit" name="confirm" value="no" class="btn muted">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>
