<div class="container">
	<div class="row">
		<div class="product col-lg-2">
			<div class="top-block">
				<a href="#">
					<img class="img-responsive" src="uploads/products/pr6.jpg">
				</a>
			</div>
			<div class="bottom-block">
				<div class="product-info">
					<h5><a href="#">Morbi euismod congue</a></h5>
					<div class="product-price">
						<span class="old-price">$50.99</span>
						<span class="price bold">$50.99</span>
					</div>
					<div class="product-addcart">
						<a class="button btn addtocart-btn" href="#">
							<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
							<span>Add to cart</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="product col-lg-2 col-lg-offset-1">
			<div class="top-block">
				<a href="#">
					<img class="img-responsive" src="uploads/products/pr6.jpg">
				</a>
			</div>
			<div class="bottom-block">
				<div class="product-info">
					<h5><a href="#">Morbi euismod congue</a></h5>
					<div class="product-price">
						<span class="old-price">$50.99</span>
						<span class="price bold">$50.99</span>
					</div>
					<div class="product-addcart">
						<a class="button btn addtocart-btn" href="#">
							<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
							<span>Add to cart</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="product col-lg-2 col-lg-offset-1">
			<div class="top-block">
				<a href="#">
					<img class="img-responsive" src="uploads/products/pr6.jpg">
				</a>
			</div>
			<div class="bottom-block">
				<div class="product-info">
					<h5><a href="#">Morbi euismod congue</a></h5>
					<div class="product-price">
						<span class="old-price">$50.99</span>
						<span class="price bold">$50.99</span>
					</div>
					<div class="product-addcart">
						<a class="button btn addtocart-btn" href="#">
							<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
							<span>Add to cart</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="product col-lg-2 col-lg-offset-1">
			<div class="top-block">
				<a href="#">
					<img class="img-responsive" src="uploads/products/pr6.jpg">
				</a>
			</div>
			<div class="bottom-block">
				<div class="product-info">
					<h5><a href="#">Morbi euismod congue</a></h5>
					<div class="product-price">
						<span class="old-price">$50.99</span>
						<span class="price bold">$50.99</span>
					</div>
					<div class="product-addcart">
						<a class="button btn addtocart-btn" href="#">
							<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
							<span>Add to cart</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container main-content">
	<div class="row">

		<?php 
			echo $sidebar;
		?>

		<div class="product-layout col-sm-9 col-md-9">
			
			<h1 class="search-h1">Search&nbsp;
				<span class="heading-counter"><?=count($products);?> results have been found.</span>
			</h1>

			<?php if($products): ?>
				<div class="products col-sm-12 col-md-12">

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

				</div>
			<?php else: ?>
				<p class="alert alert-warning">
					Please enter a search keyword
				</p>
			<?php endif; ?>
		</div>

	</div>
</div>