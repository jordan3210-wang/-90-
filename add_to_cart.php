<?php
session_start();
$conn = new mysqli("localhost", "root", "", "clothing_store");
$conn->set_charset("utf8");

if (!isset($_SESSION['account'])) {
    echo "請先登入會員";
    exit;
}

$account = $_SESSION['account'];
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$image = $_POST['image'];
$size = $_POST['size'];
$quantity = $_POST['quantity'];

// 檢查是否已加入該商品（同一個帳號 & 商品）
$check = $conn->prepare("SELECT * FROM cart WHERE account = ? AND product_id = ?");
$check->bind_param("si", $account, $product_id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    // 更新數量
    $row = $result->fetch_assoc();
    $newQty = $row['quantity'] + $quantity;
    $update = $conn->prepare("UPDATE cart SET quantity = ? WHERE account = ? AND product_id = ?");
    $update->bind_param("isi", $newQty, $account, $product_id);
    $update->execute();
} else {
    // 新增
    $insert = $conn->prepare("INSERT INTO cart (account, product_id, product_name, price, image, size, quantity)
                              VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insert->bind_param("sisdssi", $account, $product_id, $product_name, $price, $image, $size, $quantity);
    $insert->execute();
}

$conn->close();
header("Location: cart.php");
?>


