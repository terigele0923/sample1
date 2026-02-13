<?php
$title = $title ?? 'Sample1';
$bodyClass = $bodyClass ?? '';
require_once dirname(__DIR__, 3) . '/core/Auth.php';
$isLoggedIn = Auth::check();
$token = $isLoggedIn ? urlencode(Auth::token()) : '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="../app/Views/css/style.css">
</head>
<header class="page-header">
    <h1>社員一覧</h1>
    <div class="nav-right">
        <?php if ($isLoggedIn): ?>
            <span class="nav-user"><?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></span>
            <form method="POST" action="?controller=Auth&action=logout">
                <input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
                <button type="submit" class="nav-btn">Logout</button>
            </form>
        <?php else: ?>
            <form method="GET" action="">
                <input type="hidden" name="controller" value="Auth">
                <input type="hidden" name="action" value="login">
                <button type="submit" class="nav-btn">Login</button>
            </form>
        <?php endif; ?>
    </div>
</header>
<body<?= $bodyClass !== '' ? ' class="' . htmlspecialchars($bodyClass) . '"' : '' ?>>
<nav class="global-nav">
    <div class="nav-left">
        <a href="?controller=Employee&action=index<?= $token !== '' ? '&token=' . $token : '' ?>">社員一覧</a>
        <a href="?controller=Employee&action=create<?= $token !== '' ? '&token=' . $token : '' ?>">新規登録</a>
        <a href="?controller=Employee&action=infoShow<?= $token !== '' ? '&token=' . $token : '' ?>">従業員情報</a>
        <a href="?controller=Employee&action=skillsShow<?= $token !== '' ? '&token=' . $token : '' ?>">従業員スキル</a>
    </div>
</nav>
</body>
</html>