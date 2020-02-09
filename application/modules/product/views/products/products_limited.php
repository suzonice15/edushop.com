<div class="col-md-offset-0 col-md-12">
   
    <div class="box-body">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4 pull-right">
                                    <input type="text" id="product_id" class="form-control" placeholder="Enter Product Name Or Sku ">
                                    <br/>

                                </div>
                                </div>

                            <form method="POST">
                                <div class="btnarea">
                                </div>
                                <div id="ajaxdata" class="table-responsive">
                                    <table id="example11" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>SKU</th>
                                            <th>Product</th>
                                            <th>Purchase Price</th>
                                            <th>Qty</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>

</div>
</div>

<script type="application/javascript">


     function load_data(){
         $.ajax({
             url:"<?php echo base_url()?>product/LimitedController/limitedAjaxProduct",
             dataType:"JSON",
             success:function (data) {
                 var  html ='';
                 $.each(data,function (key,value) {
                  //   alert(value['product_id']);
                     key++;

                     html +='<tr><td>'+key+'</td><td>'+value['sku']+'</td><td> \
                         '+value['product_title']+'</td><td>'+value['product_price']+'</td>\
                     <td class="table_data" contenteditable  type="text" class="form-control" data-row_id="'+value['product_id']+'" data-column_name="product_stock">'+value['product_stock']+'</td></tr>';
                 });
                 $("#example11 tbody").empty();

                 $("#example11 tbody").append(html);


             },
             error:function (data) {

             }
         });

    }
     load_data();
     $(document).on('blur', '.table_data', function(){
         var id = $(this).data('row_id');
         var table_column = $(this).data('column_name');
         var value = $(this).text();


             if($.isNumeric(value)){
       if(value >=0) {
           $.ajax({
               url: "<?php echo base_url(); ?>product/LimitedController/update",
               method: "POST",
               data: {id: id, table_column: table_column, value: value},
               success: function (data) {
                   load_data();
               }
           });
       } else {
           alert("Enter Valid Numerical Value")
       }
     }
             else {
                 alert("Enter Valid Numerical Value")
             }
     } );




</script>

<script>
    $(document).on('input', '#product_id', function(){

        var product_id = $(this).val();
        $.ajax({
            url: "<?php echo base_url();?>product/LimitedController/limitedAjaxProductSearch",
            method: "POST",
            data: {product_id:product_id},
            success: function (data) {
                console.log(data)
                var  html ='';
                //$("#example11 tbody").empty();
                //  $("#example11 tbody").append(html);
                $('#example11 tbody').html(data);


            }
        });

    });


</script>
