<?php
$title = 'Employee Info';
require __DIR__ . '/../partials/head.php';
$selectedEmployeeId = $selectedEmployeeId ?? '';
$selectedEmployeeName = $selectedEmployeeName ?? '';
$employeeIdParam = $selectedEmployeeId !== '' ? '&employee_id=' . urlencode((string)$selectedEmployeeId) : '';
?>
<h1>従業員情報</h1>

<?php if ($selectedEmployeeId === ''): ?>
    <p>社員一覧で従業員を選択してから表示してください。</p>
    <p><a class="create-btn" href="?controller=Employee&action=index&token=<?= urlencode(Auth::token()) ?>">社員一覧へ戻る</a></p>
<?php elseif (empty($employeeInfo)): ?>
    <p>従業員情報が見つかりません。</p>
<?php else: ?>
    <p>対象従業員: <?= htmlspecialchars($selectedEmployeeId) ?> <?= $selectedEmployeeName !== '' ? '(' . htmlspecialchars($selectedEmployeeName) . ')' : '' ?></p>
    <table class="index">
        <tr><th>ID</th><td><?= htmlspecialchars($employeeInfo['id']) ?></td></tr>
        <tr><th>ユーザー名</th><td><?= htmlspecialchars($employeeInfo['user_name']) ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($employeeInfo['email'] ?? '') ?></td></tr>
        <tr><th>住所</th><td><?= htmlspecialchars($employeeInfo['address'] ?? '') ?></td></tr>
        <tr><th>電話番号</th><td><?= htmlspecialchars($employeeInfo['phone'] ?? '') ?></td></tr>
        <tr><th>年齢</th><td><?= htmlspecialchars($employeeInfo['age'] ?? '') ?></td></tr>
        <tr><th>趣味</th><td><?= htmlspecialchars($employeeInfo['hobby'] ?? '') ?></td></tr>
        <tr><th>入社日</th><td><?= htmlspecialchars($employeeInfo['join_date'] ?? '') ?></td></tr>
        <tr><th>異動日</th><td><?= htmlspecialchars($employeeInfo['move_date'] ?? '') ?></td></tr>
        <tr><th>部署</th><td><?= htmlspecialchars($employeeInfo['department'] ?? '') ?></td></tr>
        <tr><th>役職</th><td><?= htmlspecialchars($employeeInfo['position'] ?? '') ?></td></tr>
    </table>
<?php endif; ?>

<p>
    <a class="create-btn" href="?controller=Employee&action=infoCreate<?= $employeeIdParam ?>&token=<?= urlencode(Auth::token()) ?>">従業員情報登録へ</a>
</p>
<?php require __DIR__ . '/../partials/foot.php'; ?>