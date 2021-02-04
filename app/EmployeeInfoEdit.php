<?php
    include_once "Employee.php";

    if(isset($_POST["id"])){

        $data1 = new Employee();

        $userId = $_POST["id"];
        $info1 = $data1->pickEmployeeInfo($userId);
        $user = $info1->fetch_object();
    }

?>

<form action="" method="POST">
    <div class="modal-body"  id="edit_info">
        <div class="form-group">
            <label for="email">Employee Name:</label>
            <input type="hidden" class="form-control" id="emp_id" name="emp_id" value="<?= $user->id ?>">
            <input type="text" class="form-control" id="employee_name" placeholder="Enter Employee Name" name="employee_name" value="<?= $user->employee_name ?>">
        </div>
        <div class="form-group">
            <label for="pwd">Employee Age:</label>
            <input type="number" class="form-control" id="employee_age" placeholder="Enter Employee Age" name="employee_age" value="<?= $user->employee_age ?>">
        </div>
        <div class="form-group">
            <label for="pwd">Employee Contact:</label>
            <input type="text" class="form-control" id="employee_contact" placeholder="Enter Employee Contact Mobile. Start with 880" name="employee_contact" value="<?= $user->employee_contact ?>">
        </div>
        <div class="form-group">
            <label for="employee_email">Employee Email:</label>
            <input type="email" class="form-control" id="employee_email" placeholder="Enter Employee Email Id" name="employee_email" value="<?= $user->employee_email ?>">
        </div>
        <div class="form-group">
            <label for="employee_password">Password:</label>
            <input type="password" class="form-control" id="employee_password" placeholder="Enter Password" name="employee_password" value="<?= $user->employee_password ?>">
        </div>
        <div class="form-group">
            <label for="pwd">Employee Experience:</label>
            <input type="number" class="form-control" id="employee_experience" placeholder="Enter Experience using Number" name="employee_experience" value="<?= $user->employee_experience ?>">
        </div>
        <div class="form-group">
            <label for="pwd">Employee Salary:</label>
            <input type="number" class="form-control" id="employee_salary" placeholder="Enter Salary Value" name="employee_salary" value="<?= $user->employee_salary ?>">
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" name="update_info" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>


