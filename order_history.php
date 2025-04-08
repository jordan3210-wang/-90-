<?php
session_start();
if (!isset($_SESSION['ID'])) {
    header("Location: 登入.html");
    exit();
  }

$mysqli = new mysqli('localhost', 'root', '', 'clothing_store');
$mysqli->set_charset("utf8");

$userId = $_SESSION['ID'];
$result = $mysqli->query("SELECT * FROM orders WHERE user_id = '$userId' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <title>我的訂單</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">我的訂單</h2>

  <?php if ($result->num_rows === 0): ?>
    <p>目前沒有任何訂單。</p>
  <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>訂單編號</th>
          <th>金額</th>
          <th>支付方式</th>
          <th>送貨方式</th>
          <th>下單時間</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td>#<?= $row['id'] ?></td>
            <td>NT$<?= number_format($row['total']) ?></td>
            <td><?= htmlspecialchars($row['payment_method']) ?></td>
            <td><?= htmlspecialchars($row['shipping_method']) ?></td>
            <td><?= $row['created_at'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <div class="text-center mt-4">
  <a href="index.php" class="btn btn-primary">回首頁</a>
</div>
  <?php endif; ?>
</body>
</html>
