<?php
$product_link = base_url($prod_row->product_name);
$featured_image = get_product_thumb($prod_row->product_id);
$featured_image = get_product_thumb($prod_row->product_id);

$product_title = $prod_row->product_title;
$sku = $prod_row->sku;

/*# product category #*/
$product_cat = null;
$product_cats = get_result("SELECT term_id FROM term_relation WHERE product_id=$prod_row->product_id");
if (count($product_cats) > 0) {
    foreach ($product_cats as $pcat) {
        $product_cat[] = $pcat->term_id;
    }
    $product_cats = implode(",", $product_cat);
}


/*# product stock availability #*/
$product_availabie = $prod_row->product_availability;
$product_availability = '<span class="text-success"> In Stock</span>';
if ($product_availabie == 'Out of stock') {
    $product_availability = '<span class="text-danger">Out Of Stock</span>';

}

//print_r($specifications);exit();
/*# product price and discount #*/
$discount = false;

$product_price = $prod_row->product_price;
$product_video = $prod_row->product_video;

$product_discount = $prod_row->discount_price;

if ($product_discount) {
    $sell_price = $product_discount;
} else {
    $sell_price = $product_price;

}

///*# review rating #*/
//$total_rating = $total_review = $avg_rating = 0;
//$reviews = get_review($prod_row->product_id);
//
//
//if (isset($reviews)) {
//    foreach ($reviews as $review) {
//        $rating[] = $review->rating;
//    }
//    $total_rating = array_sum($rating);
//    $total_review = count($reviews);
//    $avg_rating = number_format((($total_rating) / ($total_review)), 2);
//}
//
//
//$five_starr = rating_counter($prod_row->product_id, 5);
//$four_starr = rating_counter($prod_row->product_id, 4);
//$three_starr = rating_counter($prod_row->product_id, 3);
//$two_starr = rating_counter($prod_row->product_id, 2);
//$one_starr = rating_counter($prod_row->product_id, 1);
//$five_star = $five_starr->rating;
//
//$four_star = $four_starr->rating;
//$three_star = $three_starr->rating;
//$two_star = $two_starr->rating;
//$one_star = $one_starr->rating;
$summery = $prod_row->product_summary;

?>


<style>

    .increament_decreament_class {
        margin-left: 15px;
    }

    @media (max-width: 634px) {
        .increament_decreament_class {
            margin-left: 0px;

        }

    }


</style>
<style id='techmarket-woocommerce-style-inline-css' type='text/css'>

    button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"],
    .button,
    #scrollUp,
    .added_to_cart,
    .btn-primary,
    .fullwidth-notice,
    .top-bar.top-bar-v4,
    .site-header.header-v4,
    .site-header.header-v5,
    .navbar-search .btn-secondary,
    .header-v1 .departments-menu button,
    .widget_shopping_cart .buttons a:first-child,
    .section-landscape-products-widget-carousel.type-3 .section-header:after,
    .home-v1-slider .custom.tp-bullets .tp-bullet.selected,
    .home-v2-slider .custom.tp-bullets .tp-bullet.selected,
    .home-v3-slider .custom.tp-bullets .tp-bullet.selected,
    .home-v4-slider .custom.tp-bullets .tp-bullet.selected,
    .home-v5-slider .custom.tp-bullets .tp-bullet.selected,
    .home-v6-slider .custom.tp-bullets .tp-bullet.selected,
    .section-categories-filter .products .product-type-simple .button:hover,
    #respond.comment-respond .comment-form .form-submit input[type=submit]:hover,
    .contact-page-title:after,
    .comment-reply-title:after,
    article .more-link,
    article.post .more-link,
    .slick-dots li.slick-active button:before,
    .products .product .added_to_cart:hover,
    .products .product .button:hover,
    .banner-action.button:hover,
    .deal-progress .progress-bar,
    .section-products-tabs .section-products-tabs-wrap > .button:hover,
    #secondary.sidebar-blog .widget .widget-title:after,
    #secondary.sidebar-blog .widget_tag_cloud .tagcloud a:hover,
    .comments-title:after, .pings-title:after,
    .navbar-primary .nav .techmarket-flex-more-menu-item > a::after,
    .primary-navigation .nav .techmarket-flex-more-menu-item > a::after,
    .secondary-navigation .nav .techmarket-flex-more-menu-item > a::after,
    .header-v4 .sticky-wrapper .techmarket-sticky-wrap.stuck,
    .header-v5 .sticky-wrapper .techmarket-sticky-wrap.stuck,
    article .post-readmore .btn-primary:hover,
    article.post .post-readmore .btn-primary:hover,
    .table-compare tbody tr td .button:hover,
    .return-to-shop .button:hover,
    .contact-form .form-group input[type=button],
    .contact-form .form-group input[type=submit],
    .cart-collaterals .checkout-button,
    #payment .place-order .button,
    .single-product .single_add_to_cart_button:hover,
    .single-product .accessories .accessories-product-total-price .accessories-add-all-to-cart .button:hover,
    .single-product .accessories .accessories-product-total-price .accessories-add-all-to-cart .button:focus,
    .contact-form .form-group input[type=button],
    .contact-form .form-group input[type=submit],
    .about-accordion .kc-section-active .kc_accordion_header.ui-state-active a i,
    .about-accordion .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title i,
    .about-accordion .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-title i,
    .home-v3-banner-with-products-carousel .banner .banner-action.button,
    .section-media-single-banner .button,
    .woocommerce-wishlist table.cart .product-add-to-cart a.button,
    table.cart td.actions div.coupon .button,
    .site-header.header-v10 .stretched-row,
    .site-header .handheld-header .handheld-header-cart-link .count,
    .products .product-carousel-with-timer-gallery .button,
    .banners-v2 .banner-action.button,
    .pace .pace-progress,
    input[type="submit"].dokan-btn-danger, a.dokan-btn-danger, .dokan-btn-danger,
    input[type="submit"].dokan-btn-danger:hover,
    a.dokan-btn-danger:hover,
    .dokan-btn-danger:hover,
    input[type="submit"].dokan-btn-danger:focus,
    a.dokan-btn-danger:focus,
    .dokan-btn-danger:focus,
    .wcmp_main_page .wcmp_main_menu ul li.hasmenu ul.submenu li.active a,
    .wcmp_main_page .wcmp_main_holder .wcmp_headding1 button,
    .wcmp_main_page .wcmp_main_menu ul li ul li a.active2,
    .wcmp_main_page .wcmp_main_holder .wcmp_headding1 button,
    input[type="submit"].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme,
    input[type="submit"].dokan-btn-theme:hover, a.dokan-btn-theme:hover, .dokan-btn-theme:hover,
    input[type="submit"].dokan-btn-theme:focus, a.dokan-btn-theme:focus, .dokan-btn-theme:focus,
    #secondary.sidebar-blog .widget .section-header .section-title:after,
    .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active,
    .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover,
    .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover,
    .wcmp_regi_main .register p.woocomerce-FormRow input {
        background-color: #138496;
    }

    .primary-navigation .nav .dropdown-menu,
    .secondary-navigation .nav .dropdown-menu,
    .navbar-primary .nav .dropdown-menu,
    .primary-navigation .nav .yamm-fw > .dropdown-menu > li,
    .navbar-primary .nav .yamm-fw > .dropdown-menu > li,
    .top-bar .nav .show > .dropdown-menu {
        border-top-color: #138496;
    }

    .widget_shopping_cart .buttons a:first-child:hover,
    .navbar-primary .nav .techmarket-flex-more-menu-item > a:hover::after,
    .primary-navigation .nav .techmarket-flex-more-menu-item > a:hover::after,
    .secondary-navigation .nav .techmarket-flex-more-menu-item > a:hover::after,
    .cart-collaterals .checkout-button:hover,
    #payment .place-order .button:hover,
    .contact-form .form-group input[type=button]:hover,
    .contact-form .form-group input[type=submit]:hover,
    .section-media-single-banner .button:hover,
    .woocommerce-wishlist table.cart .product-add-to-cart a.button:hover,
    .products .product-carousel-with-timer-gallery .button:hover,
    table.cart td.actions div.coupon .button:hover,
    .banners-v2 .banner-action.button:hover,
    .wcmp_main_page .wcmp_main_holder .wcmp_headding1 button:hover,
    .btn-primary:hover,
    .navbar-search button:hover {
        background-color: #e89504;
    }

    .home-v3-banner-with-products-carousel .banner .banner-action.button:hover {
        background-color: #ca8203;
    }

    .cart-collaterals .checkout-button:hover,
    #payment .place-order .button:hover,
    .contact-form .form-group input[type=button]:hover,
    .contact-form .form-group input[type=submit]:hover,
    .section-media-single-banner .button:hover,
    .products .product-carousel-with-timer-gallery .button:hover,
    .woocommerce-wishlist table.cart .product-add-to-cart a.button:hover,
    table.cart td.actions div.coupon .button:hover,
    .btn-primary:hover {
        border-color: #e89504;
    }

    .home-v3-banner-with-products-carousel .banner .banner-action.button:hover {
        border-color: #ca8203;
    }

    .top-bar.top-bar-v4 {
        border-bottom-color: #11ab504;
    }

    .price,
    .features-list .feature i,
    .section-recent-posts-with-categories .post-items .post-item .post-info .btn-more,
    .section-products-with-image .load-more-button,
    .single-product .woocommerce-tabs .wc-tabs li.active a,
    .single-product .techmarket-tabs .tm-tabs li.active a,
    #respond.comment-respond .comment-form .form-submit input[type=submit],
    #respond.comment-respond .comment-form > p.logged-in-as a,
    .banner-action.button,
    .commentlist .comment .reply a,
    .pings-list .comment .reply a,
    .products .product .added_to_cart,
    .products .product .button,
    .full-width-banner .banner-bg .button,
    article.post.category-more-tag a[target=_blank],
    .commentlist .comment #respond .comment-reply-title small a,
    .commentlist .pingback #respond .comment-reply-title small a,
    .pings-list .comment #respond .comment-reply-title small a,
    .pings-list .pingback #respond .comment-reply-title small a,
    article.post.format-link .entry-content p a,
    article .post-readmore .btn-primary,
    article.post .post-readmore .btn-primary,
    .table-compare tbody tr td .button,
    .return-to-shop .button,
    .wcmp_main_page .wcmp_main_menu ul li a.active,
    .wcmp_main_page .wcmp_main_menu ul li a:hover,
    .wcmp_main_page .wcmp_displaybox2 h3,
    .wcmp_main_page .wcmp_displaybox3 h3,
    .widget_techmarket_poster_widget .poster-bg .caption .button:hover,
    .single-product .accessories .products .product .accessory-checkbox label input,
    .cart-collaterals .shop-features li i,
    .single-product .single_add_to_cart_button,
    .banners .banner .banner-bg .caption .price,
    .features-list .features .feature .media .feature-icon,
    .section-recent-posts-with-categories .nav .nav-link,
    .widget_techmarket_banner_widget .banner .banner-bg .caption .price,
    .single-product .accessories .accessories-product-total-price .accessories-add-all-to-cart .button,
    .wcmp_main_page .wcmp_main_holder .wcmp_dashboard_display_box h3 {
        color: #138496;
    }

    .top-bar.top-bar-v4 .nav-item + .nav-item .nav-link::before,
    .top-bar.top-bar-v4 .nav-item + .nav-item > a::before,
    .top-bar.top-bar-v4 .nav > .menu-item + .menu-item .nav-link::before,
    .top-bar.top-bar-v4 .nav > .menu-item + .menu-item > a::before,
    #respond.comment-respond .comment-form > p.logged-in-as a:hover,
    #respond.comment-respond .comment-form > p.logged-in-as a:focus,
    #comments .comment-list .reply a:hover,
    #comments .comment-list .reply a:focus,
    .comment-list #respond .comment-reply-title small:hover,
    .pings-list #respond .comment-reply-title small:hover,
    .comment-list #respond .comment-reply-title small a:focus,
    .pings-list #respond .comment-reply-title small a:focus {
        color: #12ec205;
    }

    .top-bar.top-bar-v4 a,
    .site-header.header-v4 .site-header-cart .cart-contents .amount .price-label {
        color: #1da13108;
    }

    .site-header.header-v4 .navbar-search button,
    .site-header.header-v5 .navbar-search button,
    .widget_shopping_cart .product_list_widget .mini_cart_item .remove,
    .widget_shopping_cart_content .product_list_widget .mini_cart_item .remove,
    .site-header.header-v4 .site-header-cart .cart-contents .count {
        background-color: #124bc05;
    }

    .section-landscape-products-widget-carousel.product-widgets .section-header:after {
        border-bottom-color: #138496;
    }

    .site-header.header-v4 .site-branding .cls-3,
    .site-header.header-v5 .site-branding .cls-3 {
        fill: #1b111707;
    }

    .btn-primary,
    .wcmp_main_page .wcmp_ass_btn,
    .header-v4 .departments-menu > .dropdown-menu > li,
    .header-v4 .departments-menu > .dropdown-menu .menu-item-has-children > .dropdown-menu,
    .section-categories-filter .products .product-type-simple .button:hover,
    .contact-page-title:after,
    .navbar-search .btn-secondary,
    .products .product .added_to_cart,
    .products .product .button,
    .products .product .added_to_cart:hover,
    .products .product .button:hover,
    .section-products-carousel-tabs .nav-link.active::after,
    .full-width-banner .banner-bg .button,
    .banner-action.button,
    .section-products-tabs .section-products-tabs-wrap > .button:hover,
    .section-3-2-3-product-cards-tabs-with-featured-product .nav .nav-link.active:after,
    .section-product-cards-carousel-tabs .nav .nav-link.active:after,
    .section-products-carousel-with-vertical-tabs .section-title:before,
    #respond.comment-respond .comment-form .form-submit input[type=submit],
    .section-categories-filter .products .product-type-simple .button:hover,
    .home-v9-full-banner.full-width-banner .banner-bg .caption .banner-action.button:hover,
    .section-deals-carousel-and-products-carousel-tabs .deals-carousel-inner-block,
    article .post-readmore .btn-primary,
    article.post .post-readmore .btn-primary,
    .table-compare tbody tr td .button,
    .table-compare tbody tr td .button:hover,
    .return-to-shop .button,
    .col-2-full-width-banner .banner .banner-bg .caption .banner-action.button:hover,
    .return-to-shop .button:hover,
    .select2-container .select2-drop-active,
    .contact-form .form-group input[type=button],
    .contact-form .form-group input[type=submit],
    .widget_techmarket_poster_widget .poster-bg .caption .button,
    .cart-collaterals .checkout-button,
    .section-6-1-6-products-tabs ul.nav .nav-link.active:after,
    #payment .place-order .button,
    .products .sale-product-with-timer,
    .products .sale-product-with-timer:hover,
    .single-product .single_add_to_cart_button,
    .single-product .accessories .accessories-product-total-price .accessories-add-all-to-cart .button:hover,
    .single-product .accessories .accessories-product-total-price .accessories-add-all-to-cart .button:focus,
    .contact-form .form-group input[type=button],
    .contact-form .form-group input[type=submit],
    .about-accordion .kc-section-active .kc_accordion_header.ui-state-active a i,
    .about-accordion .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-title i,
    .section-landscape-full-product-cards-carousel .section-title::before,
    .section-media-single-banner .button,
    .woocommerce-wishlist table.cart .product-add-to-cart a.button,
    .widget_techmarket_poster_widget .poster-bg .caption .button,
    table.cart td.actions div.coupon .button,
    .header-v1 .departments-menu button,
    input[type="submit"].dokan-btn-danger,
    a.dokan-btn-danger,
    .dokan-btn-danger,
    input[type="submit"].dokan-btn-danger:hover,
    a.dokan-btn-danger:hover,
    .dokan-btn-danger:hover,
    input[type="submit"].dokan-btn-danger:focus,
    a.dokan-btn-danger:focus,
    .dokan-btn-danger:focus,
    input[type="submit"].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme,
    input[type="submit"].dokan-btn-theme:hover, a.dokan-btn-theme:hover, .dokan-btn-theme:hover,
    input[type="submit"].dokan-btn-theme:focus, a.dokan-btn-theme:focus, .dokan-btn-theme:focus,
    .section-product-carousel-with-featured-product.type-2 .section-title::before,
    .wcvendors-pro-dashboard-wrapper .wcv-grid nav.wcv-navigation ul li.active a:after {
        border-color: #138496;
    }

    .slider-sm-btn,
    .slider-sm-btn:hover {
        border-color: #138496 !important;
    }

    .slider-sm-btn {
        color: #138496 !important;
    }

    .slider-sm-btn:hover,
    .wcmp_main_page .wcmp_main_holder .wcmp_vendor_dashboard_content .action_div .wcmp_orange_btn {
        background-color: #138496 !important;
    }

    @media (max-width: 1023px) {
        .single_product_shopno .shop-control-bar {
            background-color: #138496;
            margin-top: 86px;

            width: 87%;
        }

        .single_product_shopno .shop-control-bar .woocommerce-products-header__title {
            font-size: 1.5em;
            color: white;
            margin: 0;
            flex-grow: 1;
        }
    }

    button,
    .button,
    button:hover,
    .button:hover,
    .btn-primary,
    input[type=submit],
    input[type=submit]:hover,
    .btn-primary:hover,
    .return-to-shop .button:hover,
    .top-bar.top-bar-v4 a,
    .fullwidth-notice .message,
    #payment .place-order .button,
    .cart-collaterals .checkout-button,
    .banners-v2 .banner-action.button,
    .header-v1 .departments-menu button,
    .section-media-single-banner .button,
    .full-width-banner .banner-bg .button:focus,
    .full-width-banner .banner-bg .button:hover,
    .banners-v2.full-width-banner .banner-bg .button,
    .site-header.header-v10 .navbar-primary .nav > li > a,
    .site-header.header-v10 .primary-navigation .nav > li > a,
    .top-bar.top-bar-v4 .nav-item + .nav-item .nav-link::before,
    .top-bar.top-bar-v4 .nav-item + .nav-item > a::before,
    .top-bar.top-bar-v4 .nav > .menu-item + .menu-item .nav-link::before,
    .top-bar.top-bar-v4 .nav > .menu-item + .menu-item > a::before,
    .site-header.header-v4 .navbar-nav .nav-link,
    .site-header.header-v4 .site-header-cart .cart-contents,
    .site-header.header-v4 .header-cart-icon,
    .site-header.header-v4 .departments-menu button i,
    .site-header.header-v5 .departments-menu button i,
    .site-header.header-v5 .navbar-primary .nav > li > a,
    .site-header.header-v5 .primary-navigation .nav > li > a,
    .section-products-tabs .section-products-tabs-wrap > .button:hover,
    .site-header.header-v4 .site-header-cart .cart-contents .amount .price-label,
    .home-v9-full-banner.full-width-banner .banner-bg .caption .banner-action.button:hover,
    .col-2-full-width-banner .banner .banner-bg .caption .banner-action.button:hover {
        color: #000000;
    }

    .slider-sm-btn:hover,
    .slider-sm-btn {
        color: #000000 !important;
    }

    .top-bar.top-bar-v4 {
        border-bottom-color: #000000;
    }

    .site-header.header-v4 .site-header-cart .cart-contents .count {
        background-color: #000000;
    }

    .site-header.header-v4 .navbar-search button,
    .site-header.header-v5 .navbar-search button {
        background-color: #000000;
    }

    .site-header.header-v4 .navbar-search button:hover,
    .site-header.header-v5 .navbar-search button:hover {
        background-color: #000000;
    }

    .site-header.header-v4 .departments-menu button i,
    .site-header.header-v5 .departments-menu button i {
        text-shadow: #000000 0 1px 0;
    }

    .site-header.header-v4 .site-branding .cls-1,
    .site-header.header-v4 .site-branding .cls-2,
    .site-header.header-v5 .site-branding .cls-1,
    .site-header.header-v5 .site-branding .cls-2 {
        fill: #000000;
    }

    .site-header.header-v4 .site-branding .cls-3,
    .site-header.header-v5 .site-branding .cls-3 {
        fill: #000000;
    }

    .single_product_shopno .site-main {
        width: 135% !important
    }

    .single_product_shopno .site-main .columns-4 .products:not(.slick-slider) .product {
        flex: 0 0 16% ;
        max-width: 16% ;
    }

    @media (max-width: 576px) {
        .single_product_shopno .site-main .columns-4 .products:not(.slick-slider) .product {
            flex: 0 0 49% !important;
            max-width: 49% !important;
        }
        .single_product_shopno #grid-extended .products {
            margin-bottom: 2.813em;
            margin-left: -45px;
        }
        .shop-control-bar{
            background-color:
                #138496 !important;
            margin-top: 86px;
            width: 118% !important;
            margin-left: -207px !important;

        }
        .single_product_shopno  .site-main .columns-4 .products:not(.slick-slider) .product {
            flex: 0 0 33% ;
            max-width: 33% ;
        }
        .single_product_shopno #grid-extended .products {
            margin-bottom: 2.813em;
            margin-left: -45px !important;
            width: 114% !important;
        }

    }

    @media (max-width: 768px) {

      .single_product_shopno  .site-main .columns-4 .products:not(.slick-slider) .product {
          flex: 0 0 33% ;
          max-width: 33% ;
        }
       .single_product_shopno #grid-extended .products {
           margin-bottom: 2.813em;
           margin-left: -32px;
           width: 88%;
        }
        .single_product_shopno .shop-control-bar {
            background-color:
                #138496;
            margin-top: 89px;
            margin-left: -378px;
            margin-right: -11px;
            width: 87%;
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

<div class="ecod_strip">
    <div class="wrapper">
        <div class="eCOD_notification">
            <ul class="regular eCOD_slider" id="eCOD_block">
            </ul>
        </div>
    </div>
</div>
<div class="single">
    <div class="wrapper">
        <div class="container-fluid">
            <nav class="woocommerce-breadcrumb"><a href="<?php echo base_url() ?>">Home</a>

                <span class="delimiter"><i class="fa fa-fw fa-angle-right"></i></span><a
                    href="<?php echo base_url() ?><?= $breadcumb_category_link ?>"> <?= $breadcumb_category ?></a>
                <span class="delimiter"><i class="fa fa-fw fa-angle-right"></i></span><a
                    href="#"><?= $prod_row->product_title ?></a>
            </nav>

            <div class="row">
                <div class="col-md-3 col-lg-3 col-12 " id="content">
                    <div id="secondary" class="widget-area shop-sidebar" role="complementary">
                        <div id="techmarket_product_categories_widget-1"
                             class="widget woocommerce widget_product_categories techmarket_widget_product_categories">
                            <ul class="product-categories category-single">
                                <li class="product_cat">
                                    <ul class="show-all-cat">
                                        <li class="product_cat">
                                    <span class="show-all-cat-dropdown">Show All Categories <span
                                            class="child-indicator open"><i
                                                class="fa fa-fw fa-angle-left"></i></span></span>

                                            <ul class="main_menu_toggle_show">
                                                <?php
                                                $parentCategories = get_result("SELECT  category_id,category_name,category_title FROM `category`  order by category_id  DESC");
                                                if (isset($parentCategories)) {
                                                    foreach ($parentCategories as $parentCategory) {

                                                        $parent_id = $parentCategory->category_id;
                                                        $link_parent = base_url() . 'category/' . $parentCategory->category_name;
                                                        ?>

                                                        <li class="cat-item cat-item-652">
                                                            <a href="<?= $link_parent ?>"><?= $parentCategory->category_title ?></a>
                                                        </li>

                                                    <?php }
                                                } ?>


                                            </ul>
                                        </li>
                                    </ul>
                                    <ul>


                                        <?php
                                        $query_cat_id = "SELECT category_id,category_name,category_title from category JOIN term_relation on term_relation.term_id=category.category_id
WHERE term_relation.product_id=$prod_row->product_id and category.parent_id=0 order by category_id asc limit 1";
                                        $result = get_result($query_cat_id);
                                        $category_id_of_product = $result[0]->category_id;
                                        $category_name_of_product = base_url() . 'category/' . $result[0]->category_name;
                                        $category_title_of_product = $result[0]->category_title;

                                        ?>
                                        <li class="cat-item cat-item-652 current-cat">
                                            <a href="<?= $category_name_of_product ?>"><?= $category_title_of_product ?></a>
                                            <ul class='children'>

                                                <?php

                                                $parentCategories = get_result("SELECT  category_id,category_name,category_title FROM `category` where parent_id=$category_id_of_product order by category_id  DESC");
                                                if (isset($parentCategories)) {
                                                    foreach ($parentCategories as $parentCategory) {
                                                        // $parent_id = $parentCategory->category_id;
                                                        $link_parent = base_url() . 'category/' . $parentCategory->category_name;
                                                        ?>
                                                        <li class="cat-item cat-item-1157"><a
                                                                href="<?= $link_parent ?>"><?= $parentCategory->category_title ?></a>
                                                        </li>
                                                    <?php }
                                                } ?>


                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div><!-- /.sidebar-shop-1 -->


                </div>

                <div class="col-md-9 col-lg-9 col-12">
                    <div class="row">
                        <div id="desktop_picture" class="col-md-6 col-lg-6  col-12" style="">


                            <img width="100%" class="img-fluid" id="zoom_09" style="z-index: 999999"
                                 src="<?= $featured_image ?>"
                                 alt="<?= $product_title ?>">
                            <div id="gallery_09">


                                <div id="gallery_09" style="margin-top: 15px;
display: inline-flex;">

                                    <a href="javascript:void(0)" class="elevatezoom-gallery active"
                                       data-image="<?= $featured_image ?>"
                                       data-zoom-image="<?= $featured_image ?>">
                                        <img
                                            src="<?= $featured_image ?>"
                                            width="50" alt="<?= $product_title ?>"></a>

                                    <?php
                                    $gallery_image_meta = get_product_meta($prod_row->product_id, 'gallery_image');
                                    $gallery_image = explode(",", $gallery_image_meta);

                                    foreach ($gallery_image as $gallery_id) {
                                        $gallery = get_media_path($gallery_id);

                                        if (isset($gallery)) {


                                            ?>


                                            <a href="javascript:void(0)" class="elevatezoom-gallery active"
                                               data-image="<?= $gallery ?>"
                                               data-zoom-image="<?= $gallery ?>">
                                                <img
                                                    src="<?= $gallery ?>"
                                                    width="50" alt="<?= $product_title ?>"></a>


                                        <?php }
                                    } ?>

                                </div>

                            </div>


                        </div>

                        <div id="mobile_picture" class="demo col-md-6 col-lg-6 ">

                         
                            <ul id="lightSlider">
                                <li data-thumb="<?= $featured_image ?>">
                                    <img src="<?= $featured_image ?>" alt="<?= $product_title ?>"/>
                                </li>
                                <?php
                                $gallery_image_meta = get_product_meta($prod_row->product_id, 'gallery_image');
                                if (!empty($gallery_image_meta)) {

                                    $gallery_image = explode(",", $gallery_image_meta);
                                    if (count($gallery_image) > 0) {
                                        foreach ($gallery_image as $gallery_id) {
                                            $gallery = get_media_path($gallery_id);

                                            ?>
                                            <li data-thumb="<?= $gallery ?>">
                                                <img src="<?= $gallery ?>" alt="<?= $product_title ?>"/>
                                            </li>
                                        <?php }
                                    }
                                } ?>
                            </ul>
                        </div>


                        <div class="col-md-6 col-lg-6 col-12">


                            <h3><?= $product_title ?></h3>

                            <h3>Product Code: <?= $sku ?></h3>

                            <img src="<?= get_option('order_image') ?>">
                            <?php

                            $summeryy = trim($prod_row->product_summary);
                            if (strlen($summeryy) > 0) {
                                ?>
                                <div style="margin-top: 13px;margin-bottom: -20px;">

                                    <?php echo $summeryy; ?>

                                </div>
                            <?php } ?>


                            <br/>
                            <h3>Call For Order</h3>
                            <h3>
                                <?= get_option('phone_order') ?>
                            </h3>
                            <p style="font-size: 18px; font-weight: bold; font-family: sans-serif; color: black;">
                                Delivery
                                Charge:<br/>
                                Inside Dhaka - <?= get_option('shipping_charge_in_dhaka') ?> Tk. <br/> Outside Dhaka
                                - <?= get_option('shipping_charge_out_of_dhaka') ?> Tk.</p>

                            <del style="color:red;font-size: 20px">
                                <?php
                                if ($product_discount) {

                                    ?><?= formatted_price($product_price) ?><?php
                                }
                                ?>
                            </del>
                            <span style="color:green;font-size: 20px"> <?= formatted_price($sell_price) ?></span>

                            <div class="col-md-12 col-lg-12 col-12 singleproduct ">

                                <button type="button" data-product_id="<?= $prod_row->product_id ?>"
                                        data-product_price="<?= $sell_price ?>"
                                        data-product_title="<?= $prod_row->product_title ?>"
                                        class="button product_type_simple add_to_cart_button ajax_add_to_cart buy_now"
                                        style="margin-top: 32px;background-color: #fca204;width:50%;">Buy Now
                                </button>

                                <form class="cart" method="post" enctype="multipart/form-data">
                                    <div class="quantity">
                                        <label for="quantity-input">Quantity</label>
                                        <input name="product_qty" id="product_qty" type="number" step="1" min="1" max=""
                                               style="margin-top: 13px;" value="1" title="Qty"
                                               class="input-text qty text" size="4" pattern="[0-9]*"
                                               inputmode="numeric">
                                        <br>
                                        <div id="Quantity">
                                            <span style="float: left;margin-top: 5px"> Quantity : </span>

                                            <div style="float: left; border: solid 1px #24b193; width: 150px; height: 36px;margin-left:5px">
                                                <div style="color:orangered;font-size: 25px;text-align: center; width: 50px; float: left; cursor: pointer;font-weight: bold;" onclick="DecrementFunction('quantity-value75');">
                                                    -
                                                </div>
                                                <span style="font-size: 25px;text-align: center;color: gray; width: 50px; float: left; cursor: pointer;border-right: 1px solid #24b193;border-left: 1px solid #24b193;font-weight: bold;" id="quantity-value75">3</span>

                                                <div onclick="IncrementFunction('quantity-value75')" style="font-weight: bold;color:orangered;font-size: 25px;text-align: center; width: 40px; float: left;
                                                             cursor: pointer;">
                                                    +
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" data-product_id="<?= $prod_row->product_id ?>"
                                                data-product_price="<?= $sell_price ?>"
                                                data-product_title="<?= $prod_row->product_title ?>"
                                                class="button product_type_simple add_to_cart_button ajax_add_to_cart add_to_cart"
                                                style="margin-top: 15px;background-color: #fca204;width:50%;">Add to
                                            Cart
                                        </button>

                                    </div>
                                </form>

                                    <div class="mobile_font_view_page_order">
                                        <a href="javascript:void(0)" class="add_to_cart_mobile"
                                           data-product_id="<?= $prod_row->product_id ?>"
                                           data-product_price="<?= $sell_price ?>"
                                           data-product_title="<?= $prod_row->product_title ?>">Add to Cart</a>
                                        <a href="javascript:void(0)" class="buy_to_cart_mobile"
                                           data-product_id="<?= $prod_row->product_id ?>"
                                           data-product_price="<?= $sell_price ?>"
                                           data-product_title="<?= $prod_row->product_title ?>">Buy Now</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row mt-5 ml-n5">
                        <div class="col-md-12 col-lg-12 col-12">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a style="font-size: 16px;font-weight: bold" class="nav-link active"
                                       data-toggle="tab" href="#home">
                                        Description
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a style="font-size: 16px;font-weight: bold" class="nav-link" data-toggle="tab"
                                       href="#menu1">Specification</a>
                                </li>
                                <?php
                                if (!empty($product_video)) {
                                    ?>
                                    <li class="nav-item">
                                        <a style="font-size: 16px;font-weight: bold" class="nav-link" data-toggle="tab"
                                           href="#video">Video</a>
                                    </li>

                                    <?php
                                }
                                ?>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content" style="margin-left: 17px;">
                                <div id="home" class="tab-pane active"><br>

                                    <?= ($prod_row->product_description) ?>
                                </div>
                                <div id="menu1" class="container tab-pane fade"><br>
                                    <table class="table table-bordered">

                                        <tbody>

                                        <?php

                                        if (isset($specifications)) {


                                            foreach ($specifications as $specification) {
                                                //  print_r($specification);

                                                if ($specification->key == '') {
                                                    continue;
                                                } else {
                                                    ?>

                                                    <tr class="first odd">
                                                        <th class="label"><?php echo $specification->key; ?></th>
                                                        <td class="data last"><?php echo $specification->value; ?></td>
                                                    </tr>

                                                <?php }
                                            }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="video" class="tab-pane active"><br>


                                    <?php
                                    if (!empty($product_video)) {
                                        ?>


                                        <iframe width="560" height="315"
                                                src="https://www.youtube.com/embed/<?= $product_video ?>"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                        <?php
                                    }
                                    ?>


                                </div>

                            </div>

                        </div>


                    </div>


                </div>


            </div>
        </div>
    </div>

    <div class="wrapper ">
        <div class="single_product_shopno">

            <div id="content" class="site-content" tabindex="-1">
                <div class="col-full">
                    <div class="row">
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">


                                <div class="shop-control-bar">

                                    <h1 class="woocommerce-products-header__title page-title">Related Product</h1>

                                </div>
                                <div class="tab-content">

                                    <div id="grid-extended" class="tab-pane  active" role="tabpanel"
                                         aria-expanded="true">

                                        <div class="woocommerce columns-4">
                                            <div class="products">


                                                <?php
                                                //	$related_products = get_related_products($prod_row->product_id, $product_cats);
                                                $sql = "SELECT DISTINCT product_name, product.product_id,product_title,product_price,discount_price,sku,product_stock,discount_type FROM `product`  JOIN `term_relation` on product.product_id = term_relation.product_id AND term_relation.term_id IN($product_cats)  limit 12";
                                                $products = get_result($sql);


                                                if ($products) {
                                                    foreach ($products as $product) {


                                                        $featured_image = get_product_meta($product->product_id, 'featured_image');
                                                        $featured_image = get_media_path($featured_image, 'thumb');

                                                        $product_price = $product->product_price;

                                                        $product_discount = $product->discount_price;


                                                        if ($product_discount) {
                                                            $sell_price = $product_discount;
                                                            $discount = $product_price - $product_discount;
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
                                                                <a href="<?= $link ?>"
                                                                   class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                                                    <?php
                                                                    if ($product_discount) {
                                                                        ?>

                                                                        <span class="onsale">-
                                                    <span
                                                        class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol"></span><?= formatted_price($discount) ?></span>
                                                </span>

                                                                    <?php } ?>
                                                                    <img src="<?= $featured_image ?>"
                                                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                         alt=""
                                                                    >
                                                                 <span class="price">
                                                                     <?php
                                                                     if ($product_discount) {

                                                                         ?>

                                                                         <del><span
                                                                                 class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">&nbsp;</span><?= formatted_price($product_price) ?></span>
                                                                         </del>
                                                                         <?php
                                                                     }
                                                                     ?>

                                                                     <ins><span class="woocommerce-Price-amount amount"><span
                                                                                 class="woocommerce-Price-currencySymbol">&nbsp;</span><?= formatted_price($sell_price) ?></span>
                                                                     </ins>
                                                                    </span>


                                                                    <h2 class="woocommerce-loop-product__title"><?= $product_title ?></h2>
                                                                </a>

                                                                <div class="hover-area">

                                                                    <a
                                                                        href="javascript:void(0)"
                                                                        data-product_id="<?= $product->product_id ?>"
                                                                        data-product_price="<?= $sell_price ?>"
                                                                        data-product_title="<?= $product->product_title ?>"
                                                                        class="button product_type_simple add_to_cart_button ajax_add_to_cart buy_now ">Order
                                                                        Now</a>


                                                                    <a href="javascript:void(0)"
                                                                       data-product_id="<?= $product->product_id ?>"
                                                                       data-product_price="<?= $sell_price ?>"
                                                                       data-product_title="<?= $product->product_title ?>"
                                                                       class="button product_type_simple add_to_cart_button ajax_add_to_cart add_to_cart">Add
                                                                        To Cart</a>
                                                                </div>

                                                            </div>
                                                            <!-- /.product-inner -->
                                                        </div>


                                                    <?php }
                                                } ?>


                                            </div>
                                        </div>
                            </main><!-- #main -->
                        </div><!-- #primary -->


                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="wrapper">
        <div class="before-footer-wrap">
            <div class="col-full">
                <div class="footer-social-icons">
                    <ul class="social-icons nav">
                        <li class="nav-item"><a target="_parent" class="sm-icon-label-link nav-link"
                                                href="<?= get_option('facebook') ?>"><i class="fa fa-facebook"></i>
                                Facebook</a></li>
                        <li class="nav-item"><a target="_parent" class="sm-icon-label-link nav-link"
                                                href="<?= get_option('twitter') ?>"><i class="fa fa-twitter"></i>
                                Twitter</a></li>

                        <li class="nav-item"><a target="_parent" class="sm-icon-label-link nav-link"
                                                href="<?= get_option('youtube') ?>"><i class="fa fa-youtube-square"></i>
                                Vimeo</a></li>
                        <li class="nav-item"><a target="_parent" class="sm-icon-label-link nav-link"
                                                href="<?= get_option('instagram') ?>"><i
                                    class="fa fa-linkedin"></i> Linkin</a></li>
                    </ul>
                </div>
            </div><!-- /.col-full -->
        </div>
    </div>
</div>
<div class="mobile_font_view_page_order">
    <a href="javascript:void(0)" class="add_to_cart_mobile"
       data-product_id="<?= $prod_row->product_id ?>"
       data-product_price="<?= $sell_price ?>"
       data-product_title="<?= $prod_row->product_title ?>">Add to Cart</a>
    <a href="javascript:void(0)" class="buy_to_cart_mobile" data-product_id="<?= $prod_row->product_id ?>"
       data-product_price="<?= $sell_price ?>"
       data-product_title="<?= $prod_row->product_title ?>">Buy Now</a>
</div>


<script>

    jQuery(document).on('click', '.geleary_image_id', function () {
        var image = jQuery(this).attr("src");
        jQuery("#zoom_09").attr("src", image);
        //	jQuery("#zoom_09").attr("data-zoom-image",image);
        //alert(image)
    });


</script>


<script>
    jQuery(document).ready(function () {

        var quantitiy = 0;
        jQuery('#btnMinus').click(function (e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt(jQuery('#product_qty').val());

            if (quantity > 1) {

                jQuery('#product_qty').val(quantity - 1);
            } else {
                jQuery('#product_qty').val(quantity);

            }


            // Increment

        });

        jQuery('#btnPlus').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt(jQuery('#product_qty').val());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                jQuery('#product_qty').val(quantity + 1);
            }
        });

    });


    //var width = window.innerWidth || document.documentElement.clientWidth    || document.body.clientWidth;
    var width = jQuery("body").width();


    if (width < 500) {

        jQuery('#mobile_picture').show();
        jQuery('.mobile_font_view_page_order').show();
        jQuery('#desktop_picture').hide();


    } else {
        jQuery('#mobile_picture').hide();
        jQuery('#desktop_picture').show();


    }


</script>


<script>
    jQuery('.main_menu_toggle_show').hide();

    jQuery('.show-all-cat-dropdown').click(function () {
        jQuery('.main_menu_toggle_show').toggle('1000');
        icon = jQuery(this).find("i");
        icon.toggleClass("fa fa-fw fa-angle-left fa fa-fw fa-angle-up")

    });

</script>

