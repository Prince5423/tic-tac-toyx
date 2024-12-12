<?php
include "header.php";
?>
<!-- /BREADCRUMB -->
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$(".scroll").click(function (event) {
			event.preventDefault();
			$('html,body').animate({ scrollTop: $(this.hash).offset().top }, 900);
		});
	});
</script>
<script>

	(function (global) {
		if (typeof (global) === "undefined") {
			throw new Error("window is undefined");
		}
		var _hash = "!";
		var noBackPlease = function () {
			global.location.href += "#";
			// making sure we have the fruit available for juice....
			// 50 milliseconds for just once do not cost much (^__^)
			global.setTimeout(function () {
				global.location.href += "!";
			}, 50);
		};
		// Earlier we had setInerval here....
		global.onhashchange = function () {
			if (global.location.hash !== _hash) {
				global.location.hash = _hash;
			}
		};
		global.onload = function () {
			noBackPlease();
			// disables backspace on page except on input fields and textarea..
			document.body.onkeydown = function (e) {
				var elm = e.target.nodeName.toLowerCase();
				if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
					e.preventDefault();
				}
				// stopping event bubbling up the DOM tree..
				e.stopPropagation();
			};
		};
	})(window);
</script>

<!-- SECTION -->
<div class="section main main-raised">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->

			<?php
			include 'db.php';
			$product_id = $_GET['p'];

			$sql = " SELECT * FROM products AS P,categories AS C WHERE P.product_cat = C.cat_id  AND P.product_id = '$product_id'";
			if (!$con) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo '
									
                                    
                                
                                <div class="col-md-5 col-md-push-2">
                                <div id="product-main-img">
                                    <div class="product-preview">
                                        <img src="product_images/' . $row['product_image'] . '" alt="">
                                    </div>

                                </div>
                            </div>
                                
                                <div class="col-md-2  col-md-pull-5">
                                <div id="product-imgs">
                                    <div class="product-preview">
                                        <img src="product_images/' . $row['product_image'] . '" alt="">
                                    </div>

                                    
                                </div>
                            </div>

                                 
									';

					?>
					<!-- FlexSlider -->

					<?php
					echo '
									
                                    
                                   
							<div class="col-md-5">
								<div class="product-details">
									<h2 class="product-name">' . $row['product_title'] . '</h2>
									<div>
										<h3 class="product-price">Rs.' . $row['product_price'] . '</h3>
										<span class="product-available">In Stock</span>
									</div>

									

									<div class="add-to-cart">
										<div class="qty-label">
    Qty
    <form method="POST" action="update_quantity.php">
        <div class="input-number">
            <input type="number" name="quantity" value="1" min="1" max="100" required>
            <button type="submit" class="qty-up">+</button>
            <button type="submit" class="qty-down">-</button>
        </div>
        <input type="hidden" name="product_id" value="123"> <!-- Hidden field for product ID -->
    </form>
</div>

										<div class="btn-group" style="margin-left: 25px; margin-top: 15px">
										<button class="add-to-cart-btn" pid="' . $row['product_id'] . '"  id="product" ><i class="fa fa-shopping-cart"></i> add to cart</button>
										</div>
										
										
									</div>


									<ul class="product-links">
										<li>Category:</li>
										<li><a href="#">' . $row["cat_title"] . '</a></li>
									</ul>

									<ul class="product-links">
										<li>Share:</li>
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
										<li><a href="#"><i class="fa fa-envelope"></i></a></li>
									</ul>

								</div>
							</div>
							';
					$_SESSION['product_id'] = $row['product_id'];
				}
			}
			?>


			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<!-- <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li> -->
						<!-- <li><a data-toggle="tab" href="#tab2">Details</a></li> -->
						<?php
						include 'db.php';
						$product_id = $_GET['p'];

						$product_query = "SELECT COUNT(*) AS count FROM reviews WHERE product_id='$product_id'";
						$run_query = mysqli_query($con, $product_query);
						$row = mysqli_fetch_array($run_query);
						$reviews_count = $row["count"];
						echo '<li><a data-toggle="tab" href="#tab3">Reviews (' . $reviews_count . ')</a></li>';
						?>

					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<!-- <div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										</div>
									</div>
								</div> -->
						<!-- /tab1  -->

						<!-- tab2  -->
						<div id="tab2" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-12">
								</div>
							</div>
						</div>
						<!-- /tab2  -->

						<!-- tab3  -->
						<div id="tab3" class="tab-pane fade in">
							<div class="row">
								<!-- Rating -->
								<div id="review_action" pid='<?php echo "$product_id"; ?>'></div>

								<!-- Review Form -->
								<div class="col-md-3 mainn">
									<div id="review-form">
										<form class="review-form" onsubmit="return false" id="review_form" required>
											<input class="input" type="text" name="name" placeholder="Your Name"
												required>
											<input class="input" type="email" name="email" placeholder="Your Email"
												required>
											<input name="product_id" value="<?php echo $product_id; ?>" type="hidden"
												required>
											<textarea class="input" name="review" placeholder="Your Review"
												required></textarea>
											<div class="input-rating">
												<span>Your Rating: </span>
												<div class="stars">
													<input id="star5" name="rating" value="5" type="radio"
														required><label for="star5"></label>
													<input id="star4" name="rating" value="4" type="radio"
														required><label for="star4"></label>
													<input id="star3" name="rating" value="3" type="radio"
														required><label for="star3"></label>
													<input id="star2" name="rating" value="2" type="radio"
														required><label for="star2"></label>
													<input id="star1" name="rating" value="1" type="radio"
														required><label for="star1"></label>
												</div>
											</div>
											<button class="primary-btn" name="review_submit">Submit</button>
										</form>
										<div id="review_message"></div> <!-- Message display -->
									</div>
								</div>
								<!-- /Review Form -->
							</div>
						</div>

						<script>
							$(document).ready(function () {
								$('#review_form').on('submit', function (e) {
									e.preventDefault(); // Prevent the default form submission
									$.ajax({
										type: 'POST',
										url: '', // Submit to the same page
										data: $(this).serialize(), // Serialize the form data
										success: function (response) {
											$('#review_message').html('<div class="alert alert-success">Review submitted successfully!</div>');
											$('#review_form')[0].reset(); // Reset the form
										},
										error: function () {
											$('#review_message').html('<div class="alert alert-danger">Error submitting review. Please try again.</div>');
										}
									});
								});
							});
						</script>

						<?php
						// Process the review submission
						if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['review_submit'])) {
							include 'db.php'; // Include your database connection
							$name = mysqli_real_escape_string($con, $_POST['name']);
							$email = mysqli_real_escape_string($con, $_POST['email']);
							$review = mysqli_real_escape_string($con, $_POST['review']);
							$product_id = mysqli_real_escape_string($con, $_POST['product_id']);
							$rating = mysqli_real_escape_string($con, $_POST['rating']);

							$sql = "INSERT INTO reviews (product_id, name, email, review, rating) VALUES ('$product_id', '$name', '$email', '$review', '$rating')";

							if (mysqli_query($con, $sql)) {
								echo "Review submitted successfully!";
							} else {
								echo "Error: " . mysqli_error($con);
							}
						}
						?>

						<!-- /tab3  -->
					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section main main-raised">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-12">
				<div class="section-title text-center">
					<h3 class="title">Related Products</h3>

				</div>
			</div>

			<?php
			include 'db.php';
			$product_id = $_GET['p'];

			$product_query = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_id BETWEEN $product_id AND $product_id+3";
			$run_query = mysqli_query($con, $product_query);
			if (mysqli_num_rows($run_query) > 0) {

				while ($row = mysqli_fetch_array($run_query)) {
					$pro_id = $row['product_id'];
					$pro_cat = $row['product_cat'];
					$pro_title = $row['product_title'];
					$pro_price = $row['product_price'];
					$pro_image = $row['product_image'];

					$cat_name = $row["cat_title"];

					echo "
				
                        
                                <div class='col-md-3 col-xs-6'>
								<a href='product.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
										<div class='product-label'>
											<span class='new'>NEW</span>
										</div>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>Rs.$pro_price</h4>
										
										<div class='product-btns'>
											<button pid='$pro_id' id='wishlist' class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button>
										</div>
									</div>
									<div class='add-to-cart'>
										<button pid='$pro_id' id='product' class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i> add to cart</button>
									</div>
								</div>
                                </div>
							
                        
			";
				}
				;

			}
			?>
			<!-- product -->

			<!-- /product -->

		</div>
		<!-- /row -->

	</div>
	<!-- /container -->
</div>
<!-- /Section -->

<!-- NEWSLETTER -->

<!-- /NEWSLETTER -->

<!-- FOOTER -->
<?php
include "footer.php";

?>