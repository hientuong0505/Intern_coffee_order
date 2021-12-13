<?php
include(__DIR__ . '\..\..\controllers\category.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Trang quản trị
        </a></div>
      <div class="sidebar-wrapper">

        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="./index.php">
              <i class="material-icons">dashboard</i>
              <p>Danh mục Sản phẩm</p>
            </a>
          </li>
        </ul>

        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="./item.php">
              <i class="material-icons">dashboard</i>
              <p>Sản phẩm</p>
            </a>
          </li>
        </ul>

      </div>
    </div>
    <div class="main-panel">


      <!-- Đây là thanh Logout -->
      <?php include (__DIR__ . '\inc\nav.php'); ?>


      <div class="content">
        <div class="container">
          <div class="row">

            <div class="col-9">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">TÊN DANH MỤC</th>
                    <th scope="col">THỰC THI</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Lấy tất cả danh mục sản phẩm -->
                  <?php
                    $cateAllName = new Category();
                    $showCate = $cateAllName->showAllCate();
                    if($showCate)
                    {
                      $i=0;
                      while($result = $showCate->fetch_assoc())
                      {
                        $i++;
                  ?>

                  <!-- Xóa danh mục sản phẩm -->
                  <?php
                    $cateDelete = new Category();
                    if(isset($_GET['dele_id']))
                    {
                        $id = $_GET['dele_id'];

                        $deleteCate = $cateDelete->deleteCategory($id);
                    }
                  ?>

                  <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $result['cateName'] ?></td>
                    <td>
                      <a href="cateEdit.php?cate_id=<?php echo $result['cate_id']?>">
                        <button class="btn btn-success">Edit</button>
                      </a>
                      <a href="?dele_id=<?php echo $result['cate_id']?>"
                        onclick="return confirm('Bạn có chắc là muốn xóa?')"
                      >
                        <button class="btn btn-danger">Delete</button>
                      </a>
                    </td>
                  </tr>
                  <?php 
                    }
                  } 
                  ?>
                </tbody>
              </table>
            </div>

            <div class="col-3">
                  <!-- Tạo danh mục sản phẩm mới -->
              <?php
              $cate = new Category();
              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $cateName = $_POST['cateName'];
                $insertCate = $cate->addCategory($cateName);
              }
              ?>

              <form action="index.php" method="post">
                <div class="mb-3">
                  <label class="form-label">
                    <h3>THÊM DANH MỤC</h3>
                    <?php
                    if (isset($insertCate)) {
                      echo $insertCate;
                    }
                    ?>
                  </label>
                  <input type="text" class="form-control" name="cateName">
                  <div id="emailHelp" class="form-text">Nhập danh mục mà bạn muốn thêm vào...</div>
                </div>

                <button type="submit" class="btn btn-primary">Thêm</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


</body>

</html>