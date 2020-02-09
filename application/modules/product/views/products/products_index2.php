<div class="col-md-12">
	<div class="box-body">
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-success">
						<div class="box-body">
							<form method="POST">
								<div class="btnarea">
									<div class="row">
										<div class="col-md-2 col-sm-6 col-xs-12 ">
											<a href="<?= base_url('product-create') ?>" class="btn btn-success">Add
												New</a>
											<input type="submit" name="delete" value="Delete" id="deleteAll"
												   onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')"
												   class="btn btn-danger" id="del_all" data-table="product"/>
										</div>
										<form action="<?php echo base_url()?>product-list"  method="post" id="main_products">

										<div class="col-md-5"  style="margin-left: 0px">
											<div class="form-group">
														<label for="sel1">Categories list:</label>
														<select style="width: 200px;" name="category_id" class="form-controld select2" id="sel1">
															<option value="">Select Category</option>
															<?php foreach ($category_lists as $category_list) { ?>

																<option  <?php if($category_id == $category_list->category_id) { echo 'selected';} else { echo '' ;} ?> value="<?php echo $category_list->category_id;?>"><?php echo $category_list->category_title;?></option>
															<?php } ?>
														</select>
											</div>
											</div>
											<div class="col-md-2 col-sm-6 col-xs-12 pull-right">
													<div class="form-group">
														<input type="submit" class="btn btn-success" value="Search">
													</div>
												</div>
										</form>
										<div class="col-md-2 col-sm-6 col-xs-12 pull-right">

											<input type="hidden"   placeholder="Search Products" id="search"

												   class="form-control" id="del_all" />
										</div>

									</div>
							</form>
								</div>


								<div  class="table-responsive">

								
									<table id="example1" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Sl</th>
											<th><input type="checkbox" id="checkAll"></th>
											<th>Product Code</th>
											<th>Product</th>
											<th hidden >Category</th>
											<th >Purchase Price</th>
											<th>Sell Price</th>
											<th>Discount Price</th>
											<th>Status</th>
											<th>Cration date</th>
											<th class="text-right">Action</th>
										</tr>
										</thead>
										<tbody>


										<?php
										if (isset($products)) {
											$html = NULL;
											$i = 0;

											foreach ($products as $prod) {
												$featured_image = get_product_meta($prod->product_id, 'featured_image');
												$featured_image = get_media_path($featured_image);
												$link=base_url().'product/'.$prod->product_name;

												?>
												<tr>
													<td><?php echo ++$i; ?>
													</td>
													<td>
														<input type="checkbox" id="singleId" class="checkAll"
															   value="<?php echo $prod->product_id ?>"/>
													</td>
													<td>
														<?php echo $prod->sku; ?>
													</td>

													<td>
														<img src="<?php echo $featured_image ?>" width="30"
															 height="30"/>
														&nbsp; <a  target="" href="<?php echo $link;?>"><?php echo $prod->product_title ?>
															</a>
													</td>



													<td  ><?php echo $prod->purchase_price; ?></td>

													<td><?php echo $prod->product_price; ?></td>
													<td><?php echo $prod->discount_price; ?></td>
													<td> <?php echo $prod->status; ?></td>
													<td> <?php echo $prod->created_time; ?></td>


													<td class="action text-right">


														<a title="edit"
														   href="<?php echo base_url() ?>product-edit/<?php echo $prod->product_id ?>"
														<span class="glyphicon glyphicon-edit btn btn-success"></span>
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


						</div>




					</div>
				</div>
			</div>
		</section>
	</div>

</div>

</div>
</div>










<script>

	//$('#checkAll').change(function () {
		$(document).on("change", "#checkAll", function(event){


			if ($(this).is(":checked")) {

			$('.checkAll').prop('checked', true);

		} else if ($(this).is(":not(:checked)")) {

			$('.checkAll').prop('checked', false);

		}

	});
	$('#deleteAll').click(function (e) {
		e.preventDefault();
		var productId = new Array();

		//var allId=$('.checkAll').val();
		$('.checkAll').each(function () {
			if ($(this).is(":checked")) {
				productId.push(this.value);
			}
		});

		$.ajax({

			url: '<?php echo base_url()?>product/ProductController/multipleDelete',
			data: {product_id: productId},
			type: 'post',
			success: function (data) {
				alert(data)
				window.location = '<?php echo base_url()?>product-list';
			}
		});


	});
	$(document).on('click', '#deleteSingleAll', function (e) {
		e.preventDefault();
		var productId = $('#singleId').val();

		$.ajax({

			url: '<?php echo base_url()?>product/ProductController/destroy',
			data: {product_id: productId},
			type: 'post',
			success: function (data) {
				alert(data)
				window.location = '<?php echo base_url()?>product-list';
			}
		});


	});

</script>

