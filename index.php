<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('config/db.php');

$message = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // CHECK PASSWORD
        if (password_verify($password, $user['password'])) {

            // CHECK USER STATUS
            if ($user['status'] == 'disabled') {

                $message = "Account disabled.";

            } else {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['role'] = $user['role'];

                // ROLE REDIRECT
                if ($user['role'] == 'admin') {

                    header("Location: admin/dashboard.php");

                } elseif ($user['role'] == 'lecturer') {

                    header("Location: lecturer/dashboard.php");

                } else {

                    header("Location: student/dashboard.php");
                }

                exit();
            }

        } else {

            $message = "Invalid password!";
        }

    } else {

        $message = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
</head>
<body>
<div class="content-card">
        <h1>Welcome to Offline Learning Platform</h1>

        <nav>
            <a href="login.php">Login</a>
            <span style="color: #666;">|</span>
            <a href="register.php">Register</a>
        </nav>

        <p>Learn anytime without internet connection.</p>
    </div>


</body>
</html>