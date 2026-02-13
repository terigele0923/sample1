<?php
$title = 'Employee Skills';
require __DIR__ . '/../partials/head.php';
$selectedEmployeeId = $selectedEmployeeId ?? '';
$selectedEmployeeName = $selectedEmployeeName ?? '';
$employeeIdParam = $selectedEmployeeId !== '' ? '&employee_id=' . urlencode((string)$selectedEmployeeId) : '';
?>
<h1>従業員スキル</h1>

<?php if ($selectedEmployeeId === ''): ?>
    <p>社員一覧で従業員を選択してから表示してください。</p>
    <p><a class="create-btn" href="?controller=Employee&action=index&token=<?= urlencode(Auth::token()) ?>">社員一覧へ戻る</a></p>
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
    <a class="create-btn" href="?controller=Employee&action=skillsCreate<?= $employeeIdParam ?>&token=<?= urlencode(Auth::token()) ?>">従業員スキル登録へ</a>
</p>
<?php require __DIR__ . '/../partials/foot.php'; ?>