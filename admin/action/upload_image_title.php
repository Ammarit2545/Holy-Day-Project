<?php
session_start();
$e_id = $_SESSION['id'];

$folderPath = '../uploads/' . $e_id . '/holder/title/'; // Replace with the actual path to your folder

if (is_dir($folderPath)) {
    $files = scandir($folderPath);
    foreach ($files as $file) {
        // Exclude . and .. entries, which represent the current and parent directory
        if ($file != "." && $file != "..") {
            $filePath = $folderPath . "/" . $file;

            // Check if it's a file (not a directory) before attempting to delete
            if (is_file($filePath)) {
                if (unlink($filePath)) {
                    echo "Deleted: $filePath<br>";
                } else {
                    echo "Failed to delete: $filePath<br>";
                }
            }
        }
    }
} else {
    echo "Folder does not exist.";
}

// Define the base folder path
$baseFolderPath = "../uploads/$e_id/";

// Create the nested folders if they don't exist
$foldersToCreate = [
    "holder/",
    "holder/title/",
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

$folderPath = "uploads/$e_id/holder/title/";

$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf']; // Add allowed file extensions here

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['title_file'])) {
    $file = $_FILES['title_file'];
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        // Generate a unique filename to prevent overwriting existing files
        $newFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $baseFolderPath . "holder/title/" . $newFileName;
        $folderPath = $folderPath . $newFileName;

        // Check if a file with the same name already exists and delete it
        if (file_exists($uploadPath)) {
            unlink($uploadPath);
            echo '<br>Deleted old file: ' . $uploadPath . '<br>';
        }

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            echo '<br>File uploaded successfully.';

            // Check if the uploaded file is an image
            $imageInfo = getimagesize($uploadPath);
            if ($imageInfo !== false) {
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
    echo $uploadPath;
    $_SESSION['title_file'] = $folderPath;
    header('location:../create_blog.php');
}

// Auto delete old files (e.g., files older than 7 days)
$folderName = $baseFolderPath . "holder/title/";
$files = glob($folderName . '*.*');
$today = time();

foreach ($files as $file) {
    $fileModifiedTime = filemtime($file);
    if ($today - $fileModifiedTime >= 7 * 24 * 60 * 60) { // 7 days in seconds
        unlink($file);
        echo '<br>Deleted old file: ' . $file . '<br>';
    }
}
