
<?php
session_start();

/* DATABASE CONNECTION */
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tvet_learning";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* LOGIN PROCESS */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // CHECK USER
    $stmt = $conn->prepare("SELECT id, full_name, email, password, role FROM students WHERE email = ?");

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        // VERIFY PASSWORD
        if (password_verify($password, $user['password'])) {

            // CREATE SESSION
            $_SESSION['student_id'] = $user['id'];
            $_SESSION['student_name'] = $user['full_name'];
            $_SESSION['student_email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // REDIRECT BASED ON ROLE
            if ($user['role'] == 'admin') {

                header("Location: admin/dashboard.php");

            } elseif ($user['role'] == 'lecturer') {

                header("Location: lecturer/dashboard.php");

            } else {

                header("Location: student/dashboard.php");
            }

            exit();

        } else {

            echo "<script>
                    alert('Incorrect Password');
                    window.location.href='login.php';
                  </script>";
        }

    } else {

        echo "<script>
                alert('Email Not Found');
                window.location.href='login.php';
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<style>
        body {
            /* Using a deep navy blue inspired by the primary branding */
            background-color: #002147; 
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }

        .content-card {
            background-color: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #ffffff;
        }

        nav {
            margin: 25px 0;
            font-size: 1.2rem;
        }

        nav a {
            /* Using a gold/yellow accent color for links */
            color: #FFD700; 
            text-decoration: none;
            padding: 0 15px;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        p {
            font-size: 1.1rem;
            color: #cccccc;
        }
    </style>
    <title>Offline Learning System</title>
</head>
<body>
    <h1>Welcome to Offline Learning Platform</h1>

 <form action="login.php" method="POST">
    <h2>Login Page</h2>

    <label>Email:</label><input type="email" name="email" placeholder="Email"><br>
   <label>Password:</label> <input type="password" name="password" placeholder="Password"><br>

    <button type="submit">Login</button>
</form>
   

    <p>Learn anytime without internet connection.</p>
</body>
</html>

