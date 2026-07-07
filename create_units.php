<?php

$conn = new mysqli("localhost", "root", "", "tvet_learning");

$course_id = $_GET['id'];

$course = $conn->query("
    SELECT * FROM courses
    WHERE id='$course_id'
")->fetch_assoc();

$units = $conn->query("
    SELECT * FROM course_units
    WHERE course_id='$course_id'
");

?>

<!DOCTYPE html>
<html>
<head>
<title>Course Units</title>

<style>

body{
    font-family:Arial;
    background:#f4f6f9;
    padding:20px;
}

.box{
    max-width:900px;
    margin:auto;
    background:white;
    padding:25px;
    border-radius:12px;
}

.unit{
    background:#eee;
    padding:15px;
    margin:10px 0;
    border-radius:10px;
}

a{
    text-decoration:none;
    color:#001f3f;
    font-weight:bold;
}

</style>
</head>

<body>

<div class="box">

<h1>
<?= $course['course_name'] ?>
</h1>

<h3>Course Units</h3>

<?php while($row = $units->fetch_assoc()) { ?>

<div class="unit">

    📘 <?= $row['unit_name'] ?>

    <?php if($row['notes_file']) { ?>

        |
        <a href="uploads/notes/<?= $row['notes_file'] ?>">
            Download Notes
        </a>

    <?php } ?>

</div>

<?php } ?>

</div>

</body>
</html>