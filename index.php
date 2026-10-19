<?php
require_once 'db.php';

$errors = [];
$success = '';

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
        $stmt = $conn->prepare('INSERT INTO Course (course, credit) VALUES (?, ?)');
        $stmt->bind_param('si', $course, $credit);

        if ($stmt->execute()) {
            $success = 'Course added successfully.';
            $_POST = [];
        } else {
            $errors[] = 'Could not add course. Please try again.';
        }

        $stmt->close();
    }
}

$result = $conn->query('SELECT id, course, credit FROM Course ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Course Management System</h1>

        <?php if ($success): ?>
            <p class="message success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

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
            <h2>Add Course</h2>
            <form method="post" action="index.php" novalidate>
                <label for="course">Course Name</label>
                <input
                    type="text"
                    id="course"
                    name="course"
                    maxlength="100"
                    value="<?= htmlspecialchars($_POST['course'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    required
                >

                <label for="credit">Credit</label>
                <input
                    type="number"
                    id="credit"
                    name="credit"
                    min="1"
                    max="10"
                    value="<?= htmlspecialchars($_POST['credit'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    required
                >

                <button type="submit">Add Course</button>
            </form>
        </div>

        <div class="card">
            <h2>Course List</h2>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course</th>
                            <th>Credit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= (int) $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['course'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= (int) $row['credit'] ?></td>
                                    <td class="actions">
                                        <a href="edit.php?id=<?= (int) $row['id'] ?>" class="btn small">Edit</a>
                                        <a href="delete.php?id=<?= (int) $row['id'] ?>" class="btn small danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="empty">No courses found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
