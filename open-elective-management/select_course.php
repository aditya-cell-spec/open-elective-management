<?php
include("db.php");
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}
$student_id = $_SESSION['student_id'];

if (isset($_POST['select'])) {
    $course_id = $_POST['course'];
    $stmt = $conn->prepare("INSERT INTO student_courses (student_id, course_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $student_id, $course_id);
    $stmt->execute();
    echo "Course selected successfully.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Course</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Select an Elective</h2>
<form method="post">
    <select name="course" required>
        <?php
        $res = $conn->query("SELECT * FROM courses");
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['course_name']}</option>";
        }
        ?>
    </select>
    <button type="submit" name="select">Submit</button>
</form>
<a href="student_dashboard.php">Back</a>
</body>
</html>
