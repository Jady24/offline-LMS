<?php
session_start();

if(!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost","root","","tvet_learning");

$student_id = $_SESSION['student_id'];

$student = $conn->query("
    SELECT is_paid
    FROM students
    WHERE id='$student_id'
")->fetch_assoc();

if($student['is_paid'] != 1){

    die("
    <h2 style='color:red;text-align:center;margin-top:50px;'>
        Access Denied. Payment Not Yet Approved.
    </h2>
    ");
}
?>



<?php

$conn = new mysqli("localhost", "root", "", "tvet_learning");

$result = $conn->query("SELECT * FROM learning_materials ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>Learning Materials</title>

<style>

body{
    background:#001f3f;
    color:white;
    font-family:Arial;
    padding:30px;
}

.card{
    background:#012b57;
    padding:20px;
    margin-bottom:20px;
    border-radius:12px;
}

a{
    color:#FFD700;
}

</style>

</head>

<body>

<h1>Learning Materials</h1>

<?php while($row = $result->fetch_assoc()) { ?>

<div class="card">

<h3><?= $row['title']; ?></h3>

<p><?= $row['description']; ?></p>

<p>Type: <?= $row['type']; ?></p>

<?php if($row['type'] == 'note') { ?>

<a href="uploads/notes/<?= $row['file_name']; ?>" target="_blank">

Download Notes

</a>

<?php } else { ?>

<video width="400" controls>

<source src="uploads/videos/<?= $row['file_name']; ?>">

</video>

<?php } ?>

</div>

<?php } ?>

</body>
</html>