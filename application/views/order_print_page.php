
<link rel="stylesheet" type="text/css"
      href="<?= base_url() ?>assets/fontend/css/bootstrap.min.css"/>
<style>
    .home_print_mobile_class{

    }
    .thank_you_class{
        font-size: 20px;
        background-color:
            green;
        width: 98%;
        height: auto;
        margin-top: 28px;
        color:
            white;
        padding: 8px 8px;
    }

    @media (max-width: 576px) {
        .thank_you_class{
            font-size: 20px;
            background-color:
                green;
            width: 100%;
            height: auto;
            margin-top: 28px;
            color:
                white;
            padding: 8px 8px;
        }
        .order_tank_you_class{
            width: 107%;
        }
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


<div class="container-fluid ">


    <div class="row  order_tank_you_class">

        <?php
        if ((isset($order))) { ?>

            <div class="col-md-3  col-lg-3 col-12">
                <img itemprop="logo" src="<?php echo get_option('logo') ?>" alt="Edu online shopping in Bangladesh">
            </div>
            <div class="col-md-12 col-12">
                <div class="card card-default">
                    <div class="card-header">

                        <div class="row ">


                            <div class="col-md-3  col-lg-3 col-12">
                                <h4>Order Details </h4>
                            </div>



                        </div>

                    </div>
                    <div class="card-body">
                        <div class="cart-info">

                            <table class="table   table-bordered">
                                <tbody>
                                <tr>
                                    <td style="75%">
                                        <span class="extra bold totalamout"><b>Order Number</b></span>
                                    </td>
                                    <td class="text-right" style="width:50%">
                                        <span class="bold totalamout"><b><?php echo $order->order_id; ?></b></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="75%">
                                        <span class="extra bold totalamout"><b>Customer Name</b></span>
                                    </td>
                                    <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b> <?= $order->customer_name; ?></b></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="75%">
                                        <span class="extra bold totalamout"><b>Customer Phone</span>
                                    </td>
                                    <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= $order->customer_phone ?></b></span>
                                    </td>
                                </tr>
                                <tr>
                                <tr>
                                    <td style="75%">
                                        <span class="extra bold totalamout"><b>District</span>
                                    </td>
                                    <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?=get_district($order->order_area )?></b></span>
                                    </td>
                                </tr>
                                <tr>
                                <tr>
                                    <td style="75%">
                                        <span class="extra bold totalamout"><b>Sub area</span>
                                    </td>
                                    <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= $order->thana ?></b></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="75%">
                                        <span class="extra bold totalamout"><b>Customer Address</span>
                                    </td>
                                    <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= $order->customer_address ?></b></span>
                                    </td>
                                </tr>

                                </tbody>
                            </table>


                            <div style="overflow-x: scroll;">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th class="name">Sl</th>
                                        <th class="name">Picture</th>
                                        <th class="name">Products</th>
                                        <th class="name">Code</th>
                                        <th class="name">Quantity</th>
                                        <th class="name">Price</th>
                                        <th class="name">Total</th>
                                    </tr>
                                    <?php
                                    $product_items = unserialize($order->products);
                                    //echo '<pre>'; print_r($product_items); echo '</pre>';
                                    $count = 1;
                                    $total = 0;
                                    foreach ($product_items['items'] as $product_id => $item) {


                                        $totall = intval(preg_replace('/[^\d.]/', '', $item['subtotal']));

                                        $total += $totall ;
                                        $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td>


                                                <img src="<?= $featured_image ?>" height="30" width="30"/>

                                            </td>

                                            <td class="product-item" style="width:50%">

                                                <div class="item-name-and-price">
                                                    <div class="item-name">
                                                        <?= $item['name'] ?>
                                                    </div>

                                                </div>
                                            </td>

                                            <td>  <?= get_sku_code($product_id) ?></td>
                                            <td>   <?= $item['qty'] ?></td>
                                            <td> Tk <?=$item['price'] ?> </td>
                                            <td> Tk <?=$item['subtotal'] ?>    </td>

                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </table>
                            </div>
                            <table class="table  table-bordered">
                                <tbody>
                                <tr>
                                    <td style="75%">
                                        <span class="extra bold totalamout"><b>Sub Total</b></span>
                                    </td>
                                    <td class="text-right" style="width:50%">
                                        <span class="bold totalamout"><b> <?= formatted_price($total) ?>  </b></span>
                                    </td>
                                </tr>
                                <tr hidden>
                                    <td style="75%">
                                        <span class="extra bold totalamout"><b>Delivery Cost</b></span>
                                    </td>
                                    <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= formatted_price($order->shipping_charge) ?> </b></span>
                                    </td>
                                </tr>

                                <tr >



                                    <td colspan="2">
                                        <span class="extra bold totalamout"><b>Delivery Cost(<?= get_option('delevery_check_out') ?>)</b></span>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="75%">
                                        <span class="extra bold totalamout"><b>Total</span>
                                    </td>
                                    <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= formatted_price($order->order_total) ?> </b></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?><h1 class="error">Invalid Order Request!</h1><?php
        }
        ?>


    </div>
</div>


<script>

    window.onload = function () {
        window.print();
    }
</script>
