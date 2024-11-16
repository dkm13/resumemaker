<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Resume Maker</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="navbar">
        <div class="nav-item"><a href="dashboard.php">Dashboard</a></div>
        <div class="nav-item"><a href="view_resumes.php">View Resumes</a></div>
        <div class="nav-item"><a href="logout.php">Logout</a></div>
    </div>

    <div class="container">
        <h1>Welcome to Your Dashboard</h1>

        <div class="card">
            <div class="card-item">
                <h3>Your Resumes</h3>
                <p>View or create new resumes here.</p>
                <a href="view_resumes.php" class="btn">View Resumes</a>
            </div>
            <div class="card-item">
                <h3>Create New Resume</h3>
                <p>Start building your new professional resume.</p>
                <a href="create_resume.php" class="btn">Create Resume</a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Resume Maker. All Rights Reserved.</p>
    </footer>
</body>
</html>
