<?php
session_start();
if (!isset($_SESSION['ID']) || $_SESSION['level'] !== 'admin') {
    header("Location: 登入.html");
    exit();
}
// 這邊可以改成檢查是否為員工登入身份，例如:
// if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'staff') {
//   header('Location: login.php');
//   exit();
// }
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'clothing_store';
$conn = new mysqli($host, $user, $password, $database);
$conn->set_charset("utf8");

if ($conn->connect_error) {
  die("資料庫連線失敗: " . $conn->connect_error);
}

// 上架商品
if (isset($_POST['action']) && $_POST['action'] === 'add') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $category = $_POST['category'];
  $sql = "INSERT INTO products (name, description, price, image, category) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssdss", $name, $description, $price, $image, $category);
  $stmt->execute();
}

// 修改商品
if (isset($_POST['action']) && $_POST['action'] === 'update') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $category = $_POST['category'];
  $sql = "UPDATE products SET name=?, description=?, price=?, image=?, category=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssdssi", $name, $description, $price, $image, $category, $id);
  $stmt->execute();
}

// 下架商品
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql = "DELETE FROM products WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
}

// 取得所有商品
$products = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>商品管理</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h1 class="mb-4">商品管理後台</h1>

  <h3>新增商品</h3>
  <form method="POST" class="row g-3 mb-5">
    <input type="hidden" name="action" value="add">
    <div class="col-md-6">
      <input type="text" name="name" class="form-control" placeholder="商品名稱" required>
    </div>
    <div class="col-md-6">
      <input type="text" name="category" class="form-control" placeholder="分類" required>
    </div>
    <div class="col-12">
      <textarea name="description" class="form-control" placeholder="商品描述" required></textarea>
    </div>
    <div class="col-md-6">
      <input type="number" name="price" step="0.01" class="form-control" placeholder="價格" required>
    </div>
    <div class="col-md-6">
      <input type="text" name="image" class="form-control" placeholder="圖片路徑 (例如: 衣服/1.png)" required>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-success">上架商品</button>
    </div>
  </form>

  <h3>現有商品列表</h3>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>名稱</th>
        <th>分類</th>
        <th>描述</th>
        <th>價格</th>
        <th>圖片</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $products->fetch_assoc()): ?>
        <tr>
          <form method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <td><?= $row['id'] ?></td>
            <td><input type="text" name="name" class="form-control" value="<?= $row['name'] ?>"></td>
            <td><input type="text" name="category" class="form-control" value="<?= $row['category'] ?>"></td>
            <td><textarea name="description" class="form-control"><?= $row['description'] ?></textarea></td>
            <td><input type="number" name="price" step="0.01" class="form-control" value="<?= $row['price'] ?>"></td>
            <td><input type="text" name="image" class="form-control" value="<?= $row['image'] ?>"></td>
            <td>
              <button type="submit" class="btn btn-primary btn-sm mb-1">修改</button>
              <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('確定要下架這個商品嗎？')">下架</a>
            </td>
          </form>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <div class="text-end mb-3">
  <a href="一般購物.php" class="btn btn-secondary">返回前台（一般購物）</a>
  <a href="order_manage.php" class="btn btn-outline-dark">訂單管理</a>
</div>

</body>
</html>
