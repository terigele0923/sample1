<?php
require_once '../core/Database.php';

class Employee
{
    public function all()
    {
        $db=Database::connect();
        return $db->query("SELECT * FROM employees")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $db=Database::connect();
        $st=$db->prepare("SELECT * FROM employees WHERE id=?");
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function findByName($name)
    {
        $db=Database::connect();
        $st=$db->prepare("SELECT * FROM employees WHERE name=?");
        $st->execute([$name]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name,$password,$email)
    {
        $db=Database::connect();
        $st=$db->prepare("INSERT INTO employees(name,password,email) VALUES(?,?,?)");
        $st->execute([$name,$password,$email]);
    }

    public function update($id,$name,$password,$email)
    {
        $db=Database::connect();
        $st=$db->prepare("UPDATE employees SET name=?,password=?,email=? WHERE id=?");
        $st->execute([$name,$password,$email,$id]);
    }

    public function delete($id)
    {
        $db=Database::connect();
        $st=$db->prepare("DELETE FROM employees WHERE id=?");
        $st->execute([$id]);
    }
}
