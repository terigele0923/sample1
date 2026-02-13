<?php
require_once '../core/Database.php';

class Employee
{
    public function all()
    {
        $db=Database::connect();
        return $db->query("SELECT * FROM employees")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByUserName($user_name)
    {
        $db=Database::connect();
        $st=$db->prepare("SELECT * FROM employees WHERE user_name=?");
        $st->execute([$user_name]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }
    public function findById($id)
    {
        $db=Database::connect();
        $st=$db->prepare("SELECT * FROM employees WHERE id=?");
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function create($user_name,$password,$email)
    {
        $db=Database::connect();
        $db->beginTransaction();
        try {
            $st=$db->prepare("INSERT INTO employees(user_name,password,email) VALUES(?,?,?)");
            $st->execute([$user_name,$password,$email]);
            $employeeId = (int)$db->lastInsertId();

            $this->ensureEmployeeInfo($db, $employeeId);
            $this->ensureEmployeeSkills($db, $employeeId);

            $db->commit();
            return $employeeId;
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }

    public function update($id,$user_name,$password,$email)
    {
        $db=Database::connect();
        $st=$db->prepare("UPDATE employees SET user_name=?,password=?,email=? WHERE id=?");
        $st->execute([$user_name,$password,$email,$id]);
    }

    public function delete($id)
    {
        $db=Database::connect();
        $st=$db->prepare("DELETE FROM employees WHERE id=?");
        $st->execute([$id]);
    }

    public function addEmployeeInfo($employeeId)
    {
        $db=Database::connect();
        $this->ensureEmployeeInfo($db, $employeeId);
    }

    public function addEmployeeSkills($employeeId)
    {
        $db=Database::connect();
        $this->ensureEmployeeSkills($db, $employeeId);
    }

    public function saveEmployeeInfo($employeeId, $address, $phone, $age, $hobby, $joinDate, $moveDate, $department, $position)
    {
        $db=Database::connect();
        $existsSt=$db->prepare("SELECT 1 FROM employees_info WHERE employee_id=?");
        $existsSt->execute([$employeeId]);
        if ($existsSt->fetchColumn()) {
            $st=$db->prepare(
                "UPDATE employees_info
                 SET address=?, phone=?, age=?, hobby=?, join_date=?, move_date=?, department=?, position=?
                 WHERE employee_id=?"
            );
            $st->execute([$address, $phone, $age, $hobby, $joinDate, $moveDate, $department, $position, $employeeId]);
            return;
        }

        $st=$db->prepare(
            "INSERT INTO employees_info (employee_id,address,phone,age,hobby,join_date,move_date,department,position)
             VALUES (?,?,?,?,?,?,?,?,?)"
        );
        $st->execute([$employeeId, $address, $phone, $age, $hobby, $joinDate, $moveDate, $department, $position]);
    }

    public function addEmployeeSkill($employeeId, $experience, $skill, $certification, $workHistory, $createdAt)
    {
        $db=Database::connect();
        $st=$db->prepare(
            "INSERT INTO employees_skills (employee_id, experience, skill, certification, work_history, created_at)
             VALUES (?,?,?,?,?,?)"
        );
        $st->execute([$employeeId, $experience, $skill, $certification, $workHistory, $createdAt]);
    }

    public function getEmployeeSkills($employeeId)
    {
        $db=Database::connect();
        $st=$db->prepare(
            "SELECT e.id, e.user_name,
                    s.experience, s.skill, s.certification, s.work_history, s.created_at
             FROM employees e
             LEFT JOIN employees_skills s ON e.id = s.employee_id
             WHERE e.id=?
             ORDER BY s.id DESC
             LIMIT 1"
        );
        $st->execute([$employeeId]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function getEmployeeInfo($employeeId)
    {
        $db=Database::connect();
        $st=$db->prepare(
            "SELECT e.id, e.user_name, e.email,
                    i.address, i.phone, i.age, i.hobby, i.join_date, i.move_date, i.department, i.position
             FROM employees e
             LEFT JOIN employees_info i ON e.id = i.employee_id
             WHERE e.id=?"
        );
        $st->execute([$employeeId]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    private function ensureEmployeeInfo($db, $employeeId)
    {
        $st=$db->prepare(
            "INSERT INTO employees_info (employee_id)
             SELECT ? WHERE NOT EXISTS (SELECT 1 FROM employees_info WHERE employee_id=?)"
        );
        $st->execute([$employeeId, $employeeId]);
    }

    private function ensureEmployeeSkills($db, $employeeId)
    {
        $st=$db->prepare(
            "INSERT INTO employees_skills (employee_id)
             SELECT ? WHERE NOT EXISTS (SELECT 1 FROM employees_skills WHERE employee_id=?)"
        );
        $st->execute([$employeeId, $employeeId]);
    }
}
