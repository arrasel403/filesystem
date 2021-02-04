<?php
if (isset($_POST["action"])){
    if ($_POST["action"] = "fetch"){
        $directory = "FileSystem/";
        $folder = array_filter(glob($directory.'*'), 'is_dir');
        $output = '
        <table class="table table-bordered">
                <tr>
                    <th>Folder Name</th>
                    <th>Total File</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Upload File</th>
                    <th>View Uploaded File</th>
                </tr>
        ';
        if(count($folder) > 0){

            foreach($folder as $name){
                $output .='
                <tr>
                    <td>'.ltrim($name, $directory).'</td>
                    <td>'.(count(scandir($name)) - 2).'</td>
                    <td><button type="button" name="update" data-name="'.ltrim($name, $directory).'" class="update btn btn-warning">Update</button></td>
                    <td><button type="button" name="delete" data-name="'.ltrim($name, $directory).'" class="delete btn btn-danger">Delete</button></td>
                    <td><button type="button" name="upload" data-name="'.ltrim($name, $directory).'" class="upload btn btn-info">Upload</button></td>
                    <td><button type="button" name="view_files" data-name="'.ltrim($name, $directory).'" class="view_files btn btn-primary">View Files</button></td>
                </tr>
                ';
            }

        } else {
            $output .='
            <tr>
                <td colspan="7">No Folder Found</td>
            </tr>
            ';
        }
        $output .='</table>';
        echo $output;
    }

}