<?php
include "db.php";

$messages = [
    "added"   => "Course added successfully.",
    "updated" => "Course updated successfully.",
    "deleted" => "Course deleted successfully.",
    "missing" => "That course no longer exists.",
];
$status = $_GET["status"] ?? "";

$result = $conn->query("SELECT id, course, credit FROM Course ORDER BY id");
$title = "Courses";
include "header.php";
?>
<section class="panel">
    <div class="toolbar">
        <h2>Course List</h2>
        <a class="btn primary" href="index.php">+ Add Course</a>
    </div>

    <?php if (isset($messages[$status])) { ?>
        <div class="msg <?= $status === 'missing' ? 'err' : 'ok' ?>"><?= e($messages[$status]) ?></div>
    <?php } ?>

    <div class="table-wrap">
    <table>
        <thead>
            <tr><th>ID</th><th>Course Name</th><th>Credits</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows === 0) { ?>
            <tr><td colspan="4" class="empty">No courses yet. Add the first one.</td></tr>
        <?php } ?>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td class="id"><?= e($row["id"]) ?></td>
                <td><?= e($row["course"]) ?></td>
                <td class="credit"><?= e($row["credit"]) ?></td>
                <td class="act">
                    <a class="btn small" href="edit.php?id=<?= (int)$row["id"] ?>">Edit</a>
                    <form action="delete.php" method="POST"
                          onsubmit="return confirm('Delete this course?');">
                        <input type="hidden" name="id" value="<?= (int)$row["id"] ?>">
                        <button type="submit" class="btn small danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
</section>
<?php include "footer.php"; ?>
