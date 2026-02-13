<?php
$title = 'Edit Employee';
require __DIR__ . '/../partials/head.php';
?>
<h1>編集</h1>

<form method="POST" action="?controller=Employee&action=update">
<input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
<input type=hidden name=id value="<?= $employee['id']?>">

名前<input name=user_name value="<?= $employee['user_name']?>"><br>
パスワード<input type="password" name="password" value="<?= $employee['password']?>"><br>
Email<input name=email value="<?= $employee['email']?>"><br>

<button class="edit-btn">更新</button>
</form>
<?php require __DIR__ . '/../partials/foot.php'; ?>