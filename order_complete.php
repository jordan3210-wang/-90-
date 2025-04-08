<?php
session_start();
if (!isset($_SESSION['ID'])) {
    header("Location: 登入.html");
    exit();
  }
// 資料庫連線
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'clothing_store';

$conn = new mysqli($host, $user, $password, $database);
$conn->set_charset("utf8");

if ($conn->connect_error) {
  die("連線失敗：" . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $payment = $_POST['payment_method'] ?? '';
  $shipping = $_POST['shipping_method'] ?? '';
  $address = $_POST['recipient_address'] ?? '';

  if (empty($payment) || empty($shipping) || empty($address)) {
    echo "<script>alert('請填寫所有欄位'); window.history.back();</script>";
    exit();
  }

  // 假設這裡有訂單儲存的資料庫程式，可根據實際需要加入
  // 例如：insert into orders (...) values (...)
  $userId = $_SESSION['ID'] ?? 'guest'; // 或你系統的會員識別方式
  $total = 0;
  
  foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
  }
  
  $stmt = $conn->prepare("INSERT INTO orders (user_id, name, phone, address, payment_method, shipping_method, total) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssi", $userId, $_POST['recipient_name'], $_POST['recipient_phone'], $_POST['recipient_address'], $_POST['payment_method'], $_POST['shipping_method'], $total);
  $stmt->execute();
  // 清空購物車
  unset($_SESSION['cart']);
} else {
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>訂單完成</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<header class="bg-light py-3 text-center shadow-sm">
  <div class="container">
    <a href="index.php" class="text-decoration-none text-dark fw-bold fs-4">購衣系統</a>
  </div>
</header>

<main class="container text-center" style="margin-top: 100px;">
  <h2 class="text-success mb-4">感謝您的訂購！</h2>
  <p>您的訂單已成功建立。</p>
  <p>支付方式：<strong><?php echo htmlspecialchars($payment); ?></strong></p>
  <p>送貨方式：<strong><?php echo htmlspecialchars($shipping); ?></strong></p>
  <p>送貨地址：<strong><?php echo htmlspecialchars($address); ?></strong></p>
  <a href="index.php" class="btn btn-primary mt-4">回到首頁</a>
</main>

<footer class="mt-5 py-3 bg-light text-center">
  <div class="container">
    <strong>聯絡我們</strong><br>
    <i class="bi bi-geo-alt"></i> 新北市新莊區中正路510號<br>
    <i class="bi bi-telephone"></i> (02) 2905-2000<br>
    <i class="bi bi-envelope"></i> pubwww@mail.fju.edu.tw
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
