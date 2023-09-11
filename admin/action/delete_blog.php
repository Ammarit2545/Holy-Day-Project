<?php
session_start();
$e_id = $_SESSION['id'];
include('../../database/condb.php');
$blog = $_GET['blog'];
$session = $_GET['session'];
$count = 1;
echo  '../uploads/' . $e_id . '/holder/' . $session . '/';
while (isset($_SESSION['title_' . $count])) {
    $count++;
}
$count -= 1;
$count_pic = 0;
$folderPath = '../uploads/' . $e_id . '/holder/' . $session . '/'; // Replace with the path to the folder you want to delete

// Delete the selected folder
$folderPathToDelete = '../uploads/' . $e_id . '/holder/' . $session . '/'; // Path to the folder to delete

function deleteFolder($folderPath)
{
    if (is_dir($folderPath)) {
        $files = glob($folderPath . '/*');

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file); // Delete files within the folder
            } elseif (is_dir($file)) {
                deleteFolder($file); // Recursively delete subdirectories
            }
        }

        rmdir($folderPath); // Remove the folder itself
        echo "Folder deleted successfully.";
    } else {
        echo "Folder not found.";
    }
}

deleteFolder($folderPathToDelete);

// Rename remaining folders
for ($i = $session + 1; $i <= $count; $i++) {
    $oldFolderPath = '../uploads/' . $e_id . '/holder/' . $i . '/';
    $newFolderPath = '../uploads/' . $e_id . '/holder/' . ($i - 1) . '/';

    if (is_dir($oldFolderPath)) {
        if (rename($oldFolderPath, $newFolderPath)) {
            echo "Renamed folder $oldFolderPath to $newFolderPath successfully.<br>";
        } else {
            echo "Failed to rename folder $oldFolderPath to $newFolderPath.<br>";
        }
    } else {
        echo "Folder $oldFolderPath not found.<br>";
    }
}


// Change $i to $count in the unset() calls
for ($i = $session; $i <= $count; $i++) {
    if ($i == $session) {
        unset(
            $_SESSION['title_' . $i],
            $_SESSION['title_color_' . $i],
            $_SESSION['title_detail_' . $i],
            $_SESSION['title_id_' . $i],
            $_SESSION['title_file_' . $i]
        );
    } else {
        $_SESSION['title_' . ($i - 1)] = $_SESSION['title_' . $i];
        $_SESSION['title_color_' . ($i - 1)] = $_SESSION['title_color_' . $i];
        $_SESSION['title_detail_' . ($i - 1)] = $_SESSION['title_detail_' . $i];
        $_SESSION['title_id_' . ($i - 1)] = $_SESSION['title_id_' . $i];
        $_SESSION['title_file_' . ($i - 1)] = $_SESSION['title_file_' . $i];
        unset(
            $_SESSION['title_' . $i],
            $_SESSION['title_color_' . $i],
            $_SESSION['title_detail_' . $i],
            $_SESSION['title_id_' . $i],
            $_SESSION['title_file_' . $i]
        );
    }
}



$sql = "SELECT t_name FROM topic WHERE t_id = '$blog'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$sql_delete = "UPDATE topic SET del_flg = 1 WHERE t_id = $blog";
$result_topic = mysqli_query($conn, $sql_delete);

if ($result_topic) {
    $sql_delete_pic = "UPDATE picture SET del_flg = 1 WHERE t_id = $blog";
    $result_delete_pic = mysqli_query($conn, $sql_delete_pic);

    if ($result_delete_pic) {
        $_SESSION['delete-blog'] = $row['t_name'];
        header('Location:../listview_blog.php');
        exit();
    }
}
