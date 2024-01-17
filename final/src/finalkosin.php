
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

$updateMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form is submitted
    if (isset($_POST['update'])) {
        // Get form data
        $productId = $_POST['mid'];
        $productName = $_POST['mname']; // Assuming mname is the name field

        // Prepare and execute the UPDATE query
        $updateQuery = "UPDATE MINFOMATION SET mname = :mname WHERE mid = :mid";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':mid', $productId, PDO::PARAM_STR);
        $stmt->bindParam(':mname', $productName, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Update successful, set the message
            $updateMessage = '商品の更新が完了しました。';
        } else {
            // Update failed, handle the error or display a message
            $updateMessage = '商品の更新に失敗しました。エラーメッセージ: ' . implode(" ", $stmt->errorInfo());
        }
    }
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
} else {
    // 商品IDが渡されていない場合はエラーメッセージを表示
    echo '商品IDが指定されていません。';
    die();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品更新</title>
</head>

<body>

    <h1>商品更新</h1>

    <?php
    if (!empty($updateMessage)) {
        echo '<p>' . $updateMessage . '</p>';
    }
    ?>

    <!-- 商品情報表示フォーム -->
    <form method="post" action="finalkosin.php?mid=<?php echo $productId; ?>">
        <input type="hidden" name="mid" value="<?php echo $productId; ?>">
        <label for="mname">商品名：</label>
        <input type="text" id="mname" name="mname" value="<?php echo $product['mname']; ?>" required>
        <!-- 他の商品情報のフィールドを追加 -->
        <button type="submit" name="update">更新</button>
    </form>

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