<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Open Elective Management System</title>
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color:#F0F8FF; /* beige */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            background:#003153; /* dark brown */
            padding: 40px 50px;
            border-radius: 12px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
            text-align: center;
            color: #fff;
        }
        h1 {
            margin-bottom: 25px;
            font-size: 2.5rem;
            letter-spacing: 2px;
        }
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        a.btn {
            display: block;
            padding: 15px 0;
            background: #ffffffcc;
            color: #5c4033;
            font-weight: 700;
            text-decoration: none;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }
        a.btn:hover {
            background: #fff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
        }
        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }
            h1 {
                font-size: 2rem;
            }
            a.btn {
                font-size: 1rem;
                padding: 12px 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Open Elective Management</h1>
        <div class="btn-group">
            <a href="login.php" class="btn">Student Login</a>
            <a href="register.php" class="btn">Student Register</a>
            <a href="admin_login.php" class="btn">Admin Login</a>
        </div>
    </div>
</body>
</html>
