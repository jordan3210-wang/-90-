<?php
session_start();

// 連接資料庫
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'clothing_store'; // ✅ 確認這邊是正確的資料庫名稱
$conn = new mysqli($host, $user, $password, $database);
$conn->set_charset("utf8");

if ($conn->connect_error) {
  die("資料庫連線失敗: " . $conn->connect_error);
}

// 取得表單送出的帳號與密碼
$ID = $_POST['ID'] ?? '';
$password = $_POST['password'] ?? '';

// 查詢會員資料
$sql = "SELECT * FROM members WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ID);
$stmt->execute();
$result = $stmt->get_result();

// 判斷是否有此帳號
if ($row = $result->fetch_assoc()) {
  // 驗證密碼（若有用 hash 請用 password_verify）
  if ($row['password'] === $password) {
    // 登入成功，儲存登入資訊
    $_SESSION['ID'] = $row['ID'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['level'] = $row['level']; // admin or member

    // 根據身份轉向
    if ($row['level'] === 'admin') {
      header("Location: product_manage.php");
    } else {
      header("Location: index.php");
    }
    exit();
  } else {
    echo "<script>alert('密碼錯誤'); location.href='登入.html';</script>";
  }
} else {
  echo "<script>alert('帳號不存在'); location.href='登入.html';</script>";
}

$conn->close();
?>
