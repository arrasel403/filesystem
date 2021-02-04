<?php
session_start();
$userId = $_SESSION['user'];

//return to login if not logged in
if (!isset($_SESSION['user'])){
    header('location:login.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home | Employee Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Employee Database</a>
        </div>
        <ul class="nav navbar-nav">
            <?php if (isset($_SESSION['user'])) { ?>
                <li><a href="index.php">Home</a></li>
                <li><a href="allemployee.php">Employee</a></li>
                <li class="active"><a href="filesystem.php">FileSystem</a></li>
            <?php } ?>
            <!--            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>-->
            <!--                <ul class="dropdown-menu">-->
            <!--                    <li><a href="#">Page 1-1</a></li>-->
            <!--                    <li><a href="#">Page 1-2</a></li>-->
            <!--                    <li><a href="#">Page 1-3</a></li>-->
            <!--                </ul>-->
            <!--            </li>-->
            <!--            <li><a href="#">Page 2</a></li>-->
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION['user'])) { ?>
                <li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
            <?php } else { ?>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>


<div class="container">

    <nav class="nav">
        <div class="container-fluid">
            <div class="navbar-header">
                <h4 style="text-transform: uppercase; color: dodgerblue;">FileSystem</h4>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><button type="button" name="create_folder" id="create_folder" class="btn btn-success">Create New Folder</button></li>
            </ul>
        </div>
    </nav>

    <div>
        <div id="folder_table" class="table table-responsive">
        </div>
    </div>

</div>

</body>
</html>

<!-- Folder Create and Update Modal -->
<div class="modal fade" id="folderModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Add New Folder</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>Enter Folder Name
                    <input type="text" name="folder_name" id="folder_name" class="form-control" /></p>
                <br>
                <input type="hidden" name="action" id="action" />
                <input type="hidden" name="old_name" id="old_name" />
            </div>
            <div class="modal-footer">
                <input type="button" name="folder_button" id="folder_button" class="btn btn-info" value="Create" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- File Upload Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times</button>
                <h4 class="modal-title"><span id="change_title">Upload File</span></h4>
            </div>
            <form method="post" id="upload_form" class="form-inline" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Image</label>
                        <input type="file" class="form-control" name="upload_file">
                    </div>
                    <br>
                    <input type="hidden" name="hidden_folder_name" id="hidden_folder_name">
                    <input type="hidden" name="uploadby" id="uploadby" value="<?= $userId ?>">
<!--                    <input type="submit" name="upload_button" class="btn btn-info" value="Upload">-->

                </div>
                <div class="modal-footer">
                    <input type="submit" name="upload_button" class="btn btn-info" value="Upload" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--  File List  -->
<div id="filelistModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times</button>
                <h4 class="modal-title"><span id="change_title">File List</span></h4>
            </div>
            <div class="modal-body" id="file_list">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--  File Move to another Folder  -->
<div class="modal fade" id="moveFile">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Move File to Another Folder
                    <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
            </div>
<!--            <form method="post" action="file_move_action.php" id="move_file_form" enctype="multipart/form-data">-->
<!--            <form method="post" action="" enctype="multipart/form-data">-->
                <div class="modal-body"  id="move_file">
                </div>
        </div>
    </div>
</div>


    <script>
    $(document).ready(function(){
        load_folder_list();

        // All Folder List
        function load_folder_list(){
            var action = "fetch";
            $.ajax({
                url: "all_file_action.php",
                method: "POST",
                data: {action:action},
                success:function(data){
                    $('#folder_table').html(data);
                }
            });
        }

        // Create Folder
        $(document).on('click','#create_folder', function(){
            $('#action').val('create');
            $('#folder_name').val('');
            $('#folder_button').val('create');
            $('#old_name').val('');
            $('#change_title').text('Create Folder');
            $('#folderModal').modal('show');
        });

        $(document).on('click','#folder_button', function(){
            var folder_name = $('#folder_name').val();
            var action = $('#action').val();
            var old_name = $('#old_name').val();
            if(folder_name !== ''){
                $.ajax({
                    url: "file_system_action.php",
                    method: "POST",
                    data: {folder_name:folder_name, old_name:old_name, action:action},
                    success:function(data){
                        $('#folderModal').modal('hide');
                        load_folder_list();
                        alert(data);
                    }
                });
            } else{
                alert("Enter Folder Name");
            }
        });

        $(document).on('click', '.update', function(){
            var folder_name = $(this).data("name");
            $('#old_name').val(folder_name);
            $('#folder_name').val(folder_name);
            $('#action').val("change");
            $('#folder_button').val("Update");
            $('#change_title').text("Change Folder Name");
            $('#folderModal').modal("show");
        });

        // File Upload
        $(document).on('click', '.upload', function(){
            var folder_name = $(this).data("name");
            $('#hidden_folder_name').val(folder_name);
            $('#uploadModal').modal('show');
        });

        $('#upload_form').on('submit', function(){
            $.ajax({
                url: "file_upload.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    load_folder_list();
                    alert(data);
                }
            });
        });

        // View File List
        $(document).on('click', '.view_files', function () {
            var folder_name = $(this).data("name");
            var action = "fetch_files";
            $.ajax({
                url: "all_file_list.php",
                method: "POST",
                data: {folder_name:folder_name, action:action},
                success:function(data){
                    $('#folder_table').html(data);
                }
            });
        });

        // Remove File
        $(document).on('click', '.remove_file', function(){
            var file_id = $(this).attr("id");
            var action = "remove_file";
            if(confirm("Are you sure you want to remove this file?")){
                $.ajax({
                    url: "file_remove_action.php",
                    method: "POST",
                    data: {file_id:file_id, action:action},
                    success:function(data){
                        alert(data);
                        $('#filelistModal').modal('hide');
                        load_folder_list();
                    }
                });
            } else {
                return false;
            }
        });

        // Delete Folder
        $(document).on('click', '.delete', function(){
            var folder_name = $(this).data("name");
            var action = "delete_folder";
            if(confirm("Are you sure you want to remove this folder?")){
                $.ajax({
                    url: "file_remove_action.php",
                    method: "POST",
                    data: {folder_name:folder_name, action:action},
                    success:function(data){
                        load_folder_list();
                        alert(data);
                    }
                });
            }
        });

        // Move Folder
        $(document).on('click', '.move_file', function () {
            var file_id = $(this).attr("id");
            var action = "move_file";
            $.ajax({
                url: "file_move.php",
                method: "POST",
                data: {file_id:file_id, action:action},
                success:function (data) {
                    $('#move_file').html(data);
                    $('#moveFile').modal("show");
                }
            });
        });

        // $('#move_file_form').on('submit', function(){
        //     var file_id = $(this).data("name");
        //     var file_name = $(this).data("name");
        //     var select_folder = $(this).data("name");
        //     var modify_by = $(this).data("name");
        //     var action = "move_file_to";
        //
        //     $.ajax({
        //         url: "file_move_action.php",
        //         method: "POST",
        //         data: {file_id:file_id, file_name:file_name, select_folder:select_folder, modify_by:modify_by},
        //         data: new FormData(this),
        //         contentType: false,
        //         cache: false,
        //         processData: false,
        //         success:function(data){
        //             console.log(data);
        //             load_folder_list();
        //             alert(data);
        //         }
        //     });
        // });


    });
</script>

<?php } ?>