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
<h1>従業員情報登録</h1>

<?php if ($selectedEmployeeId === ''): ?>
<form method="GET" action="">
    <input type="hidden" name="controller" value="Employee">
    <input type="hidden" name="action" value="infoCreate">
    <input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
    <label>
        従業員ID
        <select name="employee_id">
            <?php foreach ($employees as $e): ?>
                <option value="<?= $e['id'] ?>"><?= $e['id'] ?>: <?= htmlspecialchars($e['user_name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <button class="create-btn" type="submit">次へ</button>
</form>
<?php else: ?>
<p>対象従業員: <?= htmlspecialchars($selectedEmployeeId) ?> <?= $selectedEmployeeName !== '' ? '(' . htmlspecialchars($selectedEmployeeName) . ')' : '' ?></p>
<form method="POST" action="?controller=Employee&action=infoStore">
    <input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
    <input type="hidden" name="employee_id" value="<?= htmlspecialchars($selectedEmployeeId) ?>">

    <label>住所 <input name="address"></label><br>
    <label>電話番号 <input name="phone" type="tel"></label><br>
    <label>年齢 <input name="age" type="number" min="0"></label><br>
    <label>趣味 <input name="hobby"></label><br>
    <label>入社日 <input name="join_date" type="date"></label><br>
    <label>移動日 <input name="move_date" type="date"></label><br>
    <label>部署 <input name="department"></label><br>
    <label>役職 <input name="position"></label><br>

    <button class="create-btn" type="submit">登録</button>
</form>
<?php endif; ?>
<?php require __DIR__ . '/../partials/foot.php'; ?>
