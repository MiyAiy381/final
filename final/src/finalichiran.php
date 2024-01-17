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

// 商品一覧を取得するクエリ
$query = "SELECT * FROM MINFOMATION";
$result = $pdo->query($query);

if (!$result) {
    echo 'Query failed: ' . $pdo->errorInfo()[2];
    die();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
</head>

<body>

    <h1>商品一覧</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>商品名</th>
            <!-- 他の商品情報のヘッダーを追加 -->
            <th>更新</th>
            <th>削除</th>
        </tr>

        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['mid']; ?></td>
                <td><?php echo $row['mname']; ?></td>
                <!-- 他の商品情報のセルを追加 -->
                <td><a href="finalkosin.php?mid=<?php echo $row['mid']; ?>">更新</a></td>
                <td><button onclick="deleteProduct(<?php echo $row['mid']; ?>)">削除</button></td>
            </tr>
        <?php } ?>
    </table>

    <br>

    <!-- 戻るボタン -->
    <button onclick="redirectTo('finaltop.php')">戻る</button>

    <!-- JavaScript関数：指定したURLにリダイレクト -->
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }

        function deleteProduct(productId) {
            if (confirm('本当に削除しますか？')) {
                window.location.href = 'finaldelete.php?mid=' + productId;
            }
        }
    </script>

</body>

</html>