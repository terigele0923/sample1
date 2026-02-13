<?php
$title = 'Create Employee';
require __DIR__ . '/../partials/head.php';
?>


<form class="form-card" method="POST" action="?controller=Employee&action=store">
    <h1>新規登録</h1>
    <input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">

    <label class="form-row">
        <span>ユーザー名</span>
        <input name="user_name">
    </label>

    <label class="form-row">
        <span>パスワード</span>
        <input name="password">
    </label>

    <label class="form-row">
        <span>Email</span>
        <input name="email">
    </label>

    <div class="form-actions">
        <button class="create-btn" type="submit">登録</button>
        <button class="create-btn" type="button" onclick="location.href='?controller=Employee&action=index&token=<?= urlencode(Auth::token()) ?>'">キャンセル</button>
    </div>
</form>
<?php require __DIR__ . '/../partials/foot.php'; ?>