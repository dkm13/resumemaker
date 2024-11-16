<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $skills = $_POST['skills'];
    $experience = $_POST['experience'];
    
    // Insert resume into the database
    $sql = "INSERT INTO resumes (user_id, full_name, email, phone, skills, experience) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $user_id, $full_name, $email, $phone, $skills, $experience);

    if ($stmt->execute()) {
        echo "Resume created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Resume - Resume Maker</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="resume-form">
        <h2>Create Your Resume</h2>
        <form method="POST" action="">
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <textarea name="skills" placeholder="Skills (comma separated)" required></textarea>
            <textarea name="experience" placeholder="Experience (details)" required></textarea>
            <button type="submit">Save Resume</button>
        </form>
    </div>
</body>
</html>
