<?php
session_start();

$conn = new mysqli("localhost", "root", "", "tvet_learning");

$assignment_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_SESSION['student_id'];

    $file = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];

    $path = "uploads/submissions/" . $file;

    move_uploaded_file($tmp, $path);

    $stmt = $conn->prepare("
        INSERT INTO submissions(assignment_id, student_id, file)
        VALUES(?,?,?)
    ");

    $stmt->bind_param("iis",
        $assignment_id,
        $student_id,
        $file
    );

    $stmt->execute();

    echo "Submission successful!";
}
?>

<h2>Submit Assignment</h2>

<form method="POST" enctype="multipart/form-data">

<input type="file" name="file" required><br><br>

<button type="submit">Submit</button>

</form>