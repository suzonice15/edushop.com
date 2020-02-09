
<div class="wrapper"
<div class="row cat_promotion_box" id="ab68">
    <?php
    $home_cat_section = explode(",", get_option('home_cat_section'));
    // echo '<pre>'; print_r($home_cat_section); echo '</pre>';
    $active_tab = 0;
    if(sizeof($home_cat_section)>0){
        foreach ($home_cat_section as $home_cat) {
            $category_info = get_category_info($home_cat);
            $category_title = $category_info->category_title;
            $category_id = $category_info->category_id;
            $category_name = $category_info->category_name;
            $link = base_url().'category/'.$category_info->category_name;
            //print_r($category_info)
            $featured_image = get_media_path($category_info->medium_banner);
            //$featured_image = get_media_path($featured_image, 'thumb');


            ?>

            <h3 class="section-heading sh-t6 sh-s3 mtab-main-term-2 main-term-2 multi-tab bs-pretty-tabs bs-pretty-tabs-initialized">

                <a href="<?=$link?>" data-toggle="tab" aria-expanded="true"
                   class="main-link main_carosel_category_link">
                    <span class="h-text main-term-2"><?=$category_title?> </span>
                </a>

            </h3>
            <div class="tabbing">
                <div class="tabbing_products">
                    <ul class="boka1 ">
                        <?php
                        $catproducts = get_category_products($home_cat, 10);
                        if (isset($catproducts)) {
                            $i = 0;
                            foreach ($catproducts as $prod) {
                                $featured_image = get_product_meta($prod->product_id, 'featured_image');
                                $featured_image = get_media_path($featured_image, 'thumb');
                                $_product_title = strip_tags($prod->product_title);

                                $product_link = base_url() . 'product/' . $prod->product_name;


                                $discount = false;

                                $product_price = $sell_price = $prod->product_price;

                                $product_discount = $prod->discount_price;
                                $discount_type = $prod->discount_type;

                                if ($product_discount != 0) {
                                    $product_discount_price = floatval($product_discount);


                                    $sell_price = $product_discount_price;
                                }

                                $_product_title = strip_tags($prod->product_title);



                                ?>


                                <li class="">
                                    <a
                                        href="<?=$product_link?>">
                                        <img src="<?php echo $featured_image;?>"
                                             data-img="<?php echo $featured_image;?>"
                                             alt="<?= $prod->product_title;?>">
                                        <h4><?= $prod->product_title;?></h4>
                                        <div align="center"  class="product_code" style="color: red;margin: -10px;">Code : <?= $prod->sku;?></div>
                                        <p>
                                        <div class="" style="color: red;float: left;">
                                            <del>
                                                <?php
                                                if ($product_discount) {
                                                    echo formatted_price($product_price);

                                                } ?>
                                            </del>
                                        </div>
                                        <div class="" style="color: green"><span> <?php echo formatted_price($sell_price); ?></span></div>

                                        </p>
                                    </a>
                                </li>

                            <?php } } ?>



                    </ul>


                </div>
            </div>

        <?php } } ?>


</div>
</div>