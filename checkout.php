<?php
session_start();
if (!isset($_SESSION['ID'])) {
    header("Location: 登入.html");
    exit();
  }
// 沒有商品就導回購物車
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
  header("Location: cart.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <title>結帳頁面 | 購衣系統</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="text-center mb-4">結帳資訊</h2>

    <form method="post" action="order_complete.php">
      <!-- 支付方式 -->
      <div class="mb-4">
        <label class="form-label">選擇支付方式：</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="payment_method" value="credit_card" required>
          <label class="form-check-label">信用卡</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="payment_method" value="cod">
          <label class="form-check-label">貨到付款</label>
        </div>
      </div>

      <!-- 送貨方式 -->
      <div class="mb-4">
        <label class="form-label">選擇送貨方式：</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="shipping_method" value="home" required>
          <label class="form-check-label">宅配</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="shipping_method" value="store">
          <label class="form-check-label">超商取貨</label>
        </div>
      </div>

      <!-- 收件人資訊 -->
      <div class="mb-3">
        <label for="name" class="form-label">收件人姓名</label>
        <input type="text" class="form-control" id="name" name="recipient_name" required>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">收件地址</label>
        <input type="text" class="form-control" id="address" name="recipient_address" required>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">聯絡電話</label>
        <input type="tel" class="form-control" id="phone" name="recipient_phone" required>
      </div>

      <div class="text-end">
        <a href="cart.php" class="btn btn-secondary">返回購物車</a>
        <button type="submit" class="btn btn-success">送出訂單</button>
      </div>
    </form>
  </div>
</body>
</html>
