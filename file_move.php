<?php
session_start();
$userId = $_SESSION['user'];

include 'vendor/autoload.php';

$data = new FileQueryController();

if ($_POST["action"] == "move_file"){

    $directory = "FileSystem/";
    $folder = array_filter(glob($directory.'*'), 'is_dir');
    $fileId = $_POST["file_id"];
    $info1 = $data->pickFileInfo($fileId);
    $fileInfo = $info1->fetch_object();
}
?>
<form method="post" action="file_move_action.php" id="move_file_form" enctype="multipart/form-data">
    <div class="form-group">
        <label for="file_name">File Name:</label>
        <input type="hidden" class="form-control" id="file_id" name="file_id" value="<?= $fileInfo->id; ?>">
        <input type="text" class="form-control" id="file_name" name="file_name" value="<?= $fileInfo->filename; ?>">
    </div>
    <div class="form-group">
        <label for="select_folder">Select Folder:</label>
        <select class="form-control" id="select_folder" name="select_folder">
            <?php foreach($folder as $name){ ?>
                <option value="<?= ltrim($name,$directory) ?>"><?= ltrim($name,$directory) ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" id="old_folder_name" name="old_folder_name" value="<?= ltrim($fileInfo->location, $directory); ?>">
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" id="modify_by" name="modify_by" value="<?= $userId; ?>">
    </div>
    <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-info">Move File</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</form>