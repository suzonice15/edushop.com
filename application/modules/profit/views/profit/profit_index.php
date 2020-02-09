<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">

        <form action="<?php echo base_url() ?>profit/ProfitController/index" name="order" method="post">
            <div class="row">


                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date From</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="date_from" name="date_from"
                                   class="form-control pull-right datepicker  "
                                   value=" ">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date To</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="date_to" name="date_to"
                                   class="form-control pull-right  datepicker "
                                   value=" ">
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <br>
                    <input type="submit" id="search" class="form-control btn btn-success" value="Submit">
                </div>
            </div>
        </form>

        <?php if (isset($results)){
        $total_sell = 0;
        $total_purcuse = 0;
        $total_profit = 0;
            $price = 0;
        foreach ($results as $result) {

            $total_purcuse +=  $result->purchase_price*$result->quantity;
           $price= str_replace(',', '', $result->product_price );
          
            $price=(float)$price;
            $total_sell += $price;

        }
            $total_profit = $total_sell-$total_purcuse;



            ?>
            <h3 style="text-align: center">Form :<?php echo $date_from;?>  <br>  To:<?php echo $date_to;?>     <br>  Total profit:<?php echo $total_profit;?></h3>


            <?php
        }
        ?>



    </div>
	<div class="box-body">
<div class="table-responsive">
		<table id="example1" class="table table-bordered table-striped table-responsive ">
			<thead>
			<tr>

				<th>Sl</th>
				<th>Product Name</th>
				<th>  Purchase Unit Price</th>
                <th>Quantity</th>
				<th>Purchase Price</th>
                <th>Sell Price</th>
                <th>Profit per product</th>
				<th>date</th>

			</tr>
			</thead>
			<tbody>
			<?php if (isset($results)){
            $count = 0;
                $total_purcuse_price=0;
                $profit_per_product=0;
                $total_count=0;
            $total_purcuse_price_by_profit=0;
                $total_sell_price=0;
            foreach ($results as $result) {
                $link=base_url().'product/'.$result->product_name;
                $total_purcuse_price += $result->purchase_price*$result->quantity;
                $total_purcuse_price_by_profit = $result->purchase_price*$result->quantity;
                $total_count +=$result->quantity;
             //   $total_sell_price +=$result->product_price;
                $price= str_replace(',', '', $result->product_price );

                $price=(float)$price;
                $profit_per_product = $price - $total_purcuse_price_by_profit;


    ?>
    <tr>
        <td><?php echo ++$count; ?></td>
        <td><a target="_blank" href="<?php echo $link;?>"><?php echo $result->product_title; ?></a></td>
        <td><?php echo $result->purchase_price; ?></td>
        <td><?php echo $result->quantity; ?></td>
        <td><?php echo $result->purchase_price*$result->quantity; ?></td>
        <td><?php echo $result->product_price; ?></td>
        <td><?php echo $profit_per_product; ?></td>
        <td><?php echo $result->modified_time; ?></td>
    </tr>

            <?php }

            ?>
              <tfoot>
                <tr>

                    <td> </td>
                    <td>Total :</td>
                    <td> </td>
                    <td><?php echo $total_count; ?></td>
                    <td><?php echo $total_purcuse_price; ?></td>

                    <td><?php echo $total_sell; ?></td>
                    <td><?php echo $total_profit; ?></td>
                    <td> </td>

                </tr>
            </tfoot>

                <?php

            }?>

            </tbody>

		</table>
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
		var categoryId = new Array();

		var allId = $('.checkAll').val();
		$('.checkAll').each(function () {
			if ($(this).is(":checked")) {
				categoryId.push(this.id);
			}
		});
		if (categoryId.length > 0) {
			$.ajax({

				url: '<?php echo base_url()?>category/categoryController/multipleDelete',
				data: {category_id: categoryId},
				type: 'post',
				success: function (data) {
					alert(data)
					window.location = '<?php echo base_url()?>category-list';
				}
			});
		} else {
		 alert("Select at least one product checkbox");

	}


	});

</script>
