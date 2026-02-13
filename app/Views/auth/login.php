<?php
$title = 'Login';
?>
<h1>ログイン画面</h1>

<?php if (!empty($error)): ?>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="?controller=Auth&action=authenticate">
    ユーザー名 <input name="user_name"><br>
    パスワード <input type="password" name="password"><br>
    <button>ログイン</button>
</form>
<?php require __DIR__ . '/../partials/foot.php'; ?>