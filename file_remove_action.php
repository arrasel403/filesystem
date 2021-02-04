<?php
include 'vendor/autoload.php';

$data = new FileQueryController();

if($_POST["action"] == "remove_file"){
    $file_id = $_POST["file_id"];
//    $user_Id = $_POST["deleteby"];


    $result = $data->pickFileInfo($file_id);
    $fileInfo = $result->fetch_object();
    $fileName = $fileInfo->filename;
    $fileLocation = $fileInfo->location;
    $path = $fileLocation . '/' . $fileName;
    unlink($path);

    $data->removeFile($file_id);
//    $data->removeFile($file_id,$deleteby);
}

if ($_POST["action"] == "delete_folder"){
    $directory = "FileSystem/";
    $folder_name = $_POST["folder_name"];
    $folder_path = $directory.$folder_name;
    $files = scandir($folder_path);
    foreach($files as $file){
        if($file == '.' || $file == '..'){
            continue;
        } else {
            $data->removeFolder($folder_path);
            unlink($folder_path . '/' . $file);
        }
    }
    if(rmdir($folder_path)){
        echo 'Folder Successfully Deleted';
    }
}

