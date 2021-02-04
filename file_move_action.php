<?php
include "vendor/autoload.php";

$data = new FileQueryController();

if (isset($_POST["submit"])){

    $directory = "FileSystem/";
    $file_id = $_POST["file_id"];
    $file_name = $_POST["file_name"];
    $select_folder = $_POST["select_folder"];
    $old_folder_name = $_POST["old_folder_name"];
    $path = $directory.$select_folder;
    $old_path = $directory.$old_folder_name;

    $user_Id = $_POST["modify_by"];
    $info = $data->findUserById($user_Id);
    $id = $info->fetch_object();
    $modify_by = $id->employee_name;

    if (file_exists($old_path.'/'.$file_name)){
        $moved = copy($old_path.'/'.$file_name, $path.'/'.$file_name);
        if($moved){

            $result = $data->moveFileTo($file_id,$file_name,$path,$modify_by);
            if ($result){
                unlink($old_path.'/'.$file_name);
                echo '<script>alert("Successfully Moved")</script>';
                echo '<script>window.location = "filesystem.php"</script>';
            } else{
                echo '<script>alert("Failed To Move")</script>';
                echo '<script>window.location = "filesystem.php"</script>';
            }

        } else {
            echo 'alert("Not Successfully Copied")';
            echo '<script>window.location = "filesystem.php"</script>';
        }
    } else {
        echo "alert('File Does not Exist')";
        echo '<script>window.location = "filesystem.php"</script>';
    }


}