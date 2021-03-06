<?php
include 'inc/header.php';
?>

<div class="fs_menu_overlay"></div>
<div class="hamburger_menu">
	<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
	<div class="hamburger_menu_content text-right">
		<ul class="menu_top_nav">
			<li class="menu_item has-children">
				<a href="#">
					usd
					<i class="fa fa-angle-down"></i>
				</a>

			</li>
			<li class="menu_item has-children">
				<a href="#">
					English
					<i class="fa fa-angle-down"></i>
				</a>

			</li>
			<li class="menu_item has-children">
				<a href="#">
					My Account
					<i class="fa fa-angle-down"></i>
				</a>
				<ul class="menu_selection">
					<li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
					<li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
				</ul>
			</li>

		</ul>
	</div>
</div>

<!-- Slider -->

<!-- <div class="main_slider" style="background-image:url(images/slider_1.jpg)">
		<div class="container fill_height">
			<div class="row align-items-center fill_height">
				<div class="col">
					<div class="main_slider_content">
						<h6>Spring / Summer Collection 2017</h6>
						<h1>Get up to 30% Off New Arrivals</h1>
						<div class="red_button shop_now_button"><a href="#">shop now</a></div>
					</div>
				</div>
			</div>
		</div> -->
</div>

<!-- New Arrivals -->

<div class="new_arrivals">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="section_title new_arrivals_title">

					<div class="d-flex justify-content-center h-100">
						<div class="searchbar">
							<input class="search_input" type="text" name="" placeholder="Search...">
							<a href="#" class="search_icon"><i class="fas fa-search"></i></a>
						</div>
					</div>
					<h2>Sản phẩm</h2>
					
				</div>
			</div>
		</div>
		<div class="row align-items-center">
			<div class="col text-center">
				<div class="new_arrivals_sorting">
					<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
						<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
						<a href="./cart.php">
							<i class="fas fa-cart-plus fa-3x"></i>
						</a>
					</ul>
				</div>
			</div>
		</div>
		<?php
			$setItem = $item->get_all_item();
			$resultItem = $setItem->fetch_assoc();

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$quantity = $_POST['quantity'];
				$addToCart = $cart->addToCart($quantity, $resultItem['item_id']);
			}
		?>
		<div class="row">
			<div class="col">
				<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

					<!-- Product 1 -->
					<?php
					$getItem = $item->get_all_item();
					if ($getItem) {
						while ($result = $getItem->fetch_assoc()) {
							
					?>
							<!-- <?php 
								// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
								// 	$setItem = $item->getItemById($result['item_id']);
								// 	$resultItem = $setItem->fetch_assoc();

								// 	$quantity = $_POST['quantity'];
								// 	$addToCart = $cart->addToCart($quantity, $resultItem['item_id']);
								// }
							?> -->


							<div class="product-item men mt-3">
								<div class="product discount product_filter">
									<div class="product_image">
										<img src="views/admin/uploads/<?php echo $result['image'] ?>" width="100" height="150">
									</div>
									<div class="product_info">
										<input type="hidden" value="<?php echo $result['item_id'] ?>">
										<h6 class="product_name"> <?php echo $result['itemName'] ?> </h6>
										<div class="product_price"> <?php echo $fm->currency_format($result['price']) ?></span></div>
										<div class="product_price"> Size: <?php echo $result['size'] ?> </span></div>

									</div>
								</div>
								<form action="" method="post">
									<div class="red_button add_to_cart_button">
										<input type="hidden" value="1" name="quantity" min="1">
										<input type="submit" value="Thêm vào giỏ" name="submit">
										
									</div>
								</form>
							</div>
					<?php
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

include 'inc/footer.php';
?>