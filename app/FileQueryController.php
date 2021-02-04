<?php
include __DIR__ . '/../database/DBConnection.php';


class FileQueryController extends DBConnection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findUserById($user_Id)
    {
        $sql = "SELECT employee_name FROM users WHERE `id` = '$user_Id'";
        $query = $this->con->query($sql);

        return $query;
    }

    public function saveFileInfo($new_file_name, $path, $uploadBy)
    {
        $file_name = $new_file_name;
        $path = $path;
        $uploadBy = $uploadBy;

        $sql = "INSERT INTO files (`filename`, `location`, `uploadby`) VALUES('$file_name', '$path', '$uploadBy')" or die(mysqli_error());
        $query = $this->con->query($sql);
        if ($query){
            return $query;
        }
//        return $query;
    }

    public function getAllFile($path)
    {
        $path = $path;
        $sql = "SELECT * FROM files WHERE `location` = '$path' ";
        $query = $this->con->query($sql);

        return $query;
    }

    public function pickFileInfo($fileId)
    {
        $sql = "SELECT * FROM files WHERE `id` = '$fileId' ";
        $query = $this->con->query($sql);

        return $query;
    }

    public function removeFile($file_id)
    {
        $sql = ("DELETE FROM files WHERE `id` = '$file_id' ") or die(mysqli_error());
        $query = $this->con->query($sql);

        if($query){
            echo 'File Successfully Deleted';
//            echo '<script>window.location = "filesystem.php"</script>';
        }
    }

    public function removeFolder($folder_path)
    {
        $sql = ("DELETE FROM files WHERE `location` = '$folder_path' ") or die(mysqli_error());
        $query = $this->con->query($sql);

        if($query){
            return true;
//            echo 'Folder Successfully Deleted';
//            echo '<script>window.location = "filesystem.php"</script>';
        }
    }

    public function moveFileTo($file_id,$file_name,$path,$modify_by)
    {
        $file_id = $file_id;
        $file_name = $file_name;
        $path = $path;
        $modify_by = $modify_by;

        $sql = ("UPDATE files SET `location` = '$path', `modifiedby` = '$modify_by' WHERE `id` = '$file_id' and `filename` = '$file_name' ") or die(mysqli_error());
        $query = $this->con->query($sql);

        if ($query){
            return $query;
        }
    }

}