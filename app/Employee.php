<?php
include 'EmployeeQueryController.php';

class Employee
{
    public function __construct()
    {
        $this->data = new EmployeeQueryController();
    }

    public function userCheck()
    {
        $this->data->checkUsers();
    }

    public function login_process($employee_email,$employee_password)
    {
        return $this->data->login_check($employee_email,$employee_password);
    }

    public function saveEmployeeInfo($employee_name,$employee_age,$employee_contact,$employee_email,$employee_password,$employee_experience,$employee_salary)
    {
        $this->data->saveInfo($employee_name,$employee_age,$employee_contact,$employee_email,$employee_password,$employee_experience,$employee_salary);
    }

    public function allEmployeeInfo()
    {
        return $this->data->getData();
    }

    public function pickEmployeeInfo($id)
    {
        return $this->data->getEmployeeInfo($id);
    }

    public function updateEmployeeInfo($employee_id, $employee_name,$employee_age,$employee_contact,$employee_email,$employee_password,$employee_experience,$employee_salary)
    {
        $this->data->updateInformation($employee_id, $employee_name,$employee_age,$employee_contact,$employee_email,$employee_password,$employee_experience,$employee_salary);
    }

    public function deleteEmployeeInfo($employee_id)
    {
        $this->data->deleteInformation($employee_id);
    }

    public function searchEmployeeInfo($search_info)
    {
        return $this->data->searchedEmployeeInfo($search_info);
    }

    public function sortEmployeeData($filter_data)
    {
        return $this->data->sortedEmployeeData($filter_data);
    }
}