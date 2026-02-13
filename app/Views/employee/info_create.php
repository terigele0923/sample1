<?php
$title = 'Employee Info';
require __DIR__ . '/../partials/head.php';
$selectedEmployeeId = $selectedEmployeeId ?? '';
$selectedEmployeeName = $selectedEmployeeName ?? '';
?>
<h1>従業員情報登録</h1>

<?php if ($selectedEmployeeId === ''): ?>
<p class="notice">従業員を選択してください。</p>
<p><a class="ghost-btn" href="?controller=Employee&action=index&token=<?= urlencode(Auth::token()) ?>">社員一覧へ戻る</a></p>
<?php else: ?>
<p class="notice">対象従業員: <?= htmlspecialchars($selectedEmployeeId) ?> <?= $selectedEmployeeName !== '' ? '(' . htmlspecialchars($selectedEmployeeName) . ')' : '' ?></p>
<form class="form-card" method="POST" action="?controller=Employee&action=infoStore">
    <input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
    <input type="hidden" name="employee_id" value="<?= htmlspecialchars($selectedEmployeeId) ?>">

    <label class="form-row">
        <span>住所</span>
        <input name="address">
    </label>

    <label class="form-row">
        <span>電話番号</span>
        <input name="phone" type="tel">
    </label>

    <label class="form-row">
        <span>年齢</span>
        <input name="age" type="number" min="0">
    </label>

    <label class="form-row">
        <span>趣味</span>
        <input name="hobby">
    </label>

    <label class="form-row">
        <span>入社日</span>
        <input name="join_date" type="date">
    </label>

    <label class="form-row">
        <span>移動日</span>
        <input name="move_date" type="date">
    </label>

    <label class="form-row">
        <span>部署</span>
        <input name="department">
    </label>

    <label class="form-row">
        <span>役職</span>
        <input name="position">
    </label>

    <div class="form-actions">
        <button class="create-btn" type="submit">登録</button>
        <a class="ghost-btn" href="?controller=Employee&action=index&token=<?= urlencode(Auth::token()) ?>">戻る</a>
    </div>
</form>
<?php endif; ?>
<?php require __DIR__ . '/../partials/foot.php'; ?>