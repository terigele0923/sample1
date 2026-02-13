<?php
require_once '../app/Models/Employee.php';
require_once '../core/Auth.php';

class EmployeeController
{
    public function index()
    {
        $m=new Employee();
        $employees=$m->all();
        require '../app/Views/employee/index.php';
    }

    public function create()
    {
        require '../app/Views/employee/create.php';
    }

    public function store()
    {
        $m=new Employee();
        $m->create($_POST['user_name'],$_POST['password'],$_POST['email']);
        header("Location:?controller=Employee&action=index&token=" . urlencode(Auth::token()));
        exit;
    }

    public function edit()
    {
        $m=new Employee();
        $employee=$m->findById($_POST['id']);
        require '../app/Views/employee/edit.php';
    }

    public function update()
    {
        $m=new Employee();
        $m->update($_POST['id'],$_POST['user_name'],$_POST['password'],$_POST['email']);
        header("Location:?controller=Employee&action=index&token=" . urlencode(Auth::token()));
        exit;
    }

    public function delete()
    {
        $m=new Employee();
        $m->delete($_POST['id']);
        header("Location:?controller=Employee&action=index&token=" . urlencode(Auth::token()));
        exit;
    }

    public function infoCreate()
    {
        $m=new Employee();
        $employeeId = $_POST['employee_id'] ?? ($_GET['employee_id'] ?? '');
        if (is_array($employeeId)) {
            $employeeId = $employeeId[0] ?? '';
        }
        $selectedEmployeeId = $employeeId;
        $selectedEmployeeName = '';
        if ($selectedEmployeeId !== '') {
            $employee = $m->findById($selectedEmployeeId);
            $selectedEmployeeName = $employee['user_name'] ?? '';
        }
        require '../app/Views/employee/info_create.php';
    }

    public function infoStore()
    {
        $m=new Employee();
        $m->saveEmployeeInfo(
            $_POST['employee_id'],
            $_POST['address'] ?? '',
            $_POST['phone'] ?? '',
            $_POST['age'] ?? null,
            $_POST['hobby'] ?? '',
            $_POST['join_date'] ?? null,
            $_POST['move_date'] ?? null,
            $_POST['department'] ?? '',
            $_POST['position'] ?? ''
        );
        header("Location:?controller=Employee&action=infoShow&employee_id=" . urlencode((string)$_POST['employee_id']) . "&token=" . urlencode(Auth::token()));
        exit;
    }

    public function skillsCreate()
    {
        $m=new Employee();
        $employeeId = $_POST['employee_id'] ?? ($_GET['employee_id'] ?? '');
        if (is_array($employeeId)) {
            $employeeId = $employeeId[0] ?? '';
        }
        $selectedEmployeeId = $employeeId;
        $selectedEmployeeName = '';
        if ($selectedEmployeeId !== '') {
            $employee = $m->findById($selectedEmployeeId);
            $selectedEmployeeName = $employee['user_name'] ?? '';
        }
        require '../app/Views/employee/skills_create.php';
    }

    public function skillsStore()
    {
        $m=new Employee();
        $skills = $_POST['skill'] ?? [];
        $certs = $_POST['certification'] ?? [];

        if (!is_array($skills)) {
            $skills = [$skills];
        }
        if (!is_array($certs)) {
            $certs = [$certs];
        }

        $skills = array_filter(array_map('trim', $skills), static fn($v) => $v !== '');
        $certs = array_filter(array_map('trim', $certs), static fn($v) => $v !== '');

        $skillText = implode(',', $skills);
        $certText = implode(',', $certs);

        $m->addEmployeeSkill(
            $_POST['employee_id'],
            $_POST['years_experience'] ?? null,
            $skillText,
            $certText,
            $_POST['industry_history'] ?? '',
            $_POST['registered_at'] ?? null
        );
        header("Location:?controller=Employee&action=skillsShow&employee_id=" . urlencode((string)$_POST['employee_id']) . "&token=" . urlencode(Auth::token()));
        exit;
    }

    public function infoShow()
    {
        $m=new Employee();
        $employeeId = $_POST['employee_id'] ?? ($_GET['employee_id'] ?? '');
        if (is_array($employeeId)) {
            $employeeId = $employeeId[0] ?? '';
        }
        $selectedEmployeeId = $employeeId;
        $selectedEmployeeName = '';
        $employeeInfo = null;
        if ($selectedEmployeeId !== '') {
            $employee = $m->findById($selectedEmployeeId);
            $selectedEmployeeName = $employee['user_name'] ?? '';
            $employeeInfo = $m->getEmployeeInfo($selectedEmployeeId);
        }
        require '../app/Views/employee/info_show.php';
    }

    public function skillsShow()
    {
        $m=new Employee();
        $employeeId = $_POST['employee_id'] ?? ($_GET['employee_id'] ?? '');
        if (is_array($employeeId)) {
            $employeeId = $employeeId[0] ?? '';
        }
        $selectedEmployeeId = $employeeId;
        $selectedEmployeeName = '';
        $employeeSkills = null;
        if ($selectedEmployeeId !== '') {
            $employee = $m->findById($selectedEmployeeId);
            $selectedEmployeeName = $employee['user_name'] ?? '';
            $employeeSkills = $m->getEmployeeSkills($selectedEmployeeId);
        }
        require '../app/Views/employee/skills_show.php';
    }
}