<?php
$title = 'Login';
require __DIR__ . '/../partials/head.php';
?>
<h1>ログイン</h1>

<?php if (!empty($error)): ?>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="?controller=Auth&action=authenticate">
    名前 <input name="name"><br>
    パスワード <input type="password" name="password"><br>
    <button>ログイン</button>
</form>
<?php require __DIR__ . '/../partials/foot.php'; ?>
