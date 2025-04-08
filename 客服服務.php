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
  <h2 class="text-center">客服服務</h2>
  <div class="d-flex justify-content-center align-items-center">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">意見</h5>

        <form method="post" action="activityinsert.php">

        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">使用者</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="AID">
            </div>
          </div>

          <div class="row mb-3">
                          <label for="inputDate" class="col-sm-2 col-form-label">時間</label>
                          <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" name="Time">
                          </div>
                      </div>

          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">主旨</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="AID">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">內容</label>
            <div class="col-sm-10">
              <textarea class="form-control" style="height: 200px; width: 100%;" name="content"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">送出</button>
            </div>
          </div>

        </form>

      </div>
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