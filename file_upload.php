<?php
include 'vendor/autoload.php';
$data1 = new FileQueryController();

if($_FILES["upload_file"]["name"] != ''){

    $directory = "FileSystem";
    $user_Id = $_POST["uploadby"];

    $info = $data1->findUserById($user_Id);
    $id = $info->fetch_object();
    $uploadBy = $id->employee_name;

    $data = explode(".", $_FILES["upload_file"]["name"]);
    $extension = $data[1];
    $allowed_extension = array('jpg','png','jpeg','gif','pdf');

    if(in_array($extension, $allowed_extension)){

        $new_file_name = rand(). '.' . $extension;
        $path = $directory.'/'.$_POST["hidden_folder_name"];
        $fullPath = $path . '/' . $new_file_name;

        if(move_uploaded_file($_FILES["upload_file"]["tmp_name"], $fullPath)){

//            $sql = "INSERT INTO files (`filename`, `location`, `uploadby`) VALUES('$new_file_name', '$path', '$userId')" or die(mysqli_error());
//            $query = $data1->con->query($sql);

            $result = $data1->saveFileInfo($new_file_name, $path, $uploadBy);

            if ($result){
                echo 'The file has been uploaded successfully.';
            } else {
                echo 'File upload failed, please try again.';
            }

        } else {
            echo 'Sorry, there was an error uploading your file.';
        }

    } else {
        echo 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}
else{
    echo 'Please select a file to upload.';
}

