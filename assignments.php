<?php
session_start();

$conn = new mysqli("localhost", "root", "", "tvet_learning");

$result = $conn->query("SELECT * FROM assignments ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assignments</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f6f9;
            margin:0;
            padding:20px;
        }

        h2{
            text-align:center;
            color:#001f3f;
            margin-bottom:30px;
        }

        .container{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));
            gap:20px;
        }

        .card{
            background:white;
            border-radius:15px;
            padding:20px;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .title{
            font-size:18px;
            font-weight:bold;
            color:#001f3f;
            margin-bottom:10px;
        }

        .desc{
            color:#555;
            margin-bottom:10px;
        }

        .badge{
            display:inline-block;
            background:#FFD700;
            padding:5px 10px;
            border-radius:20px;
            font-size:12px;
            margin-bottom:10px;
        }

        .info{
            font-size:14px;
            color:#333;
            margin:5px 0;
        }

        .deadline{
            color:#dc3545;
            font-weight:bold;
        }

        .btn-group{
            margin-top:15px;
            display:flex;
            gap:10px;
            flex-wrap:wrap;
        }

        .btn{
            text-decoration:none;
            padding:10px 15px;
            border-radius:8px;
            font-size:14px;
            display:inline-block;
            color:white;
            text-align:center;
            flex:1;
        }

        .download{
            background:#28a745;
        }

        .submit{
            background:#007bff;
        }

        .btn:hover{
            opacity:0.9;
        }

        .empty{
            text-align:center;
            color:#777;
            margin-top:50px;
        }

    </style>
</head>

<body>

<h2>📚 Available Assignments</h2>

<?php if($result && $result->num_rows > 0) { ?>

<div class="container">

<?php while($row = $result->fetch_assoc()) { ?>

    <div class="card">

        <div class="title">
            <?= htmlspecialchars($row['title']); ?>
        </div>

        <div class="desc">
            <?= htmlspecialchars($row['description']); ?>
        </div>

        <div class="badge">
            <?= htmlspecialchars($row['course']); ?>
        </div>

        <div class="info deadline">
            ⏰ Deadline: <?= htmlspecialchars($row['deadline']); ?>
        </div>

        <?php if(!empty($row['file'])) { ?>
            <div class="info">
                📄 File available
            </div>
        <?php } ?>

        <div class="btn-group">

            <?php if(!empty($row['file'])) { ?>
                <a class="btn download"
                   href="uploads/assignments/<?= $row['file']; ?>"
                   target="_blank">
                    Download
                </a>
            <?php } ?>

            <a class="btn submit"
               href="submit_assignment.php?id=<?= $row['id']; ?>">
                Submit Work
            </a>

        </div>

    </div>

<?php } ?>

</div>

<?php } else { ?>

    <div class="empty">
        No assignments available yet.
    </div>

<?php } ?>

</body>
</html>