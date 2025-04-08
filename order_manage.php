<?php
session_start();
if (!isset($_SESSION['ID']) || $_SESSION['level'] !== 'admin') {
    header("Location: 登入.html");
    exit();

}
$conn = new mysqli('localhost', 'root', '', 'clothing_store');
$conn->set_charset("utf8");

if ($conn->connect_error) {
  die("連線失敗: " . $conn->connect_error);
}

// 處理完成訂單按鈕
if (isset($_GET['complete'])) {
  $orderId = intval($_GET['complete']);
  $conn->query("UPDATE orders SET status='已完成' WHERE id=$orderId");
  header("Location: order_manage.php");
  exit();
}

$result = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <title>訂單管理 | 後台</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">訂單管理</h2>

  <a href="product_manage.php" class="btn btn-secondary mb-4">返回產品管理</a>

  <?php if ($result->num_rows === 0): ?>
    <p>目前尚無訂單。</p>
  <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>訂單編號</th>
          <th>會員 ID</th>
          <th>姓名</th>
          <th>電話</th>
          <th>地址</th>
          <th>金額</th>
          <th>支付</th>
          <th>送貨</th>
          <th>狀態</th>
          <th>下單時間</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td>#<?= $row['id'] ?></td>
            <td><?= $row['user_id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td>NT$<?= number_format($row['total']) ?></td>
            <td><?= htmlspecialchars($row['payment_method']) ?></td>
            <td><?= htmlspecialchars($row['shipping_method']) ?></td>
            <td>
              <span class="badge bg-<?= $row['status'] === '已完成' ? 'success' : 'warning' ?>">
                <?= $row['status'] ?>
              </span>
            </td>
            <td><?= $row['created_at'] ?></td>
            <td>
              <?php if ($row['status'] !== '已完成'): ?>
                <a href="?complete=<?= $row['id'] ?>" class="btn btn-sm btn-success" onclick="return confirm('確定將此訂單標記為已完成？')">完成訂單</a>
              <?php else: ?>
                -
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php endif; ?>
</body>
</html>
