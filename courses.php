<?php
session_start();

$conn = new mysqli("localhost", "root", "", "tvet_learning");

if ($conn->connect_error) {
    die("Database Connection Failed");
}

/* FETCH COURSES */
$result = $conn->query("
    SELECT * FROM courses
    ORDER BY created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>

    <style>

        body{
            margin:0;
            padding:20px;
            background:#f4f6f9;
            font-family:Arial;
        }

        .header{
            background:#001f3f;
            color:white;
            padding:20px;
            border-radius:12px;
            text-align:center;
            margin-bottom:30px;
        }

        .header h1{
            margin:0;
            color:#FFD700;
        }

        .container{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
            gap:25px;
        }

        .card{
            background:white;
            border-radius:15px;
            padding:25px;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
            transition:0.3s;
            position:relative;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .course-code{
            position:absolute;
            top:15px;
            right:15px;
            background:#FFD700;
            color:black;
            padding:5px 10px;
            border-radius:20px;
            font-size:12px;
            font-weight:bold;
        }

        .course-title{
            font-size:22px;
            color:#001f3f;
            margin-bottom:10px;
            font-weight:bold;
        }

        .description{
            color:#555;
            line-height:1.6;
            margin-bottom:20px;
        }

        .info{
            margin:8px 0;
            color:#333;
            font-size:14px;
        }

        .btn{
            display:inline-block;
            margin-top:15px;
            padding:12px 18px;
            background:#001f3f;
            color:white;
            text-decoration:none;
            border-radius:8px;
            font-weight:bold;
        }

        .btn:hover{
            background:#FFD700;
            color:black;
        }

        .empty{
            text-align:center;
            color:#777;
            margin-top:50px;
        }

    </style>
</head>

<body>

<div class="header">

    <h1>TVET Offline Learning Platform</h1>

    <p>Available Courses</p>

</div>

<?php if($result->num_rows > 0){ ?>

<div class="container">

<?php while($row = $result->fetch_assoc()) { ?>

<div class="card">

    <div class="course-code">
        <?= htmlspecialchars($row['course_code']) ?>
    </div>

    <div class="course-title">
        <?= htmlspecialchars($row['course_name']) ?>
    </div>

    <div class="description">
        <?= htmlspecialchars($row['description']) ?>
    </div>

    <div class="info">
        👨‍🏫 Lecturer:
        <strong>
            <?= htmlspecialchars($row['lecturer_name']) ?>
        </strong>
    </div>

    <div class="info">
        📚 Semester:
        <strong>
            <?= htmlspecialchars($row['semester']) ?>
        </strong>
    </div>

    <div class="info">
        🕒 Posted:
        <strong>
            <?= date("d M Y", strtotime($row['created_at'])) ?>
        </strong>
    </div>

    <a class="btn"
       href="course_units.php?id=<?= $row['id'] ?>">

       Open Course

    </a>

</div>

<?php } ?>

</div>

<?php } else { ?>

<div class="empty">

    <h2>No Courses Available</h2>

</div>

<?php } ?>

</body>
</html>