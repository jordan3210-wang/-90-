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
  <div class="container mt-4">
    <h2 class="text-center mb-4">展館介紹</h2>
    <img src="衣服/展館.jpg" class="d-block w-100 rounded shadow" alt="Welcome" style="height: 600px; object-fit: cover;">
    
    <div class="row mt-5">
      <div class="col-12">
        <h3 class="mb-3" style="color: #012970;">流行男裝</h3>
        <p class="text-muted fs-4">
          這裡匯聚最新的時尚男士單品，從正式西裝到休閒風格的襯衫、針織衫一應俱全。不論是商務場合還是日常穿搭，展館內的設計都緊跟潮流，打造現代男性的衣櫥必備。
        </p>
      </div>
    </div>
    
    <div class="row mt-5">
      <div class="col-12">
        <h3 class="mb-3" style="color: #012970;">流行女裝</h3>
        <p class="text-muted fs-4">
        主打優雅與潮流兼備的女裝系列，提供從休閒風格的襯衫到街頭風格的上衣等多樣選擇。無論是參加聚會、逛街還是日常辦公，展館內的每件服飾都能完美契合妳的時尚需求。
        </p>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-12">
        <h3 class="mb-3" style="color: #012970;">青少年男裝</h3>
        <p class="text-muted fs-4">
        青春與活力的代名詞，這裡主推運動風、街頭潮流與休閒風格的服飾，包含T恤、帽T等。為青少年提供隨性又有型的穿搭靈感，滿足他們的個性化需求。
        </p>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-12">
        <h3 class="mb-3" style="color: #012970;">青少年女裝</h3>
        <p class="text-muted fs-4">
        打造青春時尚的專屬空間，展出甜美風、休閒風與個性混搭的服飾，包含T恤、背心等。展館以引領潮流為目標，讓青少年女孩輕鬆找到展現自我的服裝選擇。
        </p>
      </div>
    </div>
    
  </div>

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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>