<?php

include("database/database.php");

if($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("I see you");
} 

$studentNo = trim($_POST["student_no"]);
$fname = trim($_POST["first_name"]); 
$lname = trim($_POST["last_name"]);
$fullname = "$fname $lname";
$course = trim($_POST["course"]);

if ($studentNo === "" || $fullname === "" || $course === "") {
    header("Location: index.php?info=Fill all required fields!");
    exit();
}

$query = "INSERT INTO students (student_no, student_name, course) VALUES (?, ?, ?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("sss",  $studentNo, ucwords($fullname), $course);
$execute = $stmt->execute();

if ($execute) {
    header("Location: index.php?info=Register Successfully");
    exit();
} else {
    header("Location: index.php?info=" . urldecode(mysqli_error($connection)));
    exit();
}
