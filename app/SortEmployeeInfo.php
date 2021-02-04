<?php

    include 'Employee.php';

    if (isset($_POST['filter_data'])){
        $data1 = new Employee();

        $filter_data = $_POST['filter_data'];
        $gotData = $data1->sortEmployeeData($filter_data);
    }
    $sn = 1;
?>

<?php while ($user = $gotData->fetch_object()): ?>
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
