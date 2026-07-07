<?php
session_start();

/* CHECK LOGIN */
if (!isset($_SESSION['student_id'])) {

    header("Location: login.php");
    exit();
}

/* DATABASE CONNECTION */
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tvet_learning";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* GET STUDENT DETAILS */
$student_id = $_SESSION['student_id'];

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();

$result = $stmt->get_result();
$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Dashboard</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    background:#001f3f;
    color:white;
    display:flex;
}

/* SIDEBAR */
.sidebar{
    width:250px;
    height:100vh;
    background:#01152b;
    padding:20px;
    position:fixed;
}

.sidebar h2{
    color:#FFD700;
    text-align:center;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:14px;
    margin:10px 0;
    border-radius:8px;
    transition:0.3s;
}

.sidebar a:hover{
    background:#FFD700;
    color:#001f3f;
}

/* MAIN CONTENT */
.main{
    margin-left:250px;
    width:calc(100% - 250px);
    padding:30px;
}

.topbar{
    background:#012b57;
    padding:20px;
    border-radius:12px;
    margin-bottom:30px;
}

.topbar h1{
    font-size:28px;
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.card{
    background:#012b57;
    padding:25px;
    border-radius:15px;
    box-shadow:0 8px 20px rgba(0,0,0,0.3);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card i{
    font-size:35px;
    color:#FFD700;
    margin-bottom:15px;
}

.card h3{
    margin-bottom:10px;
}

.card p{
    color:#ddd;
}

/* PROFILE */
.profile{
    margin-top:35px;
    background:#012b57;
    padding:25px;
    border-radius:15px;
}

.profile h2{
    margin-bottom:20px;
    color:#FFD700;
}

.profile p{
    margin:10px 0;
    font-size:16px;
}

.logout-btn{
    margin-top:20px;
    display:inline-block;
    padding:12px 20px;
    background:red;
    color:white;
    text-decoration:none;
    border-radius:8px;
}

.logout-btn:hover{
    background:darkred;
}

</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h2>TVET LMS</h2>

    <a href="#"><i class="fa fa-home"></i> Dashboard</a>

    <a href="#"><i class="fa fa-book"></i> My Courses</a>

    <a href="#"><i class="fa fa-video"></i> Offline Videos</a>

    <a href="#"><i class="fa fa-file"></i> Notes</a>

    <a href="#"><i class="fa fa-upload"></i> Assignments</a>

    <a href="#"><i class="fa fa-chart-line"></i> Progress</a>

    <a href="#"><i class="fa fa-user"></i> Profile</a>

</div>

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        <h1>
            Welcome,
            <?php echo htmlspecialchars($student['full_name']); ?>
        </h1>

        <p>Offline Learning Platform Dashboard</p>
    </div>

    <!-- DASHBOARD CARDS -->
    <div class="cards">

        <div class="card">
            <i class="fa fa-book"></i>
            <h3>Courses</h3>
            <p>Access all learning modules offline.</p>
        </div>

        <div class="card">
            <i class="fa fa-video"></i>
            <h3>Video Lessons</h3>
            <p>Watch downloaded practical tutorials.</p>
        </div>

        <div class="card">
            <i class="fa fa-file-pdf"></i>
            <h3>PDF Notes</h3>
            <p>Read offline learning materials.</p>
        </div>

        <div class="card">
            <i class="fa fa-tasks"></i>
            <h3>Assignments</h3>
            <p>Submit practical tasks and assessments.</p>
        </div>

    </div>

    <!-- PROFILE -->
    <div class="profile">

        <h2>Student Information</h2>

        <p>
            <strong>Full Name:</strong>
            <?php echo htmlspecialchars($student['full_name']); ?>
        </p>

        <p>
            <strong>Email:</strong>
            <?php echo htmlspecialchars($student['email']); ?>
        </p>

        <p>
            <strong>Student ID:</strong>
            <?php echo htmlspecialchars($student['id']); ?>
        </p>

        <a href="logout.php" class="logout-btn">
            Logout
        </a>

    </div>

</div>

</body>
</html>