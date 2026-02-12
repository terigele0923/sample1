<?php
$title = 'Employee List';
$bodyClass = 'page-center';
require __DIR__ . '/../partials/head.php';
?>
<header class="page-header">
    <h1>社員一覧</h1>
    <a class="logout-btn" href="?controller=Auth&action=logout&token=<?= urlencode(Auth::token()) ?>">Logout</a>
</header>

<main class="index-wrap">
    <a class="create-btn" href="?controller=Employee&action=create&token=<?= urlencode(Auth::token()) ?>">新規登録</a>
    <table class="index">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>パスワード</th>
                <th>Email</th>
                <th colspan="2">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $e): ?>
                <tr>
                    <td><?= $e['id'] ?></td>
                    <td><?= htmlspecialchars($e['name']) ?></td>
                    <td><?= htmlspecialchars($e['password']) ?></td>
                    <td><?= htmlspecialchars($e['email']) ?></td>
                    <td>
                        <form method="POST" action="?controller=Employee&action=edit">
                            <input type="hidden" name="id" value="<?= $e['id'] ?>">
                            <input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
                            <button type="submit" class="edit-btn">編集</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="?controller=Employee&action=delete">
                            <input type="hidden" name="id" value="<?= $e['id'] ?>">
                            <input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
                            <button type="submit" class="delete-btn">削除</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php require __DIR__ . '/../partials/foot.php'; ?>
