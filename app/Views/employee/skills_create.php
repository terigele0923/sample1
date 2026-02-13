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
<h1>従業員スキル登録</h1>

<?php if ($selectedEmployeeId === ''): ?>
<form method="GET" action="">
    <input type="hidden" name="controller" value="Employee">
    <input type="hidden" name="action" value="skillsCreate">
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
<form method="POST" action="?controller=Employee&action=skillsStore">
    <input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
    <input type="hidden" name="employee_id" value="<?= htmlspecialchars($selectedEmployeeId) ?>">

    <label>経験年数 <input name="years_experience" type="number" min="0"></label><br>

    <div id="skills-box">
        <label>スキル <input name="skill[]"></label><br>
    </div>
    <button type="button" class="create-btn" id="add-skill">追加</button>
    <br>
    <div id="certification-box">
        <label>資格 <input name="certification[]"></label><br>
    </div>
    <button type="button" class="create-btn" id="add-certification">追加</button>

    <label>業界歴 <input name="industry_history"></label><br>
    <label>登録日 <input name="registered_at" type="date"></label><br>

    <button class="create-btn" type="submit">登録</button>
</form>

<script>
document.getElementById('add-skill').addEventListener('click', function () {
    var box = document.getElementById('skills-box');
    var wrap = document.createElement('div');
    wrap.innerHTML = '<label>スキル <input name="skill[]"></label><br>';
    box.appendChild(wrap);
});

document.getElementById('add-certification').addEventListener('click', function () {
    var box = document.getElementById('certification-box');
    var wrap = document.createElement('div');
    wrap.innerHTML = '<label>資格 <input name="certification[]"></label><br>';
    box.appendChild(wrap);
});
</script>
<?php endif; ?>
<?php require __DIR__ . '/../partials/foot.php'; ?>