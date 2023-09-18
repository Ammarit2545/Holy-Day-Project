<?php
session_start();
include('../../database/condb.php');

$e_id = $_SESSION['id'];

$sub_id = $_GET['sub_id'];
$topic = $_GET['blog'];
$page = $_GET['page'];
$sub = $_GET['sub'];

echo $sub_id;
echo '<br>' . $topic;
echo '<br>' . $sub;

$count_sub = 1;
while (isset($_SESSION['sub_title_' . $topic . '_' . $count_sub])) {
    $count_sub++;
}
$count_sub -= 1;
echo '<br>' . $count_sub;

$folderPathToDelete = '../uploads/' . $e_id . '/holder/' . $topic . '/sub_title/' . $sub;  // Path to the folder to delete

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

// Rename folders for subsequent subdirectories
for ($i = $sub + 1; $i <= $count_sub; $i++) {
    $oldFolderPath = '../uploads/' . $e_id . '/holder/' . $topic . '/sub_title/' . $i;
    $newFolderPath =  '../uploads/' . $e_id . '/holder/' . $topic . '/sub_title/' . ($i - 1);

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
for ($i = $sub; $i <= $count_sub; $i++) {
    if ($i == $sub) {
        unset(
            $_SESSION['sub_title_id_' . $topic . '_' . $i],
            $_SESSION['sub_title_' . $topic . '_' . $i],
            $_SESSION['sub_title_detail_' . $topic . '_' . $i],
            $_SESSION['sub_title_section_' . $topic . '_' . $i]
        );
    } else {
        $_SESSION['sub_title_id_' . $topic . '_' . ($i - 1)] = $_SESSION['sub_title_id_' . $topic . '_' . $i];
        $_SESSION['sub_title_' . $topic . '_' .  ($i - 1)] = $_SESSION['sub_title_' . $topic . '_' . $i];
        $_SESSION['sub_title_detail_' . $topic . '_' .  ($i - 1)] = $_SESSION['sub_title_detail_' . $topic . '_' . $i];
        $_SESSION['sub_title_section_' . $topic . '_' .  ($i - 1)] = $_SESSION['sub_title_section_' . $topic . '_' . $i];
        unset(
            $_SESSION['sub_title_id_' . $topic . '_' . $i],
            $_SESSION['sub_title_' . $topic . '_' . $i],
            $_SESSION['sub_title_detail_' . $topic . '_' . $i],
            $_SESSION['sub_title_section_' . $topic . '_' . $i]
        );
    }
}


$sql = "SELECT st_main FROM sub_topic WHERE st_id = '$sub_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$sql_delete = "UPDATE sub_topic SET del_flg = 1 WHERE st_id = $sub_id";
$result_topic = mysqli_query($conn, $sql_delete);

if ($result_topic) {
    $sql_delete_pic = "UPDATE picture SET del_flg = 1 WHERE st_id = $sub_id";
    $result_delete_pic = mysqli_query($conn, $sql_delete_pic);

    if ($result_delete_pic) {
        $_SESSION['delete-sub'] = 0;
        header('Location:../' . $page . '?blog=' . $topic);
        exit();
    }
}
