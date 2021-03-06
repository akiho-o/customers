<?php

require_once __DIR__ . '/functions.php';

// 初期化
$company = '';
$name = '';
$email = '';

// エラーチェック用の配列
$errors = [];
$errors_required = [];

// リクエストメソッドの判定
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームに入力されたデータの受け取り
    $company = filter_input(INPUT_POST, 'company');
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');

    // バリデーション
    $errors_required = validateRequired($company, $name, $email);

    // エラーメッセージの配列をマージ
    $errors = array_merge($errors_required);

    if (empty($errors)) {
        insertCustomer($company, $name, $email);

        header('Location: index.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>
<body>
    <div class="wrapper">
        <h1 class="title"><a href="index.php">顧客管理アプリ</a></h1>
        <div class="form-area">
            <h2 class="sub-title">登録</h2>
            <?php if ($errors) : ?>
                <ul class="errors">
                    <?php foreach ($errors as $error) : ?>
                        <li><?= h($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <form action="" method="post">
                <label for="company">会社名</label>
                <input type="text" id="company" name="company" value="<?= h($company) ?>">
                <label for="name">氏名</label>
                <input type="text" id="name" name="name" value="<?= h($name) ?>">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" value="<?= h($email) ?>">
                <input type="submit" class="btn submit-btn" value="追加">
            </form>
            <a href="index.php" class="btn return-btn">戻る</a>
        </div>
    </div>
</body>

</html>