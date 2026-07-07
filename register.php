
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OFFLINE LEARNING SYSTEM</title>
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
		button{
            width:100%;
            padding:12px;
            background:#FFD700;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-weight:bold;
        }

        button:hover{
            background:white;
        }
    </style>
</head>
<body>
<div class="content-card">
        <h1>Welcome to Offline Learning Platform</h1>

     

        <p>Learn anytime without internet connection.</p>
    </div>
 <form action="submit.php" method="POST">
    <h2>Create Account</h2>

    <input type="text" name="full_name" placeholder="Full Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>

    <button type="submit">Register</button>
</form>
  
</body>
</html>




