<?php
session_start();
$conn = new mysqli("localhost", "root", "", "clothing_store");
$conn->set_charset("utf8");

if (!isset($_SESSION['account'])) {
    echo "請先登入會員";
    exit;
}

$account = $_SESSION['account'];
$sql = "SELECT * FROM cart WHERE account = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $account);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <title>購物車 | 購衣系統</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3 class="text-center mb-4">我的購物車</h3>
  <?php if ($result->num_rows === 0): ?>
    <p class="text-center">購物車目前是空的。</p>
  <?php else: ?>
    <table class="table table-bordered text-center">
      <thead>
        <tr>
          <th>商品名稱</th>
          <th>單價</th>
          <th>數量</th>
          <th>小計</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $total = 0;
      while ($row = $result->fetch_assoc()):
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
      ?>
        <tr>
          <td><?= htmlspecialchars($row['product_name']) ?></td>
          <td>NT$<?= $row['price'] ?></td>
          <td><?= $row['quantity'] ?></td>
          <td>NT$<?= $subtotal ?></td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
    <h4 class="text-end">總金額：NT$<?= $total ?></h4>
  <?php endif; ?>
</div>
</body>
</html>
