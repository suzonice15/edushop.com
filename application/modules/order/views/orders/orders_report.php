<div class="col-md-offset-0 col-md-12">
	<div class="box  box-success">
		<div class="box-header with-border  ">

			<?php

			function order_status($id)
			{
				$array_value = Array(
					'new' => 'New',
					'pending_payment' => 'Pending for Payment',
					'processing' => 'On Process',
					'on_courier' => 'With Courier',
					'delivered' => 'Delivered',
					'completed' => 'Completed',
					'refund' => 'Refunded',
					'cancled' => 'Cancelled'


				);
				echo $array_value[$id];
			}

			?>


			<form action="<?php echo base_url() ?>order-list-report" name="order" method="post">
				<div class="row">
					<div class="col-md-2">

					</div>
					<div class="col-md-3">
<h4 style="background-color: red;margin-top: -1px;padding: 8px;text-align: center;color: white;">Select date first   >></h4>
						</div>
					<div class="col-md-4">
						<div class="input-group">
							<button type="button" class="btn btn-default pull-left" id="reportrange">
								<span></span>
								<i class="fa fa-caret-down"></i>
							</button>

							<input type="hidden" name="from" id="from" value="">
							<input type="hidden" name="to" id="to" value="">
						</div>
					</div>

						<div class="col-md-3">

							<h4 id="total_price_hide" style="display: none">Total:<span id="total"></span></h4>

					</div>





				</div>
			</form>


		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table id="example11" class="table table-bordered table-striped">
					<thead>
					<tr>
						<th>Sl</th>
						<th>Order Id</th>
						<th>Customer</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Amount</th>
						<th>Date & Time</th>

					</tr>
					</thead>
					<tbody>

					
					</tbody>
				</table>

			</div>
			<p id="data"></p>

		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
 		$('#reportrange').daterangepicker(
			{
				startDate: moment().subtract('days', 29),
				endDate: moment(),
				minDate: '01/01/2020',
				maxDate: '12/31/2020',
				dateLimit: { days: 60 },
				showDropdowns: true,
				showWeekNumbers: true,
				timePicker: false,
				timePickerIncrement: 1,
				timePicker12Hour: true,
				ranges: {

					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
					'Last 7 Days': [moment().subtract('days', 6), moment()],
					'Last 30 Days': [moment().subtract('days', 29), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],

				},
				opens: 'right',
				buttonClasses: ['btn btn-default'],
				applyClass: 'btn-small btn-primary',
				cancelClass: 'btn-small',
				format: 'MM/DD/YYYY',
				separator: ' to ',
				locale: {
					applyLabel: 'Submit',
					fromLabel: 'From',
					toLabel: 'To',
					customRangeLabel: 'Custom Range',
					daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
					monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
					firstDay: 1
				}
			},
			function(start, end) {
				console.log("Callback has been called!");
				$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

				$('#from').val(start.format('Y-MM-DD'));
				var from=$('#from').val();
				$('#to').val(end.format('Y-MM-DD'));
				var to=$('#to').val();


				function load_data(){
					$.ajax({
						type: "POST",
						url:"<?php echo base_url()?>order/OrderReportController/orderReport",
						dataType:"JSON",
						data:{from:from,to:to},
						success:function (data) {
							var  html ='';
							var total=0;
							$('#total_price_hide').show();



							$.each(data['product'],function (key,value) {
								total =total+ parseFloat(value['order_total']);


							key++;

							html +='<tr><td>'+key+'</td><td>'+value['order_id']+'</td><td>'+value['customer_name']+'</td>\
								<td>'+value['customer_phone']+'</td> \
								<td>'+value['customer_address']+'</td><td>'+value['order_total']+'</td><td>'+value['modified_time']+'</td><tr>';
						});
							html +='<tr><td></td><td></td><td></td><td></td>\
								<td>Total</td><td>'+total+'</td><td></td><tr>';

						$("#total").html(total);
						$("#example11 tbody").empty();

						$("#example11 tbody").append(html);


						},
						error:function (data) {

						}
					});

				}
				load_data();

			}
		);
		//Set the initial state of the picker label
		$('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
	});
</script>

