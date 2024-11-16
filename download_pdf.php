<?php
include 'includes/db_connect.php';
require('fpdf/fpdf.php');

// Get the resume ID from the URL
$resume_id = $_GET['id'];

// Fetch the resume details from the database
$sql = "SELECT * FROM resumes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $resume_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Create a new PDF document
    $pdf = new FPDF();
    $pdf->AddPage();

    // Title and basic settings
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->SetTextColor(255, 255, 255); // White text for title
    $pdf->SetFillColor(0, 51, 102); // Dark Blue for header background
    $pdf->Cell(0, 15, 'Resume: ' . $row['full_name'], 0, 1, 'C', true);
    $pdf->Ln(10);

    // Section 1: Personal Information with styling
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetTextColor(0, 51, 102);
    $pdf->SetFillColor(240, 240, 240);
    $pdf->Cell(0, 12, 'Personal Information', 0, 1, 'L', true);
    $pdf->Ln(5);
    
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->SetTextColor(0, 0, 0); // Black text for content
    $pdf->Cell(40, 10, 'Name:', 0, 0);
    $pdf->Cell(0, 10, $row['full_name'], 0, 1);
    
    $pdf->Cell(40, 10, 'Email:', 0, 0);
    $pdf->Cell(0, 10, $row['email'], 0, 1);
    $pdf->Ln(10);

    // Section 2: Skills with a background color
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetTextColor(255, 255, 255); // White text
    $pdf->SetFillColor(0, 123, 255); // Blue background
    $pdf->Cell(0, 12, 'Skills', 0, 1, 'L', true);
    $pdf->Ln(5);
    
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0); // Black text for content
    $skills = explode(",", $row['skills']);
    foreach ($skills as $skill) {
        $pdf->Cell(0, 10, "- " . trim($skill), 0, 1);
    }
    $pdf->Ln(10);

    // Section 3: Experience with bordered boxes
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetTextColor(255, 255, 255); // White text
    $pdf->SetFillColor(0, 153, 51); // Green background for experience section
    $pdf->Cell(0, 12, 'Experience', 0, 1, 'L', true);
    $pdf->Ln(5);
    
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0); // Black text for content
    $pdf->MultiCell(0, 10, $row['experience']);
    $pdf->Ln(10);



    // Add a horizontal line with a shadow effect
    $pdf->SetLineWidth(1);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Line across the page
    $pdf->Ln(5);

    // Footer with page number and additional information
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->SetTextColor(128, 128, 128); // Gray footer
    $pdf->Cell(0, 10, 'Page ' . $pdf->PageNo(), 0, 0, 'C');
    
    // Output the PDF
    $pdf->Output('D', 'Resume_' . $row['full_name'] . '.pdf'); // Download the PDF
} else {
    echo "No resume found!";
}
?>
