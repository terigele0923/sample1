<?php
$title = 'Login';
require __DIR__ . '/../partials/head.php';
?>


<?php if (!empty($error)): ?>
    <p class="login-message"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<body class="page-center">
    <form class="login-card" method="POST" action="?controller=Auth&action=authenticate">
        <div class="title">
        <h1>ログイン画面</h1>
        </div>
        <label class="login-row">
            <span>ユーザー名</span>
            <input name="user_name">
        </label>
        <label class="login-row">
            <span>パスワード</span>
            <input type="password" name="password">
        </label>
        <div class="login-actions">
            <button class="create-btn" type="submit">ログイン</button>
            <button class="create-btn" type="button" onclick="location.href='?controller=Employee&action=create'">新規登録</button>
        </div>
    </form>
    <?php require __DIR__ . '/../partials/foot.php'; ?>
</body>