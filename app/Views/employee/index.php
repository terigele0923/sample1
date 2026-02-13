<?php
$title = 'Employee List';
require __DIR__ . '/../partials/head.php';
?>

<main class="index-wrap">
    <form id="employee-select-form" method="POST">
        <input type="hidden" name="token" value="<?= htmlspecialchars(Auth::token()) ?>">
        <div class="action-links">
            <a class="create-btn" href="?controller=Employee&action=create&token=<?= urlencode(Auth::token()) ?>">新規登録</a>
            <button class="create-btn" type="submit" formaction="?controller=Employee&action=infoCreate">従業員情報登録</button>
            <button class="create-btn" type="submit" formaction="?controller=Employee&action=skillsCreate">従業員スキル登録</button>
            <button class="create-btn" type="submit" formaction="?controller=Employee&action=infoShow">従業員情報表示</button>
            <button class="create-btn" type="submit" formaction="?controller=Employee&action=skillsShow">従業員スキル表示</button>
        </div>
    </form>

    <table class="index">
        <thead>
            <tr>
                <th>選択</th>
                <th>ID</th>
                <th>ユーザー名</th>
                <th>パスワード</th>
                <th>Email</th>
                <th colspan="2">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $e): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="employee_id" value="<?= $e['id'] ?>" form="employee-select-form">
                    </td>
                    <td><?= $e['id'] ?></td>
                    <td><?= htmlspecialchars($e['user_name']) ?></td>
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

<script>
document.querySelectorAll('input[name="employee_id"]').forEach(function (box) {
    box.addEventListener('change', function () {
        if (!this.checked) {
            return;
        }
        document.querySelectorAll('input[name="employee_id"]').forEach(function (other) {
            if (other !== box) {
                other.checked = false;
            }
        });
    });
});
</script>
<?php require __DIR__ . '/../partials/foot.php'; ?>