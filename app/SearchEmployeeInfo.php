<?php
    include 'Employee.php';

    if (isset($_POST['search_info'])){
        $data1 = new Employee();
        $search_info = $_POST["search_info"];
        $user = $data1->searchEmployeeInfo($search_info);
    }
    $sn = 1;
?>

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
