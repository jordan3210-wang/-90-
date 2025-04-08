<?php
// 開啟 session，並連線資料庫
session_start();
$link = mysqli_connect('localhost', 'root', '12345678', 'clothing_store');
mysqli_set_charset($link, "utf8");

// 安全取得 ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 查詢資料
$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($link, $sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
  echo "<p style='text-align:center;'>找不到這個商品。</p>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($product['name']); ?> - 商品詳情</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2 class="text-center mb-4"><?php echo htmlspecialchars($product['name']); ?></h2>
  <div class="row justify-content-center">
    <div class="col-md-6 text-center">
      <img src="<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid mb-3" alt="商品圖片">
      <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
      <h4 class="text-danger">NT$<?php echo number_format($product['price']); ?></h4>
      <a href="index.php" class="btn btn-secondary mt-3">返回首頁</a>
    </div>
  </div>
</body>
</html>
