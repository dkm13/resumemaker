<?php
session_start();

// Check if the user is logged in by checking the session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'includes/db_connect.php';

// Get user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch resumes for the logged-in user
$sql = "SELECT * FROM resumes WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Resumes</title>
    <link rel="stylesheet" href="css/view_resumes.css">
</head>
<body>
    <div class="container">
        <h1>Your Resumes</h1>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Skills</th>
                    <th>Experience</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    
                    <tr>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['skills']); ?></td>
                        <td><?php echo htmlspecialchars($row['experience']); ?></td>
                        <td>
                            <a href="download_pdf.php?id=<?php echo $row['id']; ?>" class="btn">Download PDF</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No resumes found. Create one to get started!</p>
        <?php endif; ?>
    </div>
</body>
</html>
