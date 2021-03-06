<?php
	class _ProductController extends Gs_Controller
	{
		/**
		 * Product limit for each page
		*/
		private $pr_l = 5;
		
		public function __construct()
		{
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->model( 'manage/_products' );
		}
		
		public function index()
		{
			$p = $this->input->get('p');
			$l = $this->pr_l;
			$o = 0;
			
			if( null !== $p )
			{
				$l = $this->pr_l;
				$o = $l * $p;
			}
			
		
			$this->render('products', 
			[
				'title'    => 'Products',
				'products' => $this->_products->getAll( $l, $o )
			]);
		}

		public function add()
		{
			
			$config = array(
				array(
					'field'	=> 'title', 
					'label'	=> 'Title', 
					'rules'	=> 'required'
				),
				array(
					'field'		=> 'category', 
					'label'		=> 'Category *', 
					'rules'		=> 'required'
				),
				array(
					'field'		=> 'regular_price', 
					'label'		=> 'Regular Price', 
					'rules'		=> 'required|numeric'
				),
				array(
					'field'		=> 'sale_price', 
					'label'		=> 'Sale Price', 
					'rules'		=> 'numeric'
				)
			);

			$this->form_validation->set_rules($config);

			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model( 'Category' );
				$categories = $this->Category->getAllCategories();

				$this->render('add-product', 
				[
					'title'    => 'Add product',
					'categories' => $categories
				], 'form');
			}
			else
			{
				if($this->input->post('add_product'))
				{	
					/* post */
					$post = $this->input->post();

					/* upload config */
					$extension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);

					$uploadConfig['upload_path']		= './uploads/products';
					$uploadConfig['allowed_types']		= 'gif|jpg|jpeg|png';
					$uploadConfig['file_name']			= md5($_FILES['product_image']['name'] . time()) . '.' . $extension;

					$this->load->library('upload', $uploadConfig);
					if($this->upload->do_upload('product_image')) {
						/* image config */
						$imageConfig['image_library']	= 'gd2';
						$imageConfig['source_image']	= './uploads/products/' . $uploadConfig['file_name'];
						$imageConfig['new_image']		= './uploads/products/thumbs/';
						$imageConfig['create_thumb']	= TRUE;
						$imageConfig['thumb_marker']	= NULL;
						$imageConfig['maintain_ratio']	= TRUE;
						$imageConfig['width']			= 172;
						$imageConfig['height']			= 172;

						$this->load->library('image_lib', $imageConfig); 

						$this->image_lib->resize();
					}


					/* mysql */
					$sql1 = "INSERT INTO gs_products (`category_id`, `title`, `regular_price`, `sale_price`, `create_date`, `image`) VALUES (?, ?, ?, ?, ?, ?)";
					$sql2 = "INSERT INTO gs_product_info (`product_id`, `description`) VALUES (LAST_INSERT_ID(), ?)";
					$sql3 = "INSERT INTO gs_product_analytics (`product_id`) VALUES (LAST_INSERT_ID())";

					$this->db->trans_start();
						$this->db->query($sql1, array($post['category'], $post['title'], $post['regular_price'], $post['sale_price'], time(), $uploadConfig['file_name']));
						$this->db->query($sql2, array($post['description']));
						$this->db->query($sql3);
					$this->db->trans_complete();

				}

				$this->request->redirectTo(base_url() . "manage/products");
				
			}
			
		}


		public function edit($id)
		{
			$config = array(
				array(
					'field'	=> 'title', 
					'label'	=> 'Title', 
					'rules'	=> 'required'
				),
				array(
					'field'		=> 'category', 
					'label'		=> 'Category *', 
					'rules'		=> 'required'
				),
				array(
					'field'		=> 'regular_price', 
					'label'		=> 'Regular Price *', 
					'rules'		=> 'required'
				)
			);
			$this->form_validation->set_rules($config);


			$this->load->model( 'Category' );
			
			
			$categories = $this->Category->getAllCategories();
			$product = $this->_products->getProductByID($id);

			if ($this->form_validation->run() == FALSE)
			{
				
				$this->render('edit-product', 
				[
					'title'			=> 'Edit product',
					'categories'	=> $categories,
					'product'		=> $product
				], 'form');
			}
			else
			{
				if($this->input->post('edit_product'))
				{
					/* post */
					$post = $this->input->post();

					/* upload config */
					if($_FILES['product_image']['name'] == null) {
						$_productImage = $product->image;
					} else {
						$old_image_name = $product->image;
						@unlink('./uploads/products/' . $old_image_name);
						@unlink('./uploads/products/thumbs/' . $old_image_name);
						$extension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);

						$uploadConfig['upload_path']		= './uploads/products';
						$uploadConfig['allowed_types']		= 'gif|jpg|jpeg|png';
						$uploadConfig['file_name']			= md5($_FILES['product_image']['name'] . time()) . '.' . $extension;

						$this->load->library('upload', $uploadConfig);
						if($this->upload->do_upload('product_image')) {
							/* image config */
							$imageConfig['image_library']	= 'gd2';
							$imageConfig['source_image']	= './uploads/products/' . $uploadConfig['file_name'];
							$imageConfig['new_image']		= './uploads/products/thumbs/';
							$imageConfig['create_thumb']	= TRUE;
							$imageConfig['thumb_marker']	= NULL;
							$imageConfig['maintain_ratio']	= TRUE;
							$imageConfig['width']			= 172;
							$imageConfig['height']			= 172;

							$this->load->library('image_lib', $imageConfig); 

							$this->image_lib->resize();
						}

						$_productImage = $uploadConfig['file_name'];
					}

					echo $_productImage;


					/* mysql */

					$sql1 = "UPDATE gs_products SET `category_id` = ?, `title` = ?, `regular_price` = ?, `sale_price` = ?, `image` =? WHERE `id` = ?";
					$sql2 = "UPDATE gs_product_info SET `description` = ? WHERE `product_id` = ?";

					$this->db->trans_start();
						$this->db->query($sql1, array($post['category'], $post['title'], $post['regular_price'], $post['sale_price'], $_productImage, $id));
						$this->db->query($sql2, array($post['description'], $id));
					$this->db->trans_complete();

					$this->request->redirectTo(base_url() . "manage/products");


				}
			}
		}

		public function delete($id)
		{
			if($id)
			{
				$product = $this->_products->getProductByID($id);
				@unlink('./uploads/products/' . $product->image);
				@unlink('./uploads/products/thumbs/' . $product->image);
				$this->db->delete('gs_products', array('id' => $id));
			}
			$this->request->redirectTo(base_url() . "manage/products");
		}

		public function on($id) {
			if($id) {
				$this->db->set('availability', '1', FALSE);
				$this->db->where('id', $id);
				$this->db->update('gs_product_info');
			}
			$this->request->redirectTo(base_url() . "manage/products");
		}

		public function off($id) {
			if($id) {
				$this->db->set('availability', '0', FALSE);
				$this->db->where('id', $id);
				$this->db->update('gs_product_info');
			}
			$this->request->redirectTo(base_url() . "manage/products");
		}

	}





?>