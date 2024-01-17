<link rel="stylesheet" href="../css/final.css">
<?php
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

// 商品IDが渡されているか確認
if (isset($_GET['mid'])) {
    $productId = $_GET['mid'];

    // 商品情報を取得するクエリ
    $query = "SELECT * FROM MINFOMATION WHERE mid = :mid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':mid', $productId, PDO::PARAM_STR);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // 商品削除のクエリを実行
    $deleteQuery = "DELETE FROM MINFOMATION WHERE mid = :mid";
    $deleteStmt = $pdo->prepare($deleteQuery);
    $deleteStmt->bindParam(':mid', $productId, PDO::PARAM_STR);

    if ($deleteStmt->execute()) {
        // 削除成功の場合の処理
        ?>
        <!DOCTYPE html>
        <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>商品削除完了</title>
        </head>

        <body>

            <h1>商品削除完了</h1>

            <!-- 商品情報表示 -->
            <p>ID: <?php echo $product['mid']; ?></p>
            <p>商品名: <?php echo $product['mname']; ?></p>
            <!-- 他の商品情報の表示を追加 -->

            <!-- 戻るボタン -->
            <button onclick="redirectTo('finalichiran.php')">一覧に戻る</button>

            <!-- JavaScript関数：指定したURLにリダイレクト -->
            <script>
                function redirectTo(url) {
                    window.location.href = url;
                }
            </script>

        </body>

        </html>
        <?php
    } else {
        // 削除失敗の場合の処理
        echo '商品の削除に失敗しました。';
    }
} else {
    // 商品IDが渡されていない場合はエラーメッセージを表示
    echo '商品IDが指定されていません。';
}
?>