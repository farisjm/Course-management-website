<?php
include "db.php";

$id = filter_var($_GET["id"] ?? "", FILTER_VALIDATE_INT);
$row = null;
if ($id !== false) {
    $stmt = $conn->prepare("SELECT id, course, credit FROM Course WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
if (!$row) {
    header("Location: display.php?status=missing");
    exit;
}

$title = "Edit Course";
include "header.php";
?>
<section class="panel narrow">
    <h1>Edit Course</h1>
    <p class="sub">Change the course name or credits, then save.</p>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?= (int)$row["id"] ?>">

        <div class="field">
            <label for="cid">Course ID</label>
            <input type="text" id="cid" value="<?= e($row["id"]) ?>" disabled>
        </div>
        <div class="field">
            <label for="course">Course name</label>
            <input type="text" id="course" name="course" maxlength="100" value="<?= e($row["course"]) ?>" required>
        </div>
        <div class="field">
            <label for="credit">Number of credits</label>
            <input type="number" id="credit" name="credit" min="1" max="30" value="<?= e($row["credit"]) ?>" required>
        </div>
        <div class="actions">
            <button type="submit" class="btn primary">Update course</button>
            <a href="display.php" class="btn">Cancel</a>
        </div>
    </form>
</section>
<?php include "footer.php"; ?>
