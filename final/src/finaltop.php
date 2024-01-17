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
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shose List</title>
</head>

<body>

    <h1>Shose List</h1>

    <!-- Buttons to navigate to different pages -->
    <button onclick="redirectTo('finalichiran.php')">一覧表示</button>
    <button onclick="redirectTo('finaltoroku.php')">新規登録</button>
    

    <!-- JavaScript function to redirect to the specified URL -->
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>

</body>

</html>