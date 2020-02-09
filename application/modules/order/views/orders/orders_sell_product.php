<div class="col-md-offset-0 col-md-12">
    <div class="box  box-success">
        <div class="box-header with-border  ">


            <form action="<?php echo base_url() ?>order-list-report" name="order" method="post">
                <div class="row">

                    <div class="col-md-4">
                        <br>

                        <select class="form-control select2" name="product_id" id="product_id">
                            <?php if (isset($product)) {
                                foreach ($product as $pro):
                                    ?>
                                    <option
                                        value="<?php echo $pro->product_id; ?>"><?php echo $pro->product_title; ?></option>
                                    <?php
                                endforeach;
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date From</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="date_from" name="date_from"
                                       class="form-control pull-right withoutFixedDate  "
                                       value=" ">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date To</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="date_to" name="date_to"
                                       class="form-control pull-right  withoutFixedDate "
                                       value=" ">
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <br>
                        <input type="button" id="search" class="form-control btn btn-success" value="Submit">


                    </div>
                    <div class="col-md-6">


                        <h4 id="total_price_hide">Total:<span id="total"></span></h4>

                    </div>


                </div>
            </form>


        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="example11" class="table table-bordered ">
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
    $(document).ready(function () {

        $(document).on('change', '#product_id', function () {
            var product_id = $(this).val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>order/OrderReportController/sellProductReport",
                dataType: "JSON",
                data: {product_id: product_id},
                success: function (data) {
                    var html = '';
                    var total = 0;
                    $('#total_price_hide').show();
                    $.each(data['product'], function (key, value) {
                        total = total + parseFloat(value['order_total']);
                        key++;
                        html += '<tr><td>' + key + '</td><td>' + value['order_id'] + '</td><td>' + value['customer_name'] + '</td>\
								<td>' + value['customer_phone'] + '</td> \
								<td>' + value['customer_address'] + '</td><td>' + value['order_total'] + '</td><td>' + value['modified_time'] + '</td><tr>';
                    });

                    html += '<tr><td></td><td></td><td></td>\
								<td></td> \
								<td>Total</td><td>' + total + '</td><td></td><tr>';
                    $("#total").html(total);
                    $("#example11 tbody").empty();
                    $("#example11 tbody").append(html);
                },
                error: function (data) {

                }
            });

        });

        $('#search').on('click', function () {
            var from = $('#date_from').val();
            var to = $('#date_to').val();
            var product_id = $('#product_id').val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>order/OrderReportController/sellProductReportByDate",
                dataType: "JSON",
                data: {product_id: product_id, from: from, to: to},
                success: function (data) {

                    var html = '';
                    var total = 0;

                    $.each(data['product'], function (key, value) {
                        total = total + parseFloat(value['order_total']);
                        key++;
                        html += '<tr><td>' + key + '</td><td>' + value['order_id'] + '</td><td>' + value['customer_name'] + '</td>\
								<td>' + value['customer_phone'] + '</td> \
								<td>' + value['customer_address'] + '</td><td>' + value['order_total'] + '</td><td>' + value['modified_time'] + '</td><tr>';
                    });
                    html += '<tr><td></td><td></td><td></td>\
								<td></td> \
								<td>Total</td><td>' + total + '</td><td></td><tr>';

                    $("#total").html(total);
                    $("#example11 tbody").empty();
                    $("#example11 tbody").append(html);
                },
                error: function (data) {

                }
            });


        });
    });

</script>

