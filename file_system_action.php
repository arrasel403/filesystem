<?php

if (isset($_POST["action"])){

    $directory = "FileSystem";
    $folder_name = $_POST["folder_name"];
    $path = $directory . '/' . $folder_name;

    if($_POST["action"] == "create"){
        if(!file_exists($path)){
            mkdir($path, 0777, true);
            echo 'Folder Created';
        } else {
            echo 'Folder Already Created';
        }
    }

    if ($_POST["action"] == "change"){
        if(!file_exists($path)){
            rename($directory.'/'.$_POST["old_name"], $directory.'/'.$_POST["folder_name"]);
            echo 'Folder Name Change';
        } else {
            echo 'Folder Already Created';
        }
    }

}
?>

