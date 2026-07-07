<?php
/* DATABASE CONNECTION */
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tvet_learning";

/* CONNECT TO DATABASE */
$conn = new mysqli($host, $user, $pass, $dbname);

/* CHECK CONNECTION */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* REGISTER USER */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // RECEIVE FORM DATA
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // HASH PASSWORD
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // CHECK IF EMAIL EXISTS
    $check = $conn->prepare("SELECT id FROM student WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {

        echo "
        <script>
            alert('Email already registered');
            window.location.href='register.php';
        </script>
        ";

    } else {

        // INSERT INTO DATABASE
        $stmt = $conn->prepare("INSERT INTO students(full_name, email, password) VALUES (?, ?, ?)");

        $stmt->bind_param("sss", $full_name, $email, $hashed_password);

        if ($stmt->execute()) {

            echo "
            <script>
                alert('Registration Successful');
                window.location.href='login.php';
            </script>
            ";

        } else {

            echo "
            <script>
                alert('Registration Failed');
            </script>
            ";
        }

        $stmt->close();
    }

    $check->close();
}

$conn->close();
?>
