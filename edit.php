<?php
require_once 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course = trim($_POST['course'] ?? '');
    $creditInput = trim($_POST['credit'] ?? '');

    if ($course === '') {
        $errors[] = 'Course name is required.';
    } elseif (mb_strlen($course) > 100) {
        $errors[] = 'Course name must be 100 characters or fewer.';
    }

    if ($creditInput === '') {
        $errors[] = 'Credit is required.';
    } elseif (filter_var($creditInput, FILTER_VALIDATE_INT) === false) {
        $errors[] = 'Credit must be a valid integer.';
    } else {
        $credit = (int) $creditInput;
        if ($credit < 1 || $credit > 10) {
            $errors[] = 'Credit must be between 1 and 10.';
        }
    }

    if (!$errors) {
        $stmt = $conn->prepare('UPDATE Course SET course = ?, credit = ? WHERE id = ?');
        $stmt->bind_param('sii', $course, $credit, $id);

        if ($stmt->execute()) {
            $stmt->close();
            header('Location: index.php');
            exit;
        }

        $errors[] = 'Could not update course. Please try again.';
        $stmt->close();
    }
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Course</h1>

        <?php if ($errors): ?>
            <div class="message error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card">
            <form method="post" action="edit.php?id=<?= (int) $id ?>" novalidate>
                <label for="course">Course Name</label>
                <input
                    type="text"
                    id="course"
                    name="course"
                    maxlength="100"
                    value="<?= htmlspecialchars($_POST['course'] ?? $courseData['course'], ENT_QUOTES, 'UTF-8') ?>"
                    required
                >

                <label for="credit">Credit</label>
                <input
                    type="number"
                    id="credit"
                    name="credit"
                    min="1"
                    max="10"
                    value="<?= htmlspecialchars($_POST['credit'] ?? (string) $courseData['credit'], ENT_QUOTES, 'UTF-8') ?>"
                    required
                >

                <div class="actions-row">
                    <button type="submit">Update Course</button>
                    <a href="index.php" class="btn muted">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
