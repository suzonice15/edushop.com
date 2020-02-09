<?php     if ($products) { ?>

<div class="products">


    <?php


        foreach ($products as $product) {


            $featured_image = get_product_meta($product->product_id, 'featured_image');
            $featured_image = get_media_path($featured_image, 'thumb');

            $product_price = $product->product_price;

            $product_discount = $product->discount_price;



            if ($product_discount) {
                $sell_price = $product_discount;
                $discount=$product_price-$product_discount;
            } else {
                $sell_price = $product_price;

            }

            $product_title = $product->product_title;
            $link = base_url() . 'product/' . $product->product_name;

            ?>


            <div
                class="post-2364 product type-product status-publish has-post-thumbnail product_cat-casual-shoes product_cat-mens-shoes product_cat-footwear-all first instock shipping-taxable purchasable product-type-variable has-default-attributes has-children">
                <div class="product-inner">
                    <div class="clear"></div>
                    <a href="<?=$link?>"
                       class="woocommerce-LoopProduct-link woocommerce-loop-product__link">


                        
                        <img src="<?= $featured_image ?>"
                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                             alt=""

                             sizes="(max-width: 300px) 100vw, 300px" width="300"
                             height="300">
                                                                 <span class="price">
                                                                     <?php
                                                                     if ($product_discount) {

                                                                         ?>

                                                                         <del><span
                                                                                 class="woocommerce-Price-amount amount">
                                                                    <span   class="woocommerce-Price-currencySymbol">&nbsp;</span><?= formatted_price($product_price) ?></span>
                                                                         </del>
                                                                         <?php
                                                                     }
                                                                     ?>

                                                                     <ins><span   class="woocommerce-Price-amount amount"><span  class="woocommerce-Price-currencySymbol">&nbsp;</span><?= formatted_price($sell_price) ?></span>
                                                                     </ins>
                                                                    </span>


                        <h2 class="woocommerce-loop-product__title"><?= $product_title ?></h2></a>

                    <div class="hover-area">

                        <a
                            href="javascript:void(0)" data-product_id="<?= $product->product_id ?>"
                            data-product_price="<?= $sell_price ?>"
                            data-product_title="<?= $product->product_title ?>"
                            class="button product_type_simple add_to_cart_button ajax_add_to_cart buy_now ">Order
                            Now</a>



                        <a href="javascript:void(0)" data-product_id="<?= $product->product_id ?>"
                           data-product_price="<?= $sell_price ?>"
                           data-product_title="<?= $product->product_title ?>"
                           class="button product_type_simple add_to_cart_button ajax_add_to_cart add_to_cart">Add
                            To Cart</a>
                    </div>

                </div>
                <!-- /.product-inner -->
            </div>


        <?php }
     ?>


</div>

<?php } ?>