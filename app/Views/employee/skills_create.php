<?php
$title = 'Employee Skills';
require __DIR__ . '/../partials/head.php';
$selectedEmployeeId = $selectedEmployeeId ?? '';
$selectedEmployeeName = $selectedEmployeeName ?? '';
?>
<h1>従業員スキル登録</h1>

<?php if ($selectedEmployeeId === ''): ?>
<p class="notice">従業員を選択してください。</p>
<p><a class="ghost-btn" href="?controller=Employee&action=index&token=<?= urlencode(Auth::token()) ?>">社員一覧へ戻る</a></p>
<?php else: ?>
<p class="notice">対象従業員: <?= htmlspecialchars($selectedEmployeeId) ?> <?= $selectedEmployeeName !== '' ? '(' . htmlspecialchars($selectedEmployeeName) . ')' : '' ?></p>
<form class="form-card" method="POST" action="?controller=Employee&action=skillsStore">
    <input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
    <input type="hidden" name="employee_id" value="<?= htmlspecialchars($selectedEmployeeId) ?>">

    <label class="form-row">
        <span>経験年数</span>
        <input name="years_experience" type="number" min="0">
    </label>

    <div class="stack" id="skills-box">
        <label class="form-row">
            <span>スキル</span>
            <input name="skill[]">
        </label>
    </div>
    <button type="button" class="sub-btn" id="add-skill">追加</button>

    <div class="stack" id="certification-box">
        <label class="form-row">
            <span>資格</span>
            <input name="certification[]">
        </label>
    </div>
    <button type="button" class="sub-btn" id="add-certification">追加</button>

    <label class="form-row">
        <span>業界歴</span>
        <input name="industry_history">
    </label>

    <label class="form-row">
        <span>登録日</span>
        <input name="registered_at" type="date">
    </label>

    <div class="form-actions">
        <button class="create-btn" type="submit">登録</button>
        <a class="ghost-btn" href="?controller=Employee&action=index&token=<?= urlencode(Auth::token()) ?>">戻る</a>
    </div>
</form>

<script>
document.getElementById('add-skill').addEventListener('click', function () {
    var box = document.getElementById('skills-box');
    var wrap = document.createElement('div');
    wrap.innerHTML = '<label class="form-row"><span>スキル</span><input name="skill[]"></label>';
    box.appendChild(wrap);
});

document.getElementById('add-certification').addEventListener('click', function () {
    var box = document.getElementById('certification-box');
    var wrap = document.createElement('div');
    wrap.innerHTML = '<label class="form-row"><span>資格</span><input name="certification[]"></label>';
    box.appendChild(wrap);
});
</script>
<?php endif; ?>
<?php require __DIR__ . '/../partials/foot.php'; ?>