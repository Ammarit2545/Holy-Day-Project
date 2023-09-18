<?php

// Page 
// Image
// Blog Now
// e_id

session_start();
include('../../database/condb.php');

// Get the user ID from the session
if (isset($_SESSION['id'])) {
    $e_id = $_SESSION['id'];
} else {
    // Handle the case where 'id' is not set in the session
    die("User ID not found in session.");
}

// Get the 'blog' parameter from the GET request
if (isset($_GET['blog'])) {
    $blog_now = $_GET['blog'];
} else {
    // Handle the case where 'blog' parameter is not set in the GET request
    die("Blog parameter not found in the GET request.");
}
// Get the 'blog' parameter from the GET request
if (isset($_GET['sub'])) {
    $sub = $_GET['sub'];
} else {
    // Handle the case where 'blog' parameter is not set in the GET request
    die("Blog parameter not found in the GET request.");
}

$sub_id = $_SESSION['sub_title_id_' . $blog_now . '_' . $sub];

$title_page = $_POST['title_page'];

// Define the base folder path
$baseFolderPath = "../uploads/$e_id/";

// Create the nested folders if they don't exist
$foldersToCreate = [
    "holder/",
    "holder/$blog_now/",
    "holder/$blog_now/sub_title/",
    "holder/$blog_now/sub_title/$sub/",
];

foreach ($foldersToCreate as $folder) {
    $folderName = $baseFolderPath . $folder;
    if (!file_exists($folderName)) {
        if (mkdir($folderName, 0777, true)) {
            echo "<br>Folder '$folderName' created successfully.";
        } else {
            echo "<br>Error creating folder '$folderName'.";
        }
    } else {
        echo "<br>Folder '$folderName' already exists.";
    }
}

$folderPath = "../uploads/$e_id/holder/$blog_now/sub_title/$sub/";

// Check if the folder exists
if (is_dir($folderPath)) {
    // Open the folder
    if ($handle = opendir($folderPath)) {
        // Loop through the files in the folder
        while (false !== ($file = readdir($handle))) {
            // Exclude "." and ".." from the list of files
            if ($file != "." && $file != "..") {
                // Construct the full file path
                $filePath = $folderPath . $file;

                // Delete the file
                if (unlink($filePath)) {
                    echo "Deleted file: $filePath<br>";
                } else {
                    echo "Failed to delete file: $filePath<br>";
                }
            }
        }
        // Close the folder
        closedir($handle);
    } else {
        echo "Failed to open folder: $folderPath<br>";
    }
} else {
    echo "Folder does not exist: $folderPath<br>";
}
$folderPath = "uploads/$e_id/holder/$blog_now/sub_title/$sub/";

$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf']; // Add allowed file extensions here

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['sub_title_pic_' . $blog_now . '_' . $sub])) {
    $file = $_FILES['sub_title_pic_' . $blog_now . '_' . $sub];
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        // Generate a unique filename to prevent overwriting existing files
        $newFileName = "sub_title_$sub_id.$fileExtension"; // Change the filename here
        $uploadPath = $baseFolderPath . "holder/$blog_now/sub_title/$sub/$newFileName";
        $folderPath = $folderPath . $newFileName;

        $_SESSION['sub_title_base_' . $blog_now . '_' . $sub] = $newFileName; // ชื่อไฟล์

        // Check if a file with the same name already exists and delete it
        if (file_exists($uploadPath)) {
            unlink($uploadPath);
            echo '<br>Deleted old file: ' . $uploadPath . '<br>';
        }

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            echo '<br>File uploaded successfully.';

            // Check if the uploaded file is an image (for image compression)
            if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                // Perform image compression to reduce file size
                $image = imagecreatefromjpeg($uploadPath); // You can adjust this based on the image type
                imagejpeg($image, $uploadPath, 80); // Adjust the quality factor (80 in this example)
                imagedestroy($image);
                echo '<br>Image compressed to reduce file size.';
            }
        } else {
            echo '<br>Error uploading file.';
        }
    } else {
        echo '<br>Invalid file type. Allowed file types: ' . implode(', ', $allowedExtensions);
    }

    $st_id = $_SESSION['sub_title_id_' . $blog_now . '_' . $sub];
    

    // Check if a picture with the same 'st_id' exists
    $sql_check = "SELECT * FROM picture WHERE st_id = '$st_id'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Update existing picture record
        $sql_update = "UPDATE picture SET p_pic='$folderPath', p_update = NOW() WHERE st_id ='$st_id'";
        $result_update = mysqli_query($conn, $sql_update);

        if ($result_update) {
            $_SESSION['sub_title_pic_' . $blog_now . '_' . $sub] = $folderPath;

            // Use the variables in the header function
            header("Location: ../$title_page?blog=$blog_now");
        } else {
            echo "Error updating picture record: " . mysqli_error($conn);
        }
    } else {
        // Insert a new picture record
        $sql_insert = "INSERT INTO picture (p_pic, p_date_in, st_id) VALUES ('$folderPath', NOW(), '$st_id')";
        $result_insert = mysqli_query($conn, $sql_insert);

        if ($result_insert) {
            $_SESSION['sub_title_pic_' . $blog_now . '_' . $sub] = $folderPath;

            // Use the variables in the header function
            header("Location: ../$title_page?blog=$blog_now");
        } else {
            echo "Error inserting new picture record: " . mysqli_error($conn);
        }
    }



    exit; // Make sure to exit after redirecting
}

// Auto delete old files (e.g., files older than 7 days)
$folderName = $baseFolderPath . "holder/$blog_now/sub_title/$sub/";
$files = glob($folderName . '*.*');
$today = time();

foreach ($files as $file) {
    $fileModifiedTime = filemtime($file);
    if ($today - $fileModifiedTime >= 7 * 24 * 60 * 60) { // 7 days in seconds
        unlink($file);
        echo '<br>Deleted old file: ' . $file . '<br>';
    }
}
