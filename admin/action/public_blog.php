<?php
session_start();
include('../../database/condb.php');
$blog = $_GET['blog'];
$session = $_GET['session'];
$count = 1;
$title_id = $_SESSION['title_id_' . $session];


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

while (isset($_SESSION['title_' . $count])) {
    $count++;
}
$count -= 1;

//  Create Folder ---------------------------------------------------------------------

// Define the base folder path
$baseFolderPath = "../uploads/$e_id/";

// Create the nested folders if they don't exist
$foldersToCreate = [
    "$title_id/",
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

$folderPath = "../uploads/$e_id/$title_id/";

// Delete the destination folder if it exists
if (file_exists($folderPath)) {
    $deleted = deleteDirectory($folderPath);
    if ($deleted) {
        echo "Folder '$folderPath' deleted successfully.";
    } else {
        echo "Error deleting folder '$folderPath'.";
    }
}

// Recreate the destination folder
if (!file_exists($folderPath)) {
    if (mkdir($folderPath, 0777, true)) {
        echo "<br>Folder '$folderPath' created successfully.";
    } else {
        echo "<br>Error creating folder '$folderPath'.";
    }
}

//  Move Folder Title ---------------------------------------------------------------------

$sourceFolder = "../uploads/$e_id/holder/$session/"; // Replace with the actual path to your source file
$destinationFolder = "../uploads/$e_id/$title_id/"; // Replace with the actual path to your destination folder

if (!is_dir($sourceFolder)) {
    die("Source folder does not exist.");
}

if (!is_dir($destinationFolder)) {
    die("Destination folder does not exist.");
}

$files = scandir($sourceFolder);

foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        $sourcePath = $sourceFolder . $file;
        $destinationPath = $destinationFolder . $file;

        if (file_exists($sourcePath)) {
            if (rename($sourcePath, $destinationPath)) {
                echo "File '$file' moved successfully from $sourcePath to $destinationPath<br>";
            } else {
                echo "Error moving file '$file'.<br>";
            }
        } else {
            echo "File '$file' not found in the source folder.<br>";
        }
    }
}

echo "All files have been moved.";

// Function to recursively delete a directory and its contents
function deleteDirectory($dir)
{
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
}
// Manage Data -----------------------------------------------------------------------
if (rename($sourceFolder, $destinationFolder . basename($sourceFolder))) {
    // Unset session variables related to the current title
    $t_id = $_SESSION['title_id_' . $session];
    $title_file_base = $_SESSION['title_file_base_' . $session];
    $pic_path = "uploads/$e_id/$title_id/title/$title_file_base";

    $sql_update = "UPDATE picture SET p_pic = '$pic_path',p_update = NOW() WHERE t_id = '$t_id' AND del_flg = 0";
    $result = mysqli_query($conn, $sql_update);

    // DELETE SUB ----------------------------------------------------------------
    $count_sub = 1;
    while (isset($_SESSION['sub_title_' . $session . '_' . $count_sub])) {
        $count_sub++;
    }
    $count_sub -= 1;

    // Loop through sub-titles and shift data
    for ($s = 1; $s <= $count_sub; $s++) {
        // fix pic path 
        $st_id = $_SESSION['sub_title_id_' . $session . '_' . $s];
        $sub_title_base = $_SESSION['sub_title_base_' . $session . '_' . $s];
        $pic_path = "uploads/$e_id/$title_id/sub_title/$s/$sub_title_base";

        // $sql_pic = "SELECT p_id FROM picture WHERE st_id = '$st_id' AND del_flg = 0";
        // $result_pic = mysqli_query($conn,$sql_pic);
        // $row_pic = mysqli_fetch_array($result_pic);
        // $p_id = $row_pic['p_id'];

        // $sql_update = "UPDATE picture SET p_pic = '$pic_path_sub' ,p_update = NOW() WHERE p_id = '$p_id' AND del_flg = 0";
        // $result = mysqli_query($conn, $sql_update);

        $sql_update = "UPDATE picture SET p_pic = '$pic_path' ,p_update = NOW() WHERE st_id = '$st_id' AND del_flg = 0";
        $result = mysqli_query($conn, $sql_update);
    }

    unset(
        $_SESSION['title_' . $session],
        $_SESSION['title_color_' . $session],
        $_SESSION['title_detail_' . $session],
        $_SESSION['title_id_' . $session],
        $_SESSION['title_file_' . $session]
    );

    // Loop through titles
    for ($i = $session + 1; $i <= $count; $i++) {
        // Shift data for the remaining titles
        $_SESSION['title_' . ($i - 1)] = $_SESSION['title_' . $i];
        $_SESSION['title_color_' . ($i - 1)] = $_SESSION['title_color_' . $i];
        $_SESSION['title_detail_' . ($i - 1)] = $_SESSION['title_detail_' . $i];
        $_SESSION['title_id_' . ($i - 1)] = $_SESSION['title_id_' . $i];
        $_SESSION['title_file_' . ($i - 1)] = $_SESSION['title_file_' . $i];

        // DELETE SUB ----------------------------------------------------------------
        $count_sub = 1;
        while (isset($_SESSION['sub_title_' . $i . '_' . $count_sub])) {
            $count_sub++;
        }
        $count_sub -= 1;

        // Loop through sub-titles and shift data
        for ($s = 1; $s <= $count_sub; $s++) {
            $_SESSION['sub_title_id_' . ($i - 1) . '_' . $s] = $_SESSION['sub_title_id_' . $i . '_' . $s];
            $_SESSION['sub_title_' . ($i - 1) . '_' .  $s] = $_SESSION['sub_title_' . $i . '_' . $s];
            $_SESSION['sub_title_detail_' . ($i - 1) . '_' .  $s] = $_SESSION['sub_title_detail_' . $i . '_' . $s];
            $_SESSION['sub_title_section_' . ($i - 1) . '_' . $s] = $_SESSION['sub_title_section_' . $i . '_' . $s];
        }

        // DELETE SUB ----------------------------------------------------------------

        // Unset session variables for the current title
        unset(
            $_SESSION['title_' . $i],
            $_SESSION['title_color_' . $i],
            $_SESSION['title_detail_' . $i],
            $_SESSION['title_id_' . $i],
            $_SESSION['title_file_' . $i]
        );
    }

    // SQL queries to update the database
    $sql = "SELECT t_name FROM topic WHERE t_id = '$blog'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $sql_delete = "UPDATE topic SET t_test = 0 WHERE t_id = $blog";
    $result_topic = mysqli_query($conn, $sql_delete);

    if ($result_topic) {
        $_SESSION['show-blog'] = $row['t_name'];
        header('Location:../listview_blog.php');
        exit();
    }
} else {
    echo "Error moving file.";
}
