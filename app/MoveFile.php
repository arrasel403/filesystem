<?php
include_once "../vendor/autoload.php";

if(isset($_POST["id"])){

    $directory = "FileSystem/";
    $folder = array_filter(glob($directory.'*'), 'is_dir');

    $data1 = new FileQueryController();

    $fileId = $_POST["id"];
    $info1 = $data1->pickFileInfo($userId);
    $fileInfo = $info1->fetch_object();
}
?>

<form action="" method="POST">
    <div class="modal-body"  id="edit_info">
        <div class="form-group">
            <label for="email">File Name:</label>
            <input type="hidden" class="form-control" id="emp_id" name="emp_id" value="<?= $fileInfo->id ?>">
            <input type="text" class="form-control" id="employee_name" placeholder="Enter Employee Name" name="employee_name" value="<?= $fileInfo->filename ?> disable ">
        </div>
        <div class="form-group">
            <label for="pwd">Folder Name:</label>
            <select class="form-control" id="employee_age" name="employee_age">
                <?php foreach ($folder as $name) { ?>
                <option value="<?= ltrim($name, $directory); ?>"><?= ltrim($name, $directory); ?></option>
                <? } ?>
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" name="move_file" class="btn btn-primary">Move</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>