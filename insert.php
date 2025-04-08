<?php
session_start();

// 建立資料庫連線
$conn = mysqli_connect("localhost", "root", "", "clothing_store");

// 檢查連線是否成功
if (!$conn) {
    die("連接失敗：" . mysqli_connect_error());
}

// 取得表單資料
$name = $_POST["name"] ?? '';
$account = $_POST["account"] ?? '';
$password = $_POST["password"] ?? '';
$membership = $_POST["membership"] ?? '';

// 檢查帳號是否已存在
$check = mysqli_query($conn, "SELECT * FROM members WHERE ID = '$account'");
if (mysqli_num_rows($check) > 0) {
    echo "帳號已被申請過，3 秒後自動跳轉回會員申請頁...";
    echo "<meta http-equiv='refresh' content='3;url=會員申請.php'>";
    exit;
}

// 建立 SQL 指令
$sql = "INSERT INTO members (ID, password, name, email) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $account, $password, $name, $membership);

// 執行 SQL 並檢查是否成功
if ($stmt->execute()) {
    echo "帳號建立成功，3 秒後將自動跳轉...";
    echo "<meta http-equiv='refresh' content='3;url=登入.html'>";
} else {
    echo "新增失敗：" . $conn->error;
}

$stmt->close();
$conn->close();
?>
