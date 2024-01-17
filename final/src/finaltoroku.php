<link rel="stylesheet" href="../css/final.css">
<?php
// データベース接続
try {
    $pdo = new PDO(
        'mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516814-final;charset=utf8',
        'LAA1516814',
        'Pass0921'
    );
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

// フォームが送信されたかどうかを確認
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームデータを取得
    $newMid = $_POST['newMid'];
    $newMname = $_POST['newMname'];

    // データベースに新しい商品を挿入するクエリ
    $insertQuery = "INSERT INTO MINFOMATION (mid, mname) VALUES (:mid, :mname)";
    $stmt = $pdo->prepare($insertQuery);

    // パラメーターをバインド
    $stmt->bindParam(':mid', $newMid, PDO::PARAM_STR);
    $stmt->bindParam(':mname', $newMname, PDO::PARAM_STR);

    // クエリを実行
    if ($stmt->execute()) {
        echo '商品が正常に追加されました。';
    } else {
        echo '商品の追加に失敗しました。';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
</head>

<body>

    <h1>新規登録</h1>

    <!-- フォーム -->
    <form method="post" action="">
        <label for="newMid">商品ID:</label>
        <input type="text" id="newMid" name="newMid" required>
        <br>
        <label for="newMname">商品名:</label>
        <input type="text" id="newMname" name="newMname" required>
        <br>
        <input type="submit" value="登録">
    </form>

    <br>

    <!-- 一覧に戻るボタン -->
    <button onclick="redirectTo('finalichiran.php')">一覧に戻る</button>

    <!-- JavaScript関数：指定したURLにリダイレクト -->
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>

</body>

</html>