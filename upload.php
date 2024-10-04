<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if the form was submitted
if (isset($_POST["submit"])) {

    // Debugging information
    echo "<p>Target file path: $target_file</p>";

    // Check for file upload errors
    if ($_FILES["fileToUpload"]["error"] != UPLOAD_ERR_OK) {
        echo "<p>File upload error: " . $_FILES["fileToUpload"]["error"] . "</p>";
        $uploadOk = 0;
    }

    // Validate file size (e.g., limit to 5MB)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "<p>Sorry, your file is too large.</p>";
        $uploadOk = 0;
    }

    // Allow certain file formats (e.g., jpg, png, pdf)
    $allowedFileTypes = array("jpg", "png", "pdf");
    if (!in_array($fileType, $allowedFileTypes)) {
        echo "<p>Sorry, only JPG, PNG, and PDF files are allowed.</p>";
        $uploadOk = 0;
    }

    // Proceed if there were no errors
    if ($uploadOk == 1) {
        // Database connection 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Today";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Try to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<p>The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.</p>";

            // Prepare file metadata
            $filename = basename($_FILES["fileToUpload"]["name"]);
            $fileSize = $_FILES["fileToUpload"]["size"];

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO uploaded_files (filename, file_type, file_size) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $filename, $fileType, $fileSize);

            if ($stmt->execute()) {
                echo "<p>File metadata saved successfully.</p>";
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
        } else {
            echo "<p>Sorry, there was an error uploading your file.</p>";
            $uploadOk = 0;
        }

        // Close the connection
        $conn->close();
    }
}
?>
