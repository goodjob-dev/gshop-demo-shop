<div class="container main-content">
	<div class="row">
		<h1 class="page-title col-xs-3"><?php echo $title;?></h1>
	</div>
	<div class="row">

		<div class="add-product-layout col-xs-8">
				
		<?php if($product): ?>
			<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">

				

				<div class="form-group <?php if(form_error('title')) {echo "has-error";} ?>">
					<label for="title" class="col-lg-3 control-label">Title *</label>
					<div class="col-lg-9">
						<input type="text" name="title" id="title" class="form-control" value="<?php echo $product->title; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="select" class="col-lg-3 control-label">Category *</label>
					<div class="col-lg-9">
						<select class="form-control" id="select" name="category">
							<?php foreach($categories as $key => $value): ?>
								<?php if($product->category_id == $value->id): ?>
									<option value="<?php echo $value->id; ?>" selected><?php echo $value->title; ?></option>
								<?php else: ?>
									<option value="<?php echo $value->id; ?>"><?php echo $value->title; ?></option>
								<?php endif; ?>
								
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				
				<div class="form-group <?php if(form_error('regular_price')) {echo "has-error";} ?>">
					<label for="regular_price" class="col-lg-3 control-label">Regular Price *</label>
					<div class="col-lg-9">
						<input type="text" name="regular_price" id="regular_price" class="form-control" value="<?php echo $product->regular_price; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="sale_price" class="col-lg-3 control-label">Sale Price</label>
					<div class="col-lg-9">
						<input type="text" name="sale_price" id="sale_price" class="form-control" value="<?php echo $product->sale_price; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="product_image" class="col-lg-3 control-label">Product image</label>
					<div class="col-lg-9">
					<img src="/uploads/products/thumbs/<?php echo $product->image ?>" class="img-responsive" alt="Responsive image">
						<input type="file" name="product_image" id="product_image" class="form-control" value="">
					</div>
				</div>

				<div class="form-group">
					<label for="description" class="col-lg-3 control-label">Description</label>
					<div class="col-lg-9">
						<textarea id="description" name="description" class="form-control" rows="5"><?php echo $product->description; ?></textarea>
					</div>
				</div>
				
			
				<div class="form-group">
					<div class="col-lg-12">
						<input type="submit" name="edit_product" class="btn btn-success" value="Update">
						<a class="btn btn-warning" href="<?php echo base_url(); ?>manage/products">Cancel</a>
					</div>
				</div>

			</form>
		<?php else: ?>
			<div class="alert alert-dismissible alert-danger">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>There is no product matching give id</strong> <a href="/manage/products" class="alert-link">Browse all products</a>.
			</div>
		<?php endif; ?>
			
			

		
		</div>

	</div>
</div>
