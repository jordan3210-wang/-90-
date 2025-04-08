<?php
session_start();
?>

<!DOCTYPE html>
< lang="zh-TW">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>購衣系統</title>

  <!-- 網站圖示 -->
  <link href="https://upload.wikimedia.org/wikipedia/zh/thumb/d/da/Fu_Jen_Catholic_University_logo.svg/640px-Fu_Jen_Catholic_University_logo.svg.png" rel="icon">
  <link href="https://upload.wikimedia.org/wikipedia/zh/thumb/d/da/Fu_Jen_Catholic_University_logo.svg/640px-Fu_Jen_Catholic_University_logo.svg.png" rel="apple-touch-icon">

  <!-- 字體與樣式 -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Nunito|Poppins" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center bg-white shadow-sm">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <a href="index.php" class="logo d-flex align-items-center text-dark text-decoration-none">
      <img src="" alt="">
      <span class="d-none d-lg-block fw-bold fs-4">購衣系統</span>
    </a>

    <div class="d-flex align-items-center gap-3">
      <?php
      if (isset($_SESSION['name']) && $_SESSION['name'] !== "") {
        echo "<span>您好，" . htmlspecialchars($_SESSION['name']) . "</span> <a href='logout.php' class='btn btn-outline-secondary btn-sm'>登出</a>";
      } else {
        echo "<a href='登入.html' class='btn btn-outline-primary btn-sm'>請登入</a>";
      }
      ?>
      <a href="cart.php" class="btn btn-outline-primary btn-sm">
        <i class="bi bi-cart"></i> 購物車
      </a>
    </div>
  </div>
</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <?php
      // 安全檢查 $someArray，避免未定義警告
      if (isset($someArray) && is_array($someArray) && isset($someArray['key'])) {
        echo htmlspecialchars($someArray['key']);
      } else {
        echo "<a class='nav-link collapsed' href='登入.html'>
                <i class='bi bi-box-arrow-in-right'></i><span>登入</span>
              </a>";
      }
      ?>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#memberSubMenu" data-bs-toggle="collapse" aria-expanded="false">
        <i class="bi bi-person"></i><span>會員</span>
      </a>
      <div id="memberSubMenu" class="collapse">
        <ul class="nav flex-column ms-3">
          <li class="nav-item"><a class="nav-link" href="會員申請.php">會員申請</a></li>
          <li class="nav-item"><a class="nav-link" href="密碼更改.php">密碼更改</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="展館介紹.php"><i class="bi bi-info-circle"></i><span>展館介紹</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="一般購物.php"><i class="bi bi-cart"></i><span>一般購物</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="index.php" style="color: red;"><i class="bi bi-cart"></i><span>VR購物</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="客服服務.php"><i class="bi bi-headset"></i><span>客服服務</span></a>
    </li>
  </ul>
</aside><!-- End Sidebar -->

  <main id="main" class="main">

  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">服裝分類</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="一般購物.php">流行男裝</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="流行女裝.php">流行女裝</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="青少年男裝.php">青少年男裝</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="青少年女裝.php">青少年女裝</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="d-flex mb-3">
  <div class="col-8 col-sm-6 col-md-4 col-lg-3">
    <input type="text" id="searchInput" class="form-control" placeholder="搜尋商品">
  </div>
  <button class="btn btn-outline-secondary" id="searchButton">
    <i class="bi bi-search"></i> 搜尋
  </button>
</div>



        <section class="section dashboard">
        <div class="row">

        <?php
$conn = new mysqli("localhost", "root", "", "clothing_store");
$conn->set_charset("utf8");

$sql = "SELECT * FROM products"; // 依照你資料表名稱調整
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $id = $row['id'];
  $name = htmlspecialchars($row['name']);
  $price = $row['price'];
  $image = htmlspecialchars($row['image']);
  echo "
    <div class='col-md-4 mb-4'>
      <div class='card'>
        <img src='{$image}' class='card-img-top' style='height:300px; object-fit:cover;' alt='{$name}'>
        <div class='card-body'>
          <h5 class='card-title'>{$name}</h5>
          <p class='card-text'>NT\${$price}</p>
          <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#productModal{$id}'>查看詳情</button>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class='modal fade' id='productModal{$id}' tabindex='-1'>
      <div class='modal-dialog modal-lg'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title'>{$name}</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
          </div>
          <div class='modal-body'>
            <img src='{$image}' class='img-fluid mb-3'>
            <p>價格: NT\${$price}</p>
            <form method='post' action='add_to_cart.php'>
              <input type='hidden' name='product_id' value='{$id}'>
              <input type='hidden' name='product_name' value='{$name}'>
              <input type='hidden' name='price' value='{$price}'>
              <input type='hidden' name='image' value='{$image}'>
              <div class='mb-3'>
                <label>尺寸</label>
                <select name='size' class='form-select' required>
                  <option value='S'>S</option>
                  <option value='M'>M</option>
                  <option value='L'>L</option>
                  <option value='XL'>XL</option>
                </select>
              </div>
              <div class='mb-3'>
                <label>數量</label>
                <input type='number' name='quantity' value='1' min='1' max='10' class='form-control' required>
              </div>
              <button type='submit' class='btn btn-success'>加入購物車</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  ";
}
?>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      <i><strong>聯絡我們</strong></i>
      <br>
      <strong>
        <span>
          <i class="bi bi-geo-alt"></i>&nbsp;新北市新莊區中正路510號<br>
          <i class="bi bi-telephone"></i>&nbsp;(02)&nbsp;29052000<br>
          <i class="bi bi-envelope"></i>&nbsp;pubwww@mail.fju.edu.tw
        </span>
      </strong>
    </div>
</footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
<!-- 其他 script -->
<!-- 正確開始 script -->
<script>
  document.getElementById('searchButton').addEventListener('click', function () {
    const keyword = document.getElementById('searchInput').value;

    fetch('search.php?keyword=' + encodeURIComponent(keyword))
      .then(response => response.json())
      .then(data => {
        const container = document.querySelector('#productContainer .row');
        container.innerHTML = ''; // 清空產品區域

        if (data.length === 0) {
          container.innerHTML = '<p class="text-center">查無結果</p>';
          return;
        }

        data.forEach(item => {
          const card = `
            <div class="col-md-4 mb-4">
              <div class="card" style="width: 100%;">
                <img src="${item.image}" class="card-img-top" alt="${item.name}" style="object-fit: cover; height: 300px;">
                <div class="card-body">
                  <h5 class="card-title">${item.name}</h5>
                  <p class="card-text">價格: NT$${item.price}</p>
                  <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="id" value="${item.id}">
                    <input type="hidden" name="name" value="${item.name}">
                    <input type="hidden" name="price" value="${item.price}">
                    <input type="hidden" name="image" value="${item.image}">
                    <div class="mb-2">
                      <label>數量：</label>
                      <input type="number" name="quantity" value="1" min="1" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">加入購物車</button>
                  </form>
                </div>
              </div>
            </div>
          `;
          container.insertAdjacentHTML('beforeend', card);
        });
      })
      .catch(error => {
        console.error("搜尋錯誤:", error);
      });
  });
</script>



  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>