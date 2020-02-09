<div class="col-md-12">
<div class="box-body">
		<section class="content">
			<div class="row">

					<div class="box box-success">
						<div class="box-body">
							<form method="POST">

								</div>
								<br/>
								 	<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Sl</th>
											<th>Sku</th>
											<th>Product</th>
											<th>Purchase price</th>
											<th>Product quantity</th>
											<th>Per Product total Purchase  price</th>
											<th>Per Product Sell  price</th>
											<th>Per Product total Sell  price</th>
											<th>Per Product profit </th>
										</tr>
										</thead>
										<tbody>
										<?php
										if(isset($products))
										{
											$html=NULL;
											$total=NULL;
											$i=0;
											$total_purchess_price=0;
											$total_product_quantiy=0;
											$total_price=0;
											$sell_price=0;
											$total_sell_price=0;
											$total_sell_price_by_product=0;
											$total_sell_price_by_product_total=0;
											$perproductProfit=0;
											$totalPerproductProfit=0;

											foreach($products as $prod)
											{


												$purchase_price = $prod->purchase_price;
												$total_purchess_price +=$purchase_price;
												$product_title=$prod->product_title;
												$stock_qty=$prod->product_stock;
												$total_amount=$stock_qty * $purchase_price;
												$total_price += $total_amount;
												$total_product_quantiy +=$stock_qty;
												if($prod->discount_price){
													$sell_price=$prod->discount_price;
												} else {
													$sell_price=$prod->product_price;

												}
												$total_sell_price +=$sell_price;
												$total_sell_price_by_product=$stock_qty * $sell_price;
												$total_sell_price_by_product_total +=$total_sell_price_by_product;
												$perproductProfit =$total_sell_price_by_product-$total_amount;
												$totalPerproductProfit +=$perproductProfit;

												$html.='<tr>
											 
												<td>'.++$i.'</td>
												<td>'.$prod->sku.'</td>
												<td>
												 &nbsp; '.$product_title.'
												</td>';
												$html.='<td>'.$purchase_price.'</td>';
												$html.='
												<td>'.$stock_qty.'</td>';
												$html.='<td>'.$total_amount.'</td><td>'.$sell_price.'</td><td>'.$total_sell_price_by_product.'</td><td>'.$perproductProfit.'</td></tr>';
											}
										$total ='<tr>
											<td>'.++$i .'</td>
										<td></td>
										<td>Total</td>


										<td>'.$total_purchess_price .'</td>
										<td>'. $total_product_quantiy .'</td>
										<td>'. $total_price.'</td>
										<td>'. $total_sell_price.'</td>
										<td>'. $total_sell_price_by_product_total.'</td>
										<td>'. $totalPerproductProfit.'</td>
										</tr>';

											echo $html.$total;

										}
										?>
										</tbody>

									</table>
								</div>
							</form>
						</div>
				</div>
			</div>
		</section>
	</div>

</div>

</div>
</div>


<script>

	$('#checkAll').change(function(){

		if($(this).is(":checked")){

			$('.checkAll').prop('checked',true);

		}

		else if($(this).is(":not(:checked)")){

			$('.checkAll').prop('checked',false);

		}

	});
	$('#deleteAll').click(function (e) {
		e.preventDefault();
		var url      = window.location.href;     // Returns full URL (https://example.com/path/example.html)
		var  productId = new Array();

		//var allId=$('.checkAll').val();
		$('.checkAll').each(function(){
			if($(this).is(":checked")) {
				productId.push(this.value);
			}
		} );
if(productId.length >0) {
	$.ajax({

		url: '<?php echo base_url()?>product/ProductController/deleteBadProduct',
		data: {stock_id: productId},
		type: 'post',
		success: function (data) {
			alert(data)
			window.location = url;
		}
	});
} else {
	alert("select the product list");
}


	});
	$(document).on( 'click','#deleteSingleAll',function (e) {
		e.preventDefault();
		var productId =$('#singleId').val();

		$.ajax({

			url:'<?php echo base_url()?>product/ProductController/destroy',
			data:{product_id:productId},
			type:'post',
			success:function (data) {
				alert(data)
				window.location = url;
			}
		});


	});

</script>
