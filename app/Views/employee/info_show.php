<?php
$title = 'Employee Info';
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
<h1>従業員情報</h1>

<?php if ($selectedEmployeeId === ''): ?>
    <?php if (empty($employees)): ?>
        <p>従業員が登録されていません。</p>
    <?php else: ?>
        <form method="GET" action="">
            <input type="hidden" name="controller" value="Employee">
            <input type="hidden" name="action" value="infoShow">
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
    <a class="create-btn" href="?controller=Employee&action=infoCreate&token=<?= urlencode(Auth::token()) ?>">従業員情報登録へ</a>
</p>
<?php require __DIR__ . '/../partials/foot.php'; ?>