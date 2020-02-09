<div class="mt-5 container-fluid">
    <nav class="bg-white">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-decoration-none"><a href="<?php echo base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active"><a
                    href="<?= $breadcumb_category_link ?>">            <?= $breadcumb_category ?>
                </a>
        </ol>
    </nav>
</div>


<div class="container-fluid">


    <div class="row">
        <div class="col-md-3 col-lg-3 col-12 " id="content">
            <div id="secondary" class="widget-area shop-sidebar" role="complementary">
                <div id="techmarket_product_categories_widget-1"
                     class="widget woocommerce widget_product_categories techmarket_widget_product_categories">
                    <ul class="product-categories category-single">
                        <li class="product_cat">
                            <ul class="show-all-cat">
                                <li class="product_cat">
                                    <span class="show-all-cat-dropdown">Show All Categories <i class="fa fa-fw fa-angle-right"></i></span>

                                    <ul class="main_menu_toggle_show">
                                        <?php
                                        $parentCategories = get_result("SELECT  category_id,category_name,category_title FROM `category`  order by category_id  DESC");
                                        if(isset($parentCategories)){
                                            foreach ($parentCategories as $parentCategory) {

                                                $parent_id = $parentCategory->category_id;
                                                $link_parent = base_url() . 'category/' . $parentCategory->category_name;
                                                ?>

                                                <li class="cat-item cat-item-652">
                                                    <a href="<?=$link_parent?>"><?=$parentCategory->category_title?></a>
                                                </li>

                                            <?php  } } ?>


                                    </ul>
                                </li>
                            </ul>
                            <ul>
                                <li class="cat-item cat-item-652 current-cat">
                                    <a href="<?= $breadcumb_category_link ?>"> <?= $breadcumb_category ?></a>
                                    <ul class='children'>
                                        <?php
                                        $subCategories = get_result("SELECT category_id,category_name,category_title FROM `category` where  parent_id=$category_id ORDER BY rank_order ASC");
                                        if(isset($subCategories)) {
                                            foreach ($subCategories as $subCategory) {


                                                $link_parent = base_url() . 'category/' . $subCategory->category_name;


                                                ?>

                                                <li class="cat-item cat-item-1157"><a
                                                        href="<?= $link_parent ?>"><?=$subCategory->category_title?></a>
                                                </li>

                                            <?php } } ?>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div><!-- /.sidebar-shop-1 -->
        </div>

        <div class="col-md-9 col-lg-9 col-12 category_main_product"  >
            <h3><?= $breadcumb_category ?></h3>
            <hr>


                <div id="load_data"></div>





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

<div class="before-footer-wrap">
    <div class="col-full">
        <div class="footer-social-icons">
            <ul class="social-icons nav">
                <li class="nav-item"><a  target="_parent" class="sm-icon-label-link nav-link" href="<?=get_option('facebook')?>"><i class="fa fa-facebook"></i>
                        Facebook</a></li>
                <li class="nav-item"><a  target="_parent" class="sm-icon-label-link nav-link" href="<?=get_option('twitter')?>"><i class="fa fa-twitter"></i>
                        Twitter</a></li>

                <li class="nav-item"><a  target="_parent" class="sm-icon-label-link nav-link" href="<?=get_option('youtube')?>"><i class="fa fa-youtube-square"></i>
                        Vimeo</a></li>
                <li class="nav-item"><a target="_parent" class="sm-icon-label-link nav-link" href="<?=get_option('instagram')?>"><i
                            class="fa fa-linkedin"></i> Linkin</a></li>
            </ul>
        </div>
    </div><!-- /.col-full -->
</div>

<script>
    jQuery('.main_menu_toggle_show').hide();

    jQuery('.show-all-cat-dropdown').click(function () {
        jQuery('.main_menu_toggle_show').toggle('1000');
        icon = jQuery(this).find("i");
        icon.toggleClass("fa fa-fw fa-angle-right fa fa-fw fa-angle-down")

    });

</script>



<script>
 jQuery(document).ready(function () {



load_data();
        function load_data() {


            jQuery.ajax({
                url: "<?php echo base_url()?>/Ajax/all_tend_product",
                method: "POST",
                cache: false,
                success: function (data) {
                    if (data == '') {
                        //jQuery('#load_data_message').html('<h3>No More Result Found</h3>');

                    } else {
                        jQuery('#load_data').append(data);

                    }
                }
            })
        }




    });
</script>
