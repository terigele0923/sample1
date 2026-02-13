<?php
$title = 'Employee Skills';
require __DIR__ . '/../partials/head.php';
$selectedEmployeeId = $selectedEmployeeId ?? '';
$selectedEmployeeName = '';
foreach ($employees as $e) {
    if ((string)$e['id'] === (string)$selectedEmployeeId) {
        $selectedEmployeeName = $e['user_name'] ?? '';
        break;
    }
}
?>
<h1>従業員スキル</h1>

<?php if ($selectedEmployeeId === ''): ?>
    <?php if (empty($employees)): ?>
        <p>従業員が登録されていません。</p>
    <?php else: ?>
        <form method="GET" action="">
            <input type="hidden" name="controller" value="Employee">
            <input type="hidden" name="action" value="skillsShow">
            <input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
            <label>
                従業員ID
                <select name="employee_id">
                    <?php foreach ($employees as $e): ?>
                        <option value="<?= $e['id'] ?>"><?= $e['id'] ?>: <?= htmlspecialchars($e['user_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <button class="create-btn" type="submit">表示</button>
        </form>
    <?php endif; ?>
<?php elseif (empty($employeeSkills)): ?>
    <p>従業員スキルが見つかりません。</p>
<?php else: ?>
    <p>対象従業員: <?= htmlspecialchars($selectedEmployeeId) ?> <?= $selectedEmployeeName !== '' ? '(' . htmlspecialchars($selectedEmployeeName) . ')' : '' ?></p>
    <table class="index">
        <tr><th>ID</th><td><?= htmlspecialchars($employeeSkills['id']) ?></td></tr>
        <tr><th>ユーザー名</th><td><?= htmlspecialchars($employeeSkills['user_name']) ?></td></tr>
        <tr><th>経験年数</th><td><?= htmlspecialchars($employeeSkills['experience'] ?? '') ?></td></tr>
        <tr><th>スキル</th><td><?= htmlspecialchars($employeeSkills['skill'] ?? '') ?></td></tr>
        <tr><th>資格</th><td><?= htmlspecialchars($employeeSkills['certification'] ?? '') ?></td></tr>
        <tr><th>業界経歴</th><td><?= htmlspecialchars($employeeSkills['work_history'] ?? '') ?></td></tr>
        <tr><th>登録日</th><td><?= htmlspecialchars($employeeSkills['created_at'] ?? '') ?></td></tr>
    </table>
<?php endif; ?>

<p>
    <a class="create-btn" href="?controller=Employee&action=skillsCreate&token=<?= urlencode(Auth::token()) ?>">従業員スキル登録へ</a>
</p>
<?php require __DIR__ . '/../partials/foot.php'; ?>