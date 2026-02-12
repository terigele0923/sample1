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
        $m->create($_POST['name'],$_POST['password'],$_POST['email']);
        header("Location:?controller=Employee&action=index&token=" . urlencode(Auth::token()));
    }

    public function edit()
    {
        $m=new Employee();
        $employee=$m->find($_POST['id']);
        require '../app/Views/employee/edit.php';
    }

    public function update()
    {
        $m=new Employee();
        $m->update($_POST['id'],$_POST['name'],$_POST['password'],$_POST['email']);
        header("Location:?controller=Employee&action=index&token=" . urlencode(Auth::token()));
    }

    public function delete()
    {
        $m=new Employee();
        $m->delete($_POST['id']);
        header("Location:?controller=Employee&action=index&token=" . urlencode(Auth::token()));
    }
}
