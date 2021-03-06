<div class="container main-content">
	<div class="row">

		<?php 
			echo $sidebar;
		?>

		<div class="product-layout col-sm-9 col-md-9">
			<!-- <ul class="product-tabs">
				<li><a href="/" class="product-newproducts"><span></span>New Arrivals</a></li>
				<li><a href="/" class="product-sale"><span></span>Sale Products</a></li>
				<li><a href="/" class="product-bestseller"><span></span>Best Seller</a></li>
			</ul>
			<div class="clear"></div> -->
			<div class="products col-sm-12 col-md-12">

				<?php if($products): ?>
					<?php foreach($products as $key => $value): ?>
						<div class="product col-lg-3 col-md-4 col-sm-10">
							<div class="top-block">
								<a href="/product/<?php echo $value->id; ?>">
									<img class="img-responsive" src="/uploads/products/thumbs/<?php echo $value->image; ?>">
								</a>
							</div>
							<div class="bottom-block">
								<div class="product-info">
									<h5><a href="/product/<?php echo $value->id; ?>"><?php echo $value->title; ?></a></h5>
									<div class="product-price">
										<?php if($value->sale_price == 0): ?>
											<span class="price bold">$<?php echo $value->regular_price ?></span>
										<?php else: ?>
											<span class="old-price">$<?php echo $value->regular_price ?></span>
											<span class="price bold">$<?php echo $value->sale_price ?></span>
										<?php endif; ?>
									</div>
									<div class="product-addcart">
										<a class="button btn addtocart-btn" href="#" data-id="<?php echo $value->id ?>">
											<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
											<span>Add to cart</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

				<?php else: ?>
					No products
				<?php endif; ?>




			</div>

			<div class="pagination col-sm-12 col-md-12">
				<a href="#" class="simvols"> < prev </a>

				<div class="numbers">
					<a href="#"> <span>1</span> </a>
					<span>2</span>
					<a href="#"><span>3</span> </a>
				</div>
				

				<a href="#" class="simvols">next > </a>
			</div>
		</div>

	</div>
</div>
