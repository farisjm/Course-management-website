<?php
$title = "Add Course";
include "header.php";
?>
<section class="panel narrow">
    <h1>Add Course</h1>
    <p class="sub">Enter the course name and number of credits.</p>
    <form action="insert.php" method="POST">
        <div class="field">
            <label for="course">Course name</label>
            <input type="text" id="course" name="course" maxlength="100" required>
        </div>
        <div class="field">
            <label for="credit">Number of credits</label>
            <input type="number" id="credit" name="credit" min="1" max="30" required>
        </div>
        <div class="actions">
            <button type="submit" class="btn primary">Save course</button>
            <a href="display.php" class="btn">View courses</a>
        </div>
    </form>
</section>
<?php include "footer.php"; ?>
