<?php
// 共通処理を読み込む
require_once 'app.php';
?>

<!DOCTYPE html>
<html lang="ja">

<?php include 'components/head.php' ?>

<body>
    <?php include 'components/nav.php' ?>

    <main class="container mx-auto">
        <h1 class="text-2xl font-bold text-green-600">姿勢チェック</h1>
        
        <?php include 'components/pose.php' ?>
    </main>

    <?php include 'components/footer.php'; ?>
</body>

</html>