<?php

    session_start();

    include "vendor/autoload.php";

    //$data = new \Crud\App\Employee();

    $data = new Employee();

    if(isset($_REQUEST['submit'])){
        $employee_name = $_POST["employee_name"];
        $employee_age = $_POST["employee_age"];
        $employee_contact = $_POST["employee_contact"];
        $employee_email = $_POST["employee_email"];
        $employee_password = $_POST["employee_password"];
        $employee_experience = $_POST["employee_experience"];
        $employee_salary = $_POST["employee_salary"];

        $data->saveEmployeeInfo($employee_name,$employee_age,$employee_contact,$employee_email,$employee_password,$employee_experience,$employee_salary);
    }

    if(isset($_POST['update_info'])){
        $employee_id = $_POST["emp_id"];
        $employee_name = $_POST["employee_name"];
        $employee_age = $_POST["employee_age"];
        $employee_contact = $_POST["employee_contact"];
        $employee_email = $_POST["employee_email"];
        $employee_password = $_POST["employee_password"];
        $employee_experience = $_POST["employee_experience"];
        $employee_salary = $_POST["employee_salary"];

        $data->updateEmployeeInfo($employee_id, $employee_name,$employee_age,$employee_contact,$employee_email,$employee_password,$employee_experience,$employee_salary);
    }

    if(isset($_GET['employee_id'])) {
        $employee_id = $_GET['employee_id'];

        $data->deleteEmployeeInfo($employee_id);
    }

    $allInfo = $data->allEmployeeInfo();
    $sn = 1;

    //return to login if not logged in
    if (!isset($_SESSION['user'])){
        header('location:login.php');
    } else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee | Employee Database</title>
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
                <li class="active"><a href="employee.php">Employee</a></li>
                <li><a href="filesystem.php">FileSystem</a></li>
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
    <!--    <h2 style="text-align: center; text-transform: uppercase; text-decoration: underline darkblue;">Class Work</h2>-->
    <nav class="nav">
        <div class="container-fluid">
            <div class="navbar-header">
                <h4 style="text-transform: uppercase; color: dodgerblue;">Employee Information</h4>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addInfo">Add New Employee</button></li>
            </ul>
        </div>
    </nav>
    <div>
        <table class="table table-bordered" >
            <tbody style="text-align: center;">
            <tr>
                <td colspan="3">
                    <form action="app/EmployeeSearch.php" method="post" name="search_employee_info">
                        <div class="form-group" style="vertical-align: middle;">
                            <button style="pointer-events: none;" class="btn btn-primary">Search</button>
                            <input type="text" name="search_text" id="search_text" placeholder="Search by Name|Contact" style="outline: none; border-radius: 2px; border: 1px solid #17a2b8; height: 30px;">
                            <!--                                <button type="submit" class="btn btn-info" name="search_submit" onClick="return GetSearchItem();">Search</button>-->
                        </div>
                    </form>
                </td>
                <td colspan="4">
                    <form action="" method="post">
                        Sorted by:
                        <!--                            <button type="submit" class="btn btn-info" name="search_submit">Age</button>-->
                        <!--                            <button type="submit" class="btn btn-info" name="search_submit">Experience</button>-->
                        <!--                            <button type="submit" class="btn btn-info" name="search_submit">Salary</button> &nbsp;&nbsp;-->

                        <select name="filter_data" id="filter_data" style="outline: none; border-radius: 2px; border: 1px solid #17a2b8; padding: 5px;">
                            <option value="">Select Option</option>
                            <option value="employee_age">Age</option>
                            <option value="employee_salary">Salary</option>
                            <option value="employee_experience">Experience</option>
                        </select>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div>
        <table class="table table-bordered" id="search_result" style="text-align: center;">
            <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Age</th>
                <th>Contact No</th>
                <th>Email</th>
                <th>Password</th>
                <th>Experience</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="all_employee_info">
            <?php while ($user = $allInfo->fetch_object()): ?>
                <tr>
                    <td><?= $sn++ ?></td>
                    <td><?= $user->employee_name ?></td>
                    <td><?= $user->employee_age ?></td>
                    <td><?= $user->employee_contact ?></td>
                    <td><?= $user->employee_email ?></td>
                    <td><?= $user->employee_password ?></td>
                    <td><?= $user->employee_experience ?></td>
                    <td><?= $user->employee_salary ?></td>
                    <td>
                        <input type="button" name="edit" id="<?= $user->id ?>" class="btn btn-primary edit_information" data-toggle="modal" data-target="#myEditModal" value="Edit">
                        <button type="button" name="delete" id="<?= $user->id ?>" class="btn btn-danger delete" data-toggle = "modal" data-target = "#Delete_record" value="">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>

            <tbody id="searched_result">

            </tbody>

            <tbody id="filtered_result">

            </tbody>
        </table>
    </div>
</div>

<!-- Add Information -->
<div class="modal fade" id="addInfo">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">New Employee Add Form</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="employee_name">Employee Name:</label>
                        <input type="text" class="form-control" id="employee_name" placeholder="Enter Employee Name" name="employee_name">
                    </div>
                    <div class="form-group">
                        <label for="employee_age">Employee Age:</label>
                        <input type="number" class="form-control" id="employee_age" placeholder="Enter Employee Age" name="employee_age">
                    </div>
                    <div class="form-group">
                        <label for="employee_contact">Employee Contact:</label>
                        <input type="text" class="form-control" id="employee_contact" placeholder="Enter Employee Contact Mobile. Start with 880" name="employee_contact">
                    </div>
                    <div class="form-group">
                        <label for="employee_email">Employee Email:</label>
                        <input type="email" class="form-control" id="employee_email" placeholder="Enter Employee Email Id" name="employee_email">
                    </div>
                    <div class="form-group">
                        <label for="employee_password">Password:</label>
                        <input type="password" class="form-control" id="employee_password" placeholder="Enter Password" name="employee_password">
                    </div>
                    <div class="form-group">
                        <label for="employee_experience">Employee Experience:</label>
                        <input type="number" class="form-control" id="employee_experience" placeholder="Enter Experience using Number" name="employee_experience">
                    </div>
                    <div class="form-group">
                        <label for="employee_salary">Employee Salary:</label>
                        <input type="number" class="form-control" id="employee_salary" placeholder="Enter Salary Value" name="employee_salary">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Edit Employee Information-->
<div class="modal fade" id="myEditModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Edit Employee Information Form</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body"  id="edit_info">
            </div>
        </div>
    </div>
</div>

<!--Delete Information-->
<div class="modal fade" id="Delete_record" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <center><label class = "text-danger">Are you sure you want to delete this record?</label></center>
                <br />
                <center><a class = "btn btn-danger remove_id" ><span class = "glyphicon glyphicon-trash"></span> Yes</a> <button type = "button" class = "btn btn-warning" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // Edit Employee Information
        $('.edit_information').click(function () {
            var id = $(this).attr("id");
            console.log(id);
            $.ajax({
                url: "app/EmployeeInfoEdit.php",
                method: "post",
                data: {id: id},
                success: function (data) {
                    $('#edit_info').html(data);
                    $('#myEditModal').modal("show");
                }
            });
        });

        // Delete Employee Information
        $('.delete').click(function(){
            var $employee_id = $(this).attr('id');
            $('.remove_id').click(function(){
                window.location = '?employee_id=' + $employee_id;
            });
        });

        // Searching Employee Information
        $('#search_text').keyup(function (){
            var search_info = $(this).val();
            console.log(search_info);
            if (search_info == "") {
                console.log("Blank");
                $('#all_employee_info').show();
                $('#searched_result').hide();
                $('#filtered_result').hide();

            }
            else {
                $('#all_employee_info').hide();
                $('#filtered_result').hide();
                console.log(search_info);
                $.ajax({
                    url: "app/SearchEmployeeInfo.php",
                    method: "post",
                    data: {search_info: search_info},
                    success: function (data) {
                        $('#searched_result').html(data);
                        $('#searched_result').show();
                    }
                });
            }

        });

        // Sorting Employee Information
        $('#filter_data').change(function () {
            var filter_data = $(this).val();
            console.log(filter_data);
            if (filter_data == "") {
                console.log("Blank");
                $('#all_employee_info').show();
                $('#searched_result').hide();
                $('#filtered_result').hide();

            }
            else {
                $('#all_employee_info').hide();
                $('#searched_result').hide();
                console.log(filter_data);
                $.ajax({
                    url: "app/SortEmployeeInfo.php",
                    method: "post",
                    data: {filter_data: filter_data},
                    success: function (data) {
                        $('#filtered_result').html(data);
                        $('#filtered_result').show();
                    }
                });
            }
        });
    });
</script>

</body>
</html>

<?php } ?>