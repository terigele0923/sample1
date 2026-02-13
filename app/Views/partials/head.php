<?php
$title = $title ?? 'Sample1';
$bodyClass = $bodyClass ?? '';
require_once dirname(__DIR__, 3) . '/core/Auth.php';
$isLoggedIn = Auth::check();
$token = $isLoggedIn ? urlencode(Auth::token()) : '';

$headFile = realpath(__FILE__);
$viewFile = '';
foreach (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS) as $frame) {
    if (!empty($frame['file'])) {
        $frameFile = realpath($frame['file']);
        if ($frameFile && $frameFile !== $headFile) {
            $viewFile = $frameFile;
            break;
        }
    }
}

$pageCssName = $viewFile !== '' ? pathinfo($viewFile, PATHINFO_FILENAME) : '';
$pageCssPath = $pageCssName !== '' ? dirname(__DIR__) . '/css/' . $pageCssName . '_style.css' : '';
$pageCssHref = ($pageCssPath !== '' && is_file($pageCssPath))
    ? '../app/Views/css/' . $pageCssName . '_style.css'
    : '';
$isSimplePage = in_array($pageCssName, ['login', 'create'], true);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
    <?php if ($isSimplePage): ?>
        <link rel="stylesheet" href="../app/Views/css/login_style.css">
    <?php else: ?>
        <link rel="stylesheet" href="../app/Views/css/style.css">
        <?php if ($pageCssHref !== ''): ?>
            <link rel="stylesheet" href="<?= htmlspecialchars($pageCssHref) ?>">
        <?php endif; ?>
    <?php endif; ?>
</head>
<body<?= $bodyClass !== '' ? ' class="' . htmlspecialchars($bodyClass) . '"' : '' ?>>
<?php if (!$isSimplePage): ?>
<nav class="global-nav">
            <div class="user-info">
                <h1>従業員管理システム</h1>
                <?php if ($isLoggedIn): ?>
                    <span class="nav-user"><?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></span>
                <?php else: ?>
                    <a class="nav-login" href="?controller=Auth&action=login">ログイン</a>
                <?php endif; ?>
            </div>
        </div>
    <div class="nav-left">
        <a href="?controller=Employee&action=index<?= $token !== '' ? '&token=' . $token : '' ?>">社員一覧</a>
        <a href="?controller=Employee&action=infoShow<?= $token !== '' ? '&token=' . $token : '' ?>">従業員情報</a>
        <a href="?controller=Employee&action=skillsShow<?= $token !== '' ? '&token=' . $token : '' ?>">従業員スキル</a>
    </div>
            <div class="login-logout-btn">
                <?php if ($isLoggedIn): ?>
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
        </div>
</nav>
<div class="page-center">
    <header class="page-header">
        
    </header>
    <div class="page-body">
<?php endif; ?>