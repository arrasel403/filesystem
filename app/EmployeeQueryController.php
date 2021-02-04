<?php
include __DIR__ . '/../database/DBConnection.php';

class EmployeeQueryController extends DBConnection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkUsers()
    {
        $sql = ("SELECT * FROM users") or die(mysqli_error());
        $query = $this->con->query($sql);
        $row = $query->num_rows;
        if ($row == 0){
            $faker = \Faker\Factory::create();
            $name = $faker->name;
            $age = 20;
            $contact = $faker->phoneNumber;
            $email = 'admin@admin.com';
            $password = 123;
            $experience = 1;
            $salary = 100;

            $sql = "INSERT INTO users (`employee_name`, `employee_age`, `employee_contact`, `employee_email`, `employee_password`, `employee_experience`, `employee_salary`) VALUES('$name', '$age', '$contact', '$email', '$password', '$experience', '$salary')" or die(mysqli_error());
            $query = $this->con->query($sql);
        }

    }

    public function login_check($employee_email,$employee_password)
    {
        $employee_email = $employee_email;
        $employee_password  =$employee_password;

        $sql = ("SELECT * FROM users WHERE employee_email = '$employee_email' AND employee_password = '$employee_password' ") or die(mysqli_error());
        $query = $this->con->query($sql);
        $row1 = $query->num_rows;

        if($row1 > 0){
            $row = $query->fetch_assoc();
            return $row['id'];
        }
        else{
            //echo '<script>alert("Invalid username or password")</script>';
            return false;
        }
    }

    public function saveInfo($employee_name,$employee_age,$employee_contact,$employee_email,$employee_password,$employee_experience,$employee_salary)
    {
        $name = $employee_name;
        $age = $employee_age;
        $contact = $employee_contact;
        $email = $employee_email;
        $password = $employee_password;
        $experience = $employee_experience;
        $salary = $employee_salary;

        $sql = "INSERT INTO users (`employee_name`, `employee_age`, `employee_contact`, `employee_email`, `employee_password`, `employee_experience`, `employee_salary`) VALUES('$name', '$age', '$contact', '$email', '$password', '$experience', '$salary')" or die(mysqli_error());
        $query = $this->con->query($sql);
        if($query){
            echo '<script>alert("Successfully Employee Record Added")</script>';
            echo '<script>window.location = "allemployee.php"</script>';
        }
    }

    public function getData(){
        $sql = "SELECT * FROM users";
        $query = $this->con->query($sql);

        return $query;
    }

    public function getEmployeeInfo($id)
    {
        $sql = "SELECT * FROM users WHERE `id` = '$id' ";
        $query = $this->con->query($sql);

        return $query;
    }

    public function updateInformation($employee_id, $employee_name,$employee_age,$employee_contact,$employee_email,$employee_password,$employee_experience,$employee_salary)
    {
        $id = $employee_id;
        $name = $employee_name;
        $age = $employee_age;
        $contact = $employee_contact;
        $email = $employee_email;
        $password = $employee_password;
        $experience = $employee_experience;
        $salary = $employee_salary;

        $sql = ("UPDATE users SET `id` = '$id', `employee_name` = '$name', `employee_age` ='$age', `employee_contact` = '$contact', `employee_email` = '$email', `employee_password` = '$password', `employee_experience` = '$experience', `employee_salary` = '$salary' WHERE `id` = '$id' ") or die(mysqli_error());
        $query = $this->con->query($sql);

        if($query){
            echo '<script>alert("Successfully Employee Record Updated")</script>';
            echo '<script>window.location = "allemployee.php"</script>';
        }
    }

    public function deleteInformation($employee_id)
    {
        $id = $employee_id;

        $sql = ("DELETE FROM users WHERE `id` = '$id' ") or die(mysqli_error());
        $query = $this->con->query($sql);

        if($query){
            echo '<script>alert("Successfully Employee Record Deleted")</script>';
            echo '<script>window.location = "allemployee.php"</script>';
        }
    }

    public function searchedEmployeeInfo($search_info)
    {
        $search = $search_info;
        $sql = ("SELECT * FROM users WHERE `employee_name` LIKE '%".$search."%' OR `employee_contact` LIKE '%".$search."%' ") or die(mysqli_error());
        $query = $this->con->query($sql);

        if($query){
            $result = $query->fetch_object();
            return $result;
        }
    }

    public function sortedEmployeeData($filter_data)
    {
        $filter_data = $filter_data;
        $sql = ("SELECT * FROM users ORDER BY $filter_data DESC ") or die(mysqli_error());
        $query = $this->con->query($sql);

        if ($query){
            return $query;
        }
    }
}