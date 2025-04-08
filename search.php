<?php
// 設定資料庫連線
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'clothing_store';

$conn = new mysqli($host, $user, $password, $database);
$conn->set_charset("utf8");

if ($conn->connect_error) {
  die("連線失敗: " . $conn->connect_error);
}

$keyword = $_GET['keyword'] ?? '';

$sql = "SELECT * FROM products WHERE name LIKE ? OR category LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $keyword . "%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
