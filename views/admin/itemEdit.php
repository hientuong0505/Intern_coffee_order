<?php
// require_once(__DIR__ . '\..\..\classes\item.php');
// require_once(__DIR__ . '\..\..\classes\category.php');

require_once(__DIR__ . '\..\..\router\index.php');
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
        Trang sản phẩm
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
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">
                            <i class="material-icons">dashboard</i>
                            <p>Danh mục Sản phẩm</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav">
                    <li class="nav-item active">
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
            <?php include(__DIR__ . '\inc\nav.php'); ?>


            <!-- Form thêm sản phẩm -->

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-9">
                            <!-- Hàm sửa sản phẩm -->
                            <?php

                            $item = new Item();
                            if (!isset($_GET['item_id']) || $_GET['item_id'] == NULL) {
                                echo "<script>window.location='item.php'</script>";
                            } else {
                                $id = $_GET['item_id'];
                            }
                            
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                
                                $updateItem = $item->updateItem($_POST, $_FILES, $id);
                            }
                            // var_dump($_GET['item_id']);
                            ?>

                            <?php
                                $get_item_by_id = $item->getItemById($id);
                                if($get_item_by_id)
                                {
                                    while ($resultItem = $get_item_by_id->fetch_assoc())
                                    {
                            ?>

                            <!-- Form thêm sản phẩm -->
                            <form action="" method="post" enctype="multipart/form-data" role="form">

                                <div class="mb-3">
                                    <label class="form-label">
                                        <h3>SỬA SẢN PHẨM</h3>
                                        <?php
                                        if (isset($updateItem)) {
                                            echo $updateItem;
                                        }
                                        ?>
                                    </label>

                                    <input type="text" class="form-control" name="itemName" value="<?php echo $resultItem['itemName'] ?>">
                                    <div id="emailHelp" class="form-text">Nhập tên sản phẩm</div>


                                    <select class="form-select mt-3" aria-label="Default select example" name="cate_id">
                                        <?php
                                        $cate = new Category();
                                        $cateList = $cate->showAllCate();
                                        if ($cateList) {
                                            while ($result = $cateList->fetch_assoc()) {

                                        ?>
                                        
                                                <option 
                                                    <?php 
                                                        if($result['cate_id'] == $resultItem['cate_id']) { echo 'selected'; }
                                                    ?>
                                                    value="<?php echo $result['cate_id'] ?>">--<?php echo $result['cateName'] ?>--
                                                </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div id="emailHelp" class="form-text">Nhập danh mục sản phẩm</div>

                                    <select class="form-select  mt-3" aria-label="Default select example" name="size">
                                        <!-- <option selected>Nhập size của sản phẩm</option> -->
                                        <?php 
                                            if($resultItem['size'] == "M")
                                            { 
                                        ?>
                                            <option selected value="M">M: nhỏ</option>
                                            <option value="X">X: vừa</option>
                                            <option value="L">L: lớn</option>  
                                        <?php 
                                            } 
                                            elseif($resultItem['size'] == "X") 
                                            { 
                                        ?> 
                                            <option value="M">M: nhỏ</option>  
                                            <option selected value="X">X: vừa</option>
                                            <option value="L">L: lớn</option>  
                                        <?php 
                                            } 
                                            else
                                            {
                                        ?>   
                                            <option value="M">M: nhỏ</option>  
                                            <option value="X">X: vừa</option>
                                            <option selected value="L">L: lớn</option>  
                                        <?php 
                                            } 
                                        ?>

                                    </select>
                                    <div id="emailHelp" class="form-text">Nhập kích cỡ sản phẩm</div>

                                    <input type="number" class="form-control  mt-3" name="price" value="<?php echo $resultItem['price'] ?>">
                                    <div id="emailHelp" class="form-text">Nhập giá của sản phẩm...</div>

                                    <img src="uploads/<?php echo $resultItem['image'] ?>" width="200" height="200">
                                    <input type="file" class="form-control  mt-3" name="image" >
                                    <div id="emailHelp" class="form-text">Nhập hình ảnh của sản phẩm...</div>

                                </div>

                                <button type="submit" class="btn btn-primary" value="update" name="submit">Sửa</button>
                            </form>
                            <?php  
                            }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>