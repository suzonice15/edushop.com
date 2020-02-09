<?php
$cart_items = 0;

foreach ($this->cart->contents() as $key => $val) {
    if (!is_array($val) OR !isset($val['price']) OR !isset($val['qty'])) {
        continue;
    }

    $cart_items += $val['qty'];
}
if ($user) {
    $firstname = $user->user_f_name;
    $last_name = $user->user_l_name;
    $name = $firstname . ' ' . $last_name;
    $user_email = $user->user_email;
    $user_mobile = $user->user_mobile;
    $user_address = $user->user_address;


}
?>

<style>

    .decrement_class {
        background-color: red;
        color: white;
        cursor: pointer;
        float: right;
        margin-top: -20px;
        margin-left: 44px;
    }
    .checkout-mobile{
        margin-bottom: 50px;


    }
    @media (max-width: 634px) {
        .decrement_class {
            background-color: red;
            color: white;
            cursor: pointer;
            float: right;
            margin-top: 1px;
        }
        .checkout-mobile{margin-top: 32px;

            width: 391px;}

    }

</style>

<div class="ecod_strip">
    <div class="wrapper">
        <div class="eCOD_notification">
            <ul class="regular eCOD_slider" id="eCOD_block">
            </ul>
        </div>
    </div>
</div>
<div class="ecod_strip">
    <div class="wrapper">
        <div class="eCOD_notification">
            <ul class="regular eCOD_slider" id="eCOD_block">
            </ul>
        </div>
    </div>
</div>

<div class="ecod_strip">
    <div class="wrapper">
        <div class="eCOD_notification">
            <ul class="regular eCOD_slider" id="eCOD_block">
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid checkout-mobile">

    <div class="row">
        <?php if (!empty($cart_items)) { ?>
            <div class="col-md-6 col">
                <div class="card">
                    <div class="card-header"><b>Customer Information</b>
                    </div>
                    <div class="card-body">
                        <form  style="z-index: 10000000000" action="<?php echo base_url() ?>chechout" id="checkout" name="checkout" method="post">

                            <div class="checkoutstep">
                                <div class="form-group">

                                    <input required type="text" id="customer_name" name="customer_name"
                                           value="<?php if (isset($name)) {
                                               echo $name;
                                           } ?>" class="form-control "
                                           id="billing_name"
                                           placeholder="Type Your Name (mandatory) ">
                                </div>
                                <div class="form-group">

                                    <input required type="text" id="customer_phone" name="customer_phone"
                                           value="<?php if (isset($user_mobile)) {
                                               echo $user_mobile;
                                           } ?>" class="form-control "
                                           id="billing_phone" placeholder="Type Your Mobile (mandatory)">
                                    <p id="customer_phone_error" class="text-danger"></p>
                                </div>
                                <div   class="form-group">

                                    <input type="text" name="customer_email" id="customer_email" value="<?php if (isset($user_email)) {
                                        echo $user_email;
                                    } ?>" class="form-control "
                                           id="billing_email" placeholder="Type Your Email (optional)">
                                    <p id="customer_email_error" class="text-danger"></p>
                                </div>
                                <div class="form-group">

                                    <select  required name="order_area" id="city" class="form-control">



                                        <option>Select Your District (mandatory)</option>
                                        <?php foreach ($districts as $district) :?>
                                        <option value="<?php echo $district->id;?>"><?php echo $district->name;?></option>
                                       <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">

                                    <select  name="thana" id="thana" class="form-control">

                                        <option>Select First District</option>
                                    </select>
                                </div>


                                    <div class="form-group">

                                        <input required  type="text" id="customer_address" name="customer_address"
                                               class="form-control"
                                                placeholder="Type Your Address (mandatory)" >
                                    </div>

                                <div hidden class="checkbox">
                                    <label>
                                        <input type="checkbox" name="ship_to_billing" id="ship_to_billing" value="1">
                                        <b class="fgreen">Same as Customer Address </b>
                                    </label>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-info" >Confirm Order</button>
                            <a  href="<?php echo base_url() ?>"   style="background-color:#FF6061;border: none" class="btn btn-info">Continue   Shopping</a>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col">


                <div class="card">
                    <div class="card-header"><b>Order Review</b>
                    </div>
                    <div class="card-body">


					<span class="checkout-fields">


							<div class="checkoutstep">
                                <div class="cart-info">
                                    <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                        <tr>
                                            <th width="35%" class="name">Products</th>
                                            <th width="5%" class="name">Qnt</th>
                                            <th width="30%" class="name">Price</th>
                                            <th width="30%" class="name">Total</th>
                                        </tr>

                                        <?php
                                        $quntity = 0;

                                        foreach ($this->cart->contents() as $items) {
                                            $featured_image = get_product_meta($items['id'], 'featured_image');
                                            $featured_image = get_media_path($featured_image, 'thumb');

                                            $quntity = $quntity + $items['qty'];
                                            $_product_title=   get_product_title($items['id']);
                                            $_product_title = substr($_product_title, 0, 22).'...';



                                            ?>
                                            <tr id="<?= $items['rowid'] ?>">
                                                <td>
                                                    <img src="<?= $featured_image ?>" width="30">

                                                    <?= $_product_title ?>
                                                </td>

                                                <td>
                                                    <div class="quantity-action ">

                                                        <div class="col-md-1" >
	<span
        id="quantity_value_<?= $items['id'] ?>"
        style="display: inline-block;margin-right: 16px;"><?= $items['qty'] ?></span>
                                                        </div>



                                                    </div>
                                                </td>

                                                <td>
													<span
                                                        id="per_poduct_price"> Tk <?= $this->cart->format_number($items['price']) ?></span>

                                                </td>
                                                <td>
												<span id="per_poduct_total_price_<?= $items['id'] ?>">Tk
												 <?= $this->cart->format_number($items['subtotal']) ?>
													</span>

                                                </td>
                                                <input type="hidden"
                                                       name="products[items][<?php echo $items['id'] ?>][featured_image]"
                                                       value="<?php echo $featured_image ?>">
                                                <input type="hidden" id="product_quantity"
                                                       name="products[items][<?php echo $items['id'] ?>][qty]"
                                                       value="<?php echo $items['qty'] ?>">
                                                <input type="hidden" id="product_price"
                                                       name="products[items][<?php echo $items['id'] ?>][price]"
                                                       value="<?php echo $this->cart->format_number($items['price']) ?>">
                                                <input type="hidden"
                                                       name="products[items][<?php echo $items['id'] ?>][subtotal]"
                                                       value="<?php echo $this->cart->format_number($items['subtotal']) ?>">
                                                <input type="hidden"
                                                       name="products[items][<?php echo $items['id'] ?>][size]"
                                                       value="<?php echo $items['options']['Size'] ?>">
                                                <input type="hidden"
                                                       name="products[items][<?php echo $items['id'] ?>][color]"
                                                       value="<?php echo $items['options']['Color'] ?>">


                                                <input type="hidden"
                                                       name="products[items][<?php echo $items['id'] ?>][name]"
                                                       value="<?php echo get_product_title($items['id']) ?>">
                                                <input type="hidden"
                                                       name="product_id[]"
                                                       value="<?php echo $items['id']; ?>">
                                                <input type="hidden" name="checkout_type" value="cash_on_delivery">

                                                <input type="hidden" class="product_name"
                                                       value="<?php echo get_product_title($items['id']) ?>"/>
                                                <input type="hidden" class="product_price"
                                                       value="<?php echo $this->cart->format_number($items['price']) ?>"/>
                                                <input type="hidden" class="product_color"
                                                       value="<?php echo $items['options']['Color']; ?>"/>
                                                <input type="hidden" class="product_size"
                                                       value="<?php echo $items['options']['Size']; ?>"/>
                                                <input type="hidden" class="product_qty"
                                                       value="<?php echo $items['qty']; ?>"/>
                                                <input type="hidden" class="product_featured_image"
                                                       value="<?php echo $featured_image; ?>"/>


                                            </tr>


                                            <tr>
                                                       </tr>


                                        <?php } ?>
                                        <input type="hidden" class="shipping_charge_in_dhaka"
                                               value="<?= get_option('shipping_charge_in_dhaka') ?>">
                                        <input type="hidden" class="shipping_charge_out_of_dhaka"
                                               value="<?= get_option('shipping_charge_out_of_dhaka') ?>">


                                        </tbody>
                                    </table>

                                   </div>
                                    <input type="hidden" id="quantity_list" name="quantity_list"
                                           value="<?php echo $quntity; ?>">


                                    <table class="table   table-bordered review_cost">
                                        <tbody>
                                        <?php


                                        $order_total = $this->cart->total();
                                        ?>
                                        <input type="hidden" name="order_total"
                                               value="<?php echo $this->cart->format_number($order_total) ?>">


                                        <tr>
                                            <td>
                                                <span class="extra bold">Sub-Total</span>
                                            </td>
                                            <td class="text-right">
													<span class="bold">Tk
														<span id="subtotal_cost">
														<?= $this->cart->format_number($this->cart->total()) ?>													</span>
													</span>
                                            </td>
                                        </tr>
                                        <tr hidden>
                                            <td>
                                                <span class="extra bold">Delivery Cost </span> <span class="text-bold">dddddd</span>
                                            </td>
                                            <td class="text-right">
													<span class="bold">Tk <span
                                                            id="delivery_cost"> </span></span>


                                                <input type="hidden" id="shipping_charge" name="shipping_charge"
                                                       value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <span class="extra bold">Delivery Cost </span> <span class="font-weight-bold">(<?= get_option('delevery_check_out') ?>)</span>
                                            </td>


                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="extra bold totalamout">Total</span>
                                            </td>
                                            <td class="text-right">
													<span class="bold totalamout">Tk <span
                                                            id="total_cost"><?= $this->cart->format_number($order_total) ?></span></span>


                                                <input type="hidden" name="checkout_type" value="cash_on_delivery">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        <a hidden href="<?php echo base_url()?>cart" style="background-color: green" class="btn btn-success btn-sm">Update cart</a>
                    </div>
                    </span>

                </div>
                </form>
            </div>
        <?php } else { ?>
            <div class="col-md-12 text-center"><a href="<?php echo base_url() ?>"><img style="margin-bottom: -68px"
                                                                                       src="<?php echo base_url() ?>images/stop.png"/></a>
            </div>
            <div class="col-md-12 mt-5 text-center">
                <h1 class="text-danger text-center">You have no product to checkout.
                </h1>
                <a class="text-center text-capitalize btn btn-info btn-sm" href="<?php echo base_url() ?>"> back to home</a>
            </div>
        <?php } ?>

    </div>

</div>
<input type="hidden" id="order_id" value="">

<script>

    jQuery('#city').on('change blur', function () {
      //  var order_area = jQuery(this).("option:selected").val();
        var order_area = jQuery('#city option:selected').text(); //will return an array of options in the order they are found
       var city= $('#city').val();


        
        if(city.length==0){
            jQuery('#city_eroor').text('Please select your city ');
        } else {
            jQuery('#city_eroor').text('');

            jQuery.ajax({
                type: "POST",
                data: {
                    city: city
                },
                dataType:"JSON",
                url: '<?php echo base_url()?>ajax/thana_load',
                success: function (results) {
                    if (results.length > 0){

                        var html = '<select  name="thana" id="thana" class="form-control">';
                    $.each(results, function (index, result) {
                        html += '<option value="' + result['name'] + '">' + result['name'] + '</option>';
                    });
                    html += '</select';
                    jQuery('#thana').html(html);
                } else {
                        jQuery('#thana').html('');
                    }
                    //  alert(result);
                },
                error: function (result) {
                    console.log(result);

                    // alert(result);
                }
            });

        }
        if (order_area == 'Dhaka') {

            var charge = 0;
            jQuery('.shipping_charge_in_dhaka').each(function () {
                charge = Number(jQuery(this).val());
            });
            charge = 0;
            var total_cost = jQuery('#subtotal_cost').text();
            var total = parseFloat(charge) + parseFloat(total_cost.replace(/,/g, ''));
            jQuery('#delivery_cost').text(charge);
            jQuery('#total_cost').text(total.toFixed(2));
            jQuery('input[name=order_total]').val(total);
            jQuery('#shipping_charge').val(charge);

            jQuery('#cash_on_delevery').show();
            jQuery('#cash_on_delevery_text').show();

        } else {

            jQuery('#hide_bkash_payment').show();

            var charge = 0;
            jQuery('.shipping_charge_out_of_dhaka').each(function () {
                charge = Number(jQuery(this).val());
            });
            charge = 0;


            var total_cost = jQuery('#subtotal_cost').text();
            var total = parseFloat(charge) + parseFloat(total_cost.replace(/,/g, ''));
            jQuery('#delivery_cost').text(charge);
            jQuery('#total_cost').text(total.toFixed(2));
            jQuery('input[name=order_total]').val(total);
            jQuery('#shipping_charge').val(charge);
            jQuery('#cash_on_delevery').hide();
            jQuery('#cash_on_delevery_text').hide();


        }

    });

</script>

<script>

    jQuery('form#checkout #customer_phone').on('input', function () {

        var customer_phone= jQuery('#customer_phone').val();
        var order_id = jQuery('#order_id').val();

        if (!/^01\d{9}$/.test(customer_phone)) {
            
            jQuery('#customer_phone_error').text("Invalid phone number: must have exactly 11 digits and begin with ");
        } else {
            jQuery('#customer_phone_error').text("");
            var billing_name = jQuery('form#checkout #customer_name').val();
            var billing_phone = jQuery('form#checkout #customer_phone').val();
            var order_total = jQuery("input[name=order_total]").val();
            var product_name = [];
            jQuery('.product_name').each(function () {
                product_name.push(jQuery(this).val());
            });

            var product_price = [];
            jQuery('.product_price').each(function () {
                product_price.push(Number(jQuery(this).val().replace(/\,/g, '')));
            });

            var product_color = [];
            jQuery('.product_color').each(function () {
                product_color.push(jQuery(this).val());
            });


            var product_size = [];
            jQuery('.product_size').each(function () {
                product_size.push(jQuery(this).val());
            });

            var product_qty = [];
            jQuery('.product_qty').each(function () {
                product_qty.push(jQuery(this).val());
            });

            var product_featured_image = [];
            jQuery('.product_featured_image').each(function () {
                product_featured_image.push(jQuery(this).val());
            });
            jQuery.ajax({
                type: "POST",
                data: {
                    order_id: order_id,
                    product_name: product_name,
                    product_price: product_price,
                    product_color: product_color,
                    billing_phone: billing_phone,
                    billing_name: billing_name,
                    product_featured_image: product_featured_image,
                    product_qty: product_qty,
                    product_size: product_size,
                    order_total: order_total
                },
                url: '<?php echo base_url()?>ajax/tryOrderu',
                success: function (result) {
                    debugger;
                    console.log(result);
                    jQuery('#order_id').val(result)
                    //  alert(result);
                },
                error: function (result) {
                    console.log(result);

                    // alert(result);
                }
            });
        }
    });


</script>

<script>

    jQuery(document).ready(function() {
        var payment;
        jQuery('.payment_class_suzon').click(function () {
            payment = jQuery(this).val();

        });
        jQuery('form[name=checkout]').submit(function(){


            if (payment == 'bKash') {
                var bkash_payment=  jQuery('input[name=bkash_payment]').val();

                if(bkash_payment.length<5){
                    return true;
                }

            } else {

                return true;

            }
            debugger;





        });
    });
</script>
<script>
    jQuery('#customer_email').on('input',function () {
   // jQuery('#customer_email').input(function () {
        var error_email = '';
        var email = jQuery('#customer_email').val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email)) {

            jQuery('#customer_email_error').html('<label class="text-danger">email address format is not correct</label>');


        } else {
            jQuery('#customer_email_error').html('');

        }
    });
</script>

