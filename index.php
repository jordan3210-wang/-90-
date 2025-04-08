<?php
session_start();
?>

<!DOCTYPE html>
<html lang="zh-TW">

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
         <?php


  // ✅ 新增：會員才顯示「查詢訂單」按鈕
  if ($_SESSION['level'] === 'member') {
    echo "<a href='order_history.php' class='btn btn-outline-info btn-sm'>查詢訂單</a>";
  }
else 
?>
      <a href="cart.php" class="btn btn-outline-primary btn-sm">
        <i class="bi bi-cart"></i> 購物車
      </a>
    </div>
  </div>
</header><!-- End Header -->
<!-- Header 下方加這行，方便你看登入狀態 -->
<?php
  echo "<!-- SESSION ID: " . ($_SESSION['ID'] ?? '未登入') . " -->";
?>


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
</aside>

<!-- End Sidebar -->

<!-- ======= Main 主要內容區 ======= -->
<main id="main" class="main">

<section id="lokiSlider" class="carousel slide carousel-fade" data-bss-ride="carousel" data-bs-theme="dark">
<div class="carousel-indicators">
  <button type="button" data-bs-target="#lokiSlider" data-bs-slide-to="0" class="active"></button>
  <button type="button" data-bs-target="#lokiSlider" data-bs-slide-to="1"></button>
  <button type="button" data-bs-target="#lokiSlider" data-bs-slide-to="2"></button>
  <button type="button" data-bs-target="#lokiSlider" data-bs-slide-to="3"></button>
  <button type="button" data-bs-target="#lokiSlider" data-bs-slide-to="4"></button>
</div>
<div class="carousel-inner">
<div class="carousel-item active">
    <img src="衣服/展館.jpg" class="d-block w-100" alt="Welcome" style="height: 600px; object-fit: cover;">
    <div class="carousel-caption top-0 bottom-0 d-flex flex-column justify-content-center">
      <h1 style="color: black; font-weight: bold;">Welcome to<br>購衣系統<br>流行&nbsp;好穿&nbsp;耐用</h1>
      <p class="d-none d-md-block"></p>
    </div>
  </div>
  <div class="carousel-item">
    <img src="衣服/流行男.png" class="d-block w-100" alt="流行男裝" style="height: 600px; object-fit: cover;">
    <div class="carousel-caption top-0 bottom-0 d-flex flex-column justify-content-center">
      <h1 style="color: black; font-weight: bold;">流行男裝</h1>
      <p class="d-none d-md-block"></p>
    </div>
  </div>
  <div class="carousel-item">
    <img src="衣服/流行女.png" class="d-block w-100" alt="流行女裝" style="height: 600px; object-fit: cover;">
    <div class="carousel-caption top-0 bottom-0 d-flex flex-column justify-content-center">
      <h1 style="color: black; font-weight: bold;">流行女裝</h1>
      <p class="d-none d-md-block"></p>
    </div>
  </div>
  <div class="carousel-item">
    <img src="衣服/青少年男.png" class="d-block w-100" alt="青少年男裝" style="height: 600px; object-fit: cover;">
    <div class="carousel-caption top-0 bottom-0 d-flex flex-column justify-content-center">
      <h1 style="color: black; font-weight: bold;">青少年男裝</h1>
      <p class="d-none d-md-block"></p>
    </div>
  </div>
  <div class="carousel-item">
    <img src="衣服/青少年女.png" class="d-block w-100" alt="青少年女裝" style="height: 600px; object-fit: cover;">
    <div class="carousel-caption top-0 bottom-0 d-flex flex-column justify-content-center">
      <h1 style="color: black; font-weight: bold;">青少年女裝</h1>
      <p class="d-none d-md-block"></p>
    </div>
  </div>
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#lokiSlider" data-bs-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 50px; height: 50px;"></span>
  <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#lokiSlider" data-bs-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"  style="width: 50px; height: 50px;"></span>
  <span class="visually-hidden">Next</span>
</button>
</section>




<section id="recommendedClothes" class="container mt-5">
<h2 class="text-center">推薦衣服</h2>
<div class="row">
<div class="col-md-4 mb-4">
    <div class="card" style="width: 100%;">
      <img src="衣服/1.png" class="card-img-top" alt="外套" style="object-fit: cover; height: 300px;">
      <div class="card-body">
        <h5 class="card-title">外套</h5>
        <p class="card-text">原價: NT$790</p>
        <p class="card-text" style="color: red; font-size: 24px;">特價: NT$590</p>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal1">查看詳情</a>
      </div>
    </div>
  </div>

  <div class="modal fade" id="productModal1" tabindex="-1" aria-labelledby="productModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel1">外套</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="衣服/1.png" alt="外套" style="width: 100%; height: auto; object-fit: cover; margin: 0 auto; display: block;">
          <p>原價: NT$790</p>
          <p style="color: red; font-size: 24px;">特價: NT$590</p>
          <form>
            <div class="mb-3">
              <label for="sizeSelect1" class="form-label">選擇尺寸</label>
              <select class="form-select" id="sizeSelect1">
                <option value="S">S - 存貨: 5</option>
                <option value="M">M - 存貨: 3</option>
                <option value="L">L - 存貨: 8</option>
                <option value="XL">XL - 存貨: 2</option>
                <option value="2L">2L - 存貨: 4</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="quantityInput1" class="form-label">選擇數量</label>
              <input type="number" class="form-control" id="quantityInput1" min="1" max="10" value="1">
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary">加入購物車</button>
                <button type="button" class="btn btn-success">直接購買</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-4">
    <div class="card" style="width: 100%;">
      <img src="衣服/2.png" class="card-img-top" alt="襯衫" style="object-fit: cover; height: 300px;">
      <div class="card-body">
        <h5 class="card-title">襯衫</h5>
        <p class="card-text">原價: NT$590</p>
        <p class="card-text" style="color: red; font-size: 24px;">特價: NT$390</p>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal2">查看詳情</a>
      </div>
    </div>

    <div class="modal fade" id="productModal2" tabindex="-1" aria-labelledby="productModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel1">襯衫</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="衣服/2.png" alt="襯衫" style="width: 100%; height: auto; object-fit: cover; margin: 0 auto; display: block;">
          <p>原價: NT$590</p>
          <p style="color: red; font-size: 24px;">特價: NT$390</p>
          <form>
            <div class="mb-3">
              <label for="sizeSelect2" class="form-label">選擇尺寸</label>
              <select class="form-select" id="sizeSelect2">
                <option value="S">S - 存貨: 4</option>
                <option value="M">M - 存貨: 2</option>
                <option value="L">L - 存貨: 5</option>
                <option value="XL">XL - 存貨: 5</option>
                <option value="2L">2L - 存貨: 4</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="quantityInput2" class="form-label">選擇數量</label>
              <input type="number" class="form-control" id="quantityInput2" min="1" max="10" value="1">
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary">加入購物車</button>
                <button type="button" class="btn btn-success">直接購買</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>

  </div>
  <div class="col-md-4 mb-4">
    <div class="card" style="width: 100%;">
      <img src="衣服/14.png" class="card-img-top" alt="T恤" style="object-fit: cover; height: 300px;">
      <div class="card-body">
        <h5 class="card-title">T恤</h5>
        <p class="card-text">原價: NT$690</p>
        <p class="card-text" style="color: red; font-size: 24px;">特價: NT$490</p>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal3">查看詳情</a>
      </div>
    </div>

    <div class="modal fade" id="productModal3" tabindex="-1" aria-labelledby="productModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel3">T恤</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="衣服/14.png" alt="T恤" style="width: 100%; height: auto; object-fit: cover; margin: 0 auto; display: block;">
          <p>原價: NT$690</p>
          <p style="color: red; font-size: 24px;">特價: NT$490</p>
          <form>
            <div class="mb-3">
              <label for="sizeSelect3" class="form-label">選擇尺寸</label>
              <select class="form-select" id="sizeSelect3">
                <option value="S">S - 存貨: 1</option>
                <option value="M">M - 存貨: 2</option>
                <option value="L">L - 存貨: 3</option>
                <option value="XL">XL - 存貨: 4</option>
                <option value="2L">2L - 存貨: 5</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="quantityInput3" class="form-label">選擇數量</label>
              <input type="number" class="form-control" id="quantityInput3" min="1" max="10" value="1">
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary">加入購物車</button>
                <button type="button" class="btn btn-success">直接購買</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>

  </div>
</div>
</section>

      <section class="section dashboard">
      <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">

      </div><!-- End Right side columns -->

    </div>
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer mt-auto text-center bg-light py-3">
  <div class="container">
    <strong>聯絡我們</strong><br>
    <i class="bi bi-geo-alt"></i> 新北市新莊區中正路510號<br>
    <i class="bi bi-telephone"></i> (02) 2905-2000<br>
    <i class="bi bi-envelope"></i> pubwww@mail.fju.edu.tw
  </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>

<!-- JS 檔案 -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>


