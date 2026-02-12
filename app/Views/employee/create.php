<?php
$title = 'Create Employee';
require __DIR__ . '/../partials/head.php';
?>
<h1>新規登録</h1>

<form method=POST action="?controller=Employee&action=store">
<input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
名前<input name=name><br>
パスワード<input name=password><br>
Email<input name=email><br>
<button>登録</button>
</form>
<?php require __DIR__ . '/../partials/foot.php'; ?>
