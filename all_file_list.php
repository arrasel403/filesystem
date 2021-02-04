<?php
    include 'vendor/autoload.php';

    $data = new FileQueryController();

    if (isset($_POST["action"])){
        if ($_POST["action"] == "fetch_files"){

            $directory = "FileSystem/";
            $folder_name = $_POST["folder_name"];
            $path = $directory . $folder_name;
            
            $result = $data->getAllFile($path);
        }
    }

    $sn = 1;
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <td colspan="5" style="text-align: center"><h4>Folder Location: <?= $path; ?></h4></td>
            <td style="text-align: center"><a href="filesystem.php" class="btn btn-info">Go Back</a></td>
        </tr>
      <tr>
        <th>SN.</th>
        <th>File Name</th>
        <th>Folder Name</th>
        <th>UploadBy</th>
        <th>ModifiedBy</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php while ($fileinfo = $result->fetch_object()): ?>
      <tr>
        <td><?= $sn++; ?></td>
        <td><?= $fileinfo->filename; ?></td>
        <td><?= ltrim($fileinfo->location, $directory); ?></td>
        <td><?= $fileinfo->uploadby; ?></td>
        <td><?= $fileinfo->modifiedby; ?></td>
        <td>

            <button name="move_file" class="move_file btn btn-info" id="<?= $fileinfo->id ?>">Move File</button>
            <button name="remove_file" class="remove_file btn btn-danger" id="<?= $fileinfo->id; ?>">Remove</button>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
</table>