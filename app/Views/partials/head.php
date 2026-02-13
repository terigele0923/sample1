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
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="../app/Views/css/style.css">
    <?php if ($pageCssHref !== ''): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($pageCssHref) ?>">
    <?php endif; ?>
</head>
<body<?= $bodyClass !== '' ? ' class="' . htmlspecialchars($bodyClass) . '"' : '' ?>>
<nav class="global-nav">
    <div class="nav-left">
        <h1>社員情報管理システム</h1>
        <div class="user-info">
                <?php if ($isLoggedIn): ?>
                    <span class="nav-user"><?= htmlspecialchars("ユーザー名: " . ($_SESSION['user_name'] ?? '')) ?></span>
                <?php else: ?>
                    <span class="nav-user">ゲストユーザー</span>
                <?php endif; ?>
            </div>
        <a href="?controller=Employee&action=index<?= $token !== '' ? '&token=' . $token : '' ?>">社員一覧</a>
        <a href="?controller=Employee&action=create<?= $token !== '' ? '&token=' . $token : '' ?>">新規登録</a>
        <a href="?controller=Employee&action=infoShow<?= $token !== '' ? '&token=' . $token : '' ?>">従業員情報</a>
        <a href="?controller=Employee&action=skillsShow<?= $token !== '' ? '&token=' . $token : '' ?>">従業員スキル</a>
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
        <div class="page-header-inner">
        </div>
    </header>
    <div class="page-body">