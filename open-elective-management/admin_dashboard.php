<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: admin_login.php");
    exit;
}
include 'db.php';

// Handle adding a new course
if(isset($_POST['add_course'])){
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    if($course_name != ''){
        mysqli_query($conn, "INSERT INTO courses (course_name, description) VALUES ('$course_name', '$description')");
        $message = "Course added successfully.";
    }
}

// Handle deleting a course
if(isset($_GET['delete_course'])){
    $course_id = intval($_GET['delete_course']);
    // Delete related student_courses first
    mysqli_query($conn, "DELETE FROM student_courses WHERE course_id = $course_id");
    // Delete course
    mysqli_query($conn, "DELETE FROM courses WHERE id = $course_id");
    header("Location: admin_dashboard.php");
    exit;
}

// Handle deleting a student
if(isset($_GET['delete_student'])){
    $student_id = intval($_GET['delete_student']);
    mysqli_query($conn, "DELETE FROM student_courses WHERE student_id = $student_id");
    mysqli_query($conn, "DELETE FROM students WHERE id = $student_id");
    header("Location: admin_dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Open Elective Management</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Admin Dashboard</h2>
    <a href="logout.php"><button>Logout</button></a>

    <?php if(!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

    <h3>Students List</h3>
    <?php
    $students = mysqli_query($conn, "SELECT students.id, students.name, students.email, courses.course_name 
        FROM students 
        LEFT JOIN student_courses ON students.id = student_courses.student_id
        LEFT JOIN courses ON student_courses.course_id = courses.id
        ORDER BY students.id");

    if(mysqli_num_rows($students) > 0){
        echo "<table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Selected Course</th><th>Action</th>
        </tr>";
        while($row = mysqli_fetch_assoc($students)){
            echo "<tr>
                <td>{$row['id']}</td>
                <td>".htmlspecialchars($row['name'])."</td>
                <td>".htmlspecialchars($row['email'])."</td>
                <td>".htmlspecialchars($row['course_name'] ?? 'None')."</td>
                <td><a href='admin_dashboard.php?delete_student={$row['id']}' onclick=\"return confirm('Delete this student?');\">Delete</a></td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No students found.</p>";
    }
    ?>

    <h3>Courses Management</h3>

    <form method="post" action="admin_dashboard.php">
        <input type="text" name="course_name" placeholder="Course Name" required>
        <input type="text" name="description" placeholder="Description">
        <button type="submit" name="add_course">Add Course</button>
    </form>

    <?php
    $courses = mysqli_query($conn, "SELECT * FROM courses ORDER BY id");
    if(mysqli_num_rows($courses) > 0){
        echo "<table>
        <tr><th>ID</th><th>Course Name</th><th>Description</th><th>Action</th></tr>";
        while($row = mysqli_fetch_assoc($courses)){
            echo "<tr>
                <td>{$row['id']}</td>
                <td>".htmlspecialchars($row['course_name'])."</td>
                <td>".htmlspecialchars($row['description'])."</td>
                <td><a href='admin_dashboard.php?delete_course={$row['id']}' onclick=\"return confirm('Delete this course?');\">Delete</a></td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No courses available.</p>";
    }
    ?>

</body>
</html>
