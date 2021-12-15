<?php
include 'inc/header.php';
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <h3>Giỏ hàng</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Size</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $get_item_cart = $cart->showAllCart();
                        if($get_item_cart){
                            while ($result = $get_item_cart->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $result['itemName'] ?></td>
                        <td><img src="views/admin/uploads/<?php echo $result['image'] ?>" height="80" width="80" ></td>
                        <td><?php echo $result['price'] ?></td>
                        <td><?php echo $result['size'] ?></td>
                        <td><?php echo $result['quantity'] ?></td>
                        <td>asdasd</td>
                        <td>
                            X
                        </td>
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
        <div class="col-2"></div>
    </div>
</div>



