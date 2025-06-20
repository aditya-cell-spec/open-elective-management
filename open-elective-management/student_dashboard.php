<?php
session_start();
include 'db.php';

// Check student login
if(!isset($_SESSION['student_id'])){
    header("Location: student_login.php");
    exit;
}

$student_id = $_SESSION['student_id'];

// Handle elective selection
if(isset($_POST['select_course'])){
    $course_id = intval($_POST['course_id']);
    // Delete previous selection(s) if you want only one elective per student
    mysqli_query($conn, "DELETE FROM student_courses WHERE student_id = $student_id");

    // Insert new elective selection
    mysqli_query($conn, "INSERT INTO student_courses (student_id, course_id) VALUES ($student_id, $course_id)");

    $message = "Elective selected successfully!";
}

// Fetch student name
$student_res = mysqli_query($conn, "SELECT name FROM students WHERE id = $student_id");
$student = mysqli_fetch_assoc($student_res);

// Fetch all courses
$courses_res = mysqli_query($conn, "SELECT * FROM courses ORDER BY course_name");

// Fetch selected course for student (if any)
$selected_res = mysqli_query($conn, "SELECT course_id FROM student_courses WHERE student_id = $student_id");
$selected_course_id = ($selected_res && mysqli_num_rows($selected_res) > 0) ? mysqli_fetch_assoc($selected_res)['course_id'] : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard - Select Electives</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 8px #ccc;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .welcome {
            margin-bottom: 20px;
            font-size: 18px;
            color: #555;
            text-align: center;
        }
        .message {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        tr:hover {background-color: #f1f1f1;}
        button.select-btn {
            background-color: #007BFF;
            border: none;
            padding: 8px 14px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        button.select-btn:hover {
            background-color: #0056b3;
        }
        .logout-btn {
            display: block;
            width: 100px;
            margin: 0 auto 20px auto;
            padding: 8px;
            background: #dc3545;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .logout-btn:hover {
            background: #a71d2a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Elective Selection</h2>
        <div class="welcome">Hello, <strong><?php echo htmlspecialchars($student['name']); ?></strong>! Please select your elective course.</div>

        <?php if(isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <table>
            <tr>
                <th>Course Name</th>
                <th>Description</th>
                <th>Select</th>
            </tr>
            <?php while($course = mysqli_fetch_assoc($courses_res)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                    <td><?php echo htmlspecialchars($course['description']); ?></td>
                    <td>
                        <?php if($selected_course_id == $course['id']): ?>
                            <button disabled style="background-color: #28a745;">Selected</button>
                        <?php else: ?>
                            <form method="post" style="margin:0;">
                                <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                                <button class="select-btn" type="submit" name="select_course">Select</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>

