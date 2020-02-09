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
if ($product_availabie != 'In stock') {
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
$total_rating = $total_review = $avg_rating = 0;
$reviews = get_review($prod_row->product_id);


if (isset($reviews)) {
    foreach ($reviews as $review) {
        $rating[] = $review->rating;
    }
    $total_rating = array_sum($rating);
    $total_review = count($reviews);
    $avg_rating = number_format((($total_rating) / ($total_review)), 2);
}


$five_starr = rating_counter($prod_row->product_id, 5);
$four_starr = rating_counter($prod_row->product_id, 4);
$three_starr = rating_counter($prod_row->product_id, 3);
$two_starr = rating_counter($prod_row->product_id, 2);
$one_starr = rating_counter($prod_row->product_id, 1);
$five_star = $five_starr->rating;

$four_star = $four_starr->rating;
$three_star = $three_starr->rating;
$two_star = $two_starr->rating;
$one_star = $one_starr->rating;
$summery = $prod_row->product_summary;

?>


<style>

    .increament_decreament_class {
        margin-left: 15px;
    }

    .mobile h6, .single h6 {
        font-weight: bold
    }

    @media (max-width: 634px) {
        .increament_decreament_class {
            margin-left: 0px;

        }

        .mobile_related_heading_title {
            margin-left: -29px;

            margin-bottom: 7px;

            width: 339px;
        }

    }

    .features {
        background: #fff;
        border: 1px solid #0089d1;
        border-top-color: rgb(0, 137, 209);
        border-top-style: solid;
        border-top-width: 1px;
        border-top: 5px solid #0089d1;
        margin-bottom: 30px;
        padding: 15px;
    }

    .features > ul > li {
        display: block;
        color: #666;
        font-size: 18px;
        clear: both;
        margin-left: -37px;
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

        #content #secondary {
            flex: 0 0 21.6666666667% !important;
            max-width: 99.667% !important;
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
        flex: 0 0 16%;
        max-width: 16%;
    }

    @media (max-width: 576px) {
        .single_product_shopno .site-main .columns-4 .products:not(.slick-slider) .product {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }

        .single_product_shopno #grid-extended .products {
            margin-bottom: 2.813em;
            margin-left: -45px;
        }

        .shop-control-bar {
            background-color: #138496 !important;
            margin-top: 86px;
            width: 118% !important;
            margin-left: -207px !important;

        }

        .single_product_shopno .site-main .columns-4 .products:not(.slick-slider) .product {
            flex: 0 0 33%;
            max-width: 33%;
        }

        .single_product_shopno #grid-extended .products {
            margin-left: -30px !important;
            width: 100% !important;
        }

        .wrapper {
            margin: 0 auto;
            width: 91% !important;
            height: 100%;
            padding: 0px 20px;
            position: relative;
        }

    }

    @media (max-width: 768px) {

        .single_product_shopno .site-main .columns-4 .products:not(.slick-slider) .product {
            flex: 0 0 33%;
            max-width: 33%;
        }

        .single_product_shopno #grid-extended .products {
            margin-bottom: 2.813em;
            margin-left: -32px;
            width: 88%;
        }

        .single_product_shopno .shop-control-bar {
            background-color: #138496;
            margin-top: 89px;
            margin-left: -378px;
            margin-right: -11px;
            width: 87%;
        }
    }


</style>
<style>
    body {
        font-family: Arial;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
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


<!-- mobole product -->
<div class="mobile wrapper">
    <div id="content" class="site-content mobile_single_product" tabindex="-1">
        <div class="col-full">
            <div class="row">

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" itemscope="" itemtype="http://schema.org/Store">

                        <div id="product-191"
                             style="width: 142%;

margin-left: -34px;"
                             class="post-191 product type-product status-publish has-post-thumbnail first instock shipping-taxable purchasable product-type-variable has-default-attributes has-children"
                             itemtype="http://schema.org/Product">


                            <div class="single-product-wrapper">
                                <div class="product-images-wrapper">
                                    <div id="techmarket-single-product-gallery-5aceebf832dda"
                                         class="techmarket-single-product-gallery techmarket-single-product-gallery--with-images techmarket-single-product-gallery--columns-4 thumb-count-0 images"
                                         data-columns="4">
                                        <div class="techmarket-single-product-gallery-images"
                                             data-ride="tm-slick-carousel"
                                             data-wrap=".woocommerce-product-gallery__wrapper"
                                             data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;arrows&quot;:false,&quot;asNavFor&quot;:&quot;#techmarket-single-product-gallery-5aceebf832dda .techmarket-single-product-gallery-thumbnails__wrapper&quot;}">
                                            <div
                                                class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images"
                                                data-columns="4"
                                                style="opacity: 1; transition: opacity 0.25s ease-in-out 0s;">
                                                <figure style="border: 2px solid #138496;height: 394px !important;"
                                                        class="woocommerce-product-gallery__wrapper slick-initialized slick-slider">
                                                    <div aria-live="polite" class="slick-list draggable">
                                                        <div class="slick-track"
                                                             style="opacity: 1; width: 402px; transform: translate3d(0px, 0px, 0px);"
                                                             role="listbox">

                                                            <div style="padding: 10px 14px;margin-right: 85px;">

                                                                <img id="mobile_click_image"
                                                                     src="<?= $featured_image ?>">


                                                                <div class="mobile_list_thumb_image"
                                                                     style="margin-left: 7px;">
                                                                    <?php

                                                                    $gallery_image_meta = get_product_meta($prod_row->product_id, 'gallery_image');
                                                                    $gallery_image = explode(",", $gallery_image_meta);
                                                                    if (count($gallery_image) > 3) {

                                                                        ?>


                                                                        <div class="demo"
                                                                             style="margin-top: 20px;z-index: 99;width: 112%;margin-left: -29px;">

                                                                            <ul id="content-slider"
                                                                                class="content-slider">
                                                                                <li>

                                                                                    <img style="z-index: 9999999999"
                                                                                         class="mobile_click_image"
                                                                                         src="<?= $featured_image ?>"
                                                                                         width="50"
                                                                                         alt="<?= $product_title ?>">

                                                                                </li>

                                                                                <?php
                                                                                $gallery_image_meta = get_product_meta($prod_row->product_id, 'gallery_image');
                                                                                $gallery_image = explode(",", $gallery_image_meta);

                                                                                foreach ($gallery_image as $gallery_id) {
                                                                                    $gallery = get_media_path($gallery_id);

                                                                                    if (isset($gallery)) {


                                                                                        ?>
                                                                                        <li>
                                                                                            <a>
                                                                                                <img
                                                                                                    style="z-index: 9999999999"
                                                                                                    class="mobile_click_image"
                                                                                                    src="<?= $gallery ?>"
                                                                                                    width="50"
                                                                                                    alt="<?= $product_title ?>">
                                                                                            </a>
                                                                                        </li>


                                                                                    <?php }
                                                                                } ?>

                                                                            </ul>

                                                                        </div>

                                                                    <?php } else { ?>
                                                                        <style>
                                                                            .mobile_list_thumb_image .with-carosel-image-gelary {
                                                                                list-style: none;
                                                                                display: inline-flex;
                                                                                margin-top: 20px;
                                                                            }

                                                                            .mobile_list_thumb_image .with-carosel-image-gelary li {
                                                                                margin-right: 6px;
                                                                            }

                                                                        </style>
                                                                        <ul class="with-carosel-image-gelary">

                                                                            <?php


                                                                            $gallery_image_meta = get_product_meta($prod_row->product_id, 'gallery_image');
                                                                            $gallery_image = explode(",", $gallery_image_meta);
                                                                            if (count($gallery_image) == 0) {

                                                                                ?>
                                                                                <li>

                                                                                    <img style="z-index: 9999999999"
                                                                                         class="mobile_click_image"
                                                                                         src="<?= $featured_image ?>"
                                                                                         width="50"
                                                                                         alt="<?= $product_title ?>">

                                                                                </li>

                                                                                <?php
                                                                            }
                                                                            $gallery_image_meta = get_product_meta($prod_row->product_id, 'gallery_image');
                                                                            $gallery_image = explode(",", $gallery_image_meta);

                                                                            foreach ($gallery_image as $gallery_id) {
                                                                                $gallery = get_media_path($gallery_id);

                                                                                if (isset($gallery)) {


                                                                                    ?>
                                                                                    <li>
                                                                                        <a>
                                                                                            <img
                                                                                                style="z-index: 9999999999"
                                                                                                class="mobile_click_image"
                                                                                                src="<?= $gallery ?>"
                                                                                                width="50"
                                                                                                alt="<?= $product_title ?>">
                                                                                        </a>
                                                                                    </li>


                                                                                <?php }
                                                                            } ?>

                                                                        </ul>


                                                                    <?php } ?>


                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.product-images-wrapper -->
                                <div class="summary entry-summary" style="border: 2px solid #138496;padding: 5px 19px;">
                                    <div class="single-product-header">
                                        <h4 class="product_title entry-title"><?= $product_title ?></h4>

                                    </div><!-- /.single-product-header -->
                                    <div class="single-product-meta product_meta">
                                        <div class="cat-and-sku">
                                            <span class="sku_wrapper">Product Code: <span class="sku"><?= $sku ?></span></span>
                                        </div>
                                    </div>
                                    <p> Availability: <?= $product_availability ?></p>

                                    <?php

                                    $summeryy = trim($prod_row->product_summary);
                                    if (strlen($summeryy) > 0) {
                                        ?>
                                        <div style="margin-top: 16px;
margin-bottom: -16px;
margin-left: 5px;
position: relative;
top: -17px;">
                                            <h4 style="font-size: 17px;
font-weight: 200;
color:
#000;
margin: 0;
line-height: 24px;">Quick Overview</h4>
                                            <?php echo $summeryy; ?>

                                        </div>
                                    <?php } ?>
                                    <div class="product-actions-wrapper">
                                        <div class="product-actions">

                                            <p class="price vvvv_price" itemtype="http://schema.org/Offer"
                                               itemref="schema-offer">

                                            <span class="woocommerce-Price-amount amount">
                            <del style="color:red;font-size: 20px">
                                <?php
                                if ($product_discount) {

                                    ?><?= formatted_price($product_price) ?><?php
                                }
                                ?>
                            </del>
                            <span style="color:#138496;font-size: 20px"> <?= formatted_price($sell_price) ?></span>
</span>


                                            </p>


                                            <p class="price" style="font-size: initial;">
                                                <a style="width: 72%;text-align: center;color:white"
                                                   href="javascript:void(0)"

                                                   class="buy_now button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                   data-product_id="<?= $prod_row->product_id ?>"
                                                   data-product_price="<?= $sell_price ?>"
                                                   data-product_title="<?= $prod_row->product_title ?>">Order
                                                    Now</a></p>

                                            <form class="cart" method="post" enctype="multipart/form-data">
                                                <div id="Quantity">
                                                    <span
                                                        style="float: left;/*! margin-top: 5px; */border: 1px solid #138496;padding: 5px;width: 54px;text-align: center;height: 36px;margin-right: -5px;border-right: none;color: #138496;">Qty</span>

                                                    <div
                                                        style="float: left; border: solid 1px #24b193; width: 150px; height: 36px;margin-left:5px">
                                                        <div class="quantity-left-minus"
                                                             style="margin-top: -3px;color:#138496;font-size: 25px;text-align: center; width: 50px; float: left; cursor: pointer;font-weight: bold;">
                                                            -
                                                        </div>
                                                <span
                                                    style="font-size: 23px;text-align: center;color: #138496; width: 50px; float: left; cursor: pointer;border-right: 1px solid #24b193;border-left: 1px solid #24b193;font-weight: bold;"
                                                    id="product_qty">1</span>

                                                        <div class="quantity-right-plus" style="margin-top: -3px;font-weight: bold;color:#138496;font-size: 25px;text-align: center; width: 40px; float: left;
                                                             cursor: pointer;">
                                                            +
                                                        </div>
                                                    </div>
                                                </div>
                                                <br/>
                                                <button type="button" name="add-to-cart" value="2668"
                                                        class="button product_type_simple add_to_cart_button add_to_cart"
                                                        style="margin-top: 14px;width: 72%;color:white"
                                                        data-product_id="<?= $prod_row->product_id ?>"
                                                        data-product_price="<?= $sell_price ?>"
                                                        data-product_title="<?= $prod_row->product_title ?>">
                                                    Add To Cart
                                                </button>


                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div id="mobile_product_right_section" class="col-md-3  col-lg-3 col-12" style="border: 2px solid
#138496;
height: 333px;
margin-bottom: -71px;">


                                    <div class="row">
                                        <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 22px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-truck fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

                                        </div>

                                        <div class="col-lg-12" style="margin: -54px 60px;margin-bottom: -71px;">


                                            <h6>Delivery Time & Charge </h6>
                                            <p style="width: 250px;"><?php echo get_option('delevery_timing') ?></p>


                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 49px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-users fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

                                        </div>

                                        <div class="col-lg-12" style="margin: -21px 60px;margin-bottom: -71px;">


                                            <h6>
                                                Payment method </h6>
                                            <p style="width: 250px;"><?php echo get_option('customer_service') ?></p>


                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 83px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-reply fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

                                        </div>

                                        <div class="col-lg-12" style="margin: -1px 60px;margin-bottom: -71px;">


                                            <h6>Call us for order and service</h6>
                                            <p style="width: 250px;"><?php echo get_option('easy_return') ?></p>


                                        </div>


                                    </div>


                                </div>


                            </div><!-- /.single-product-wrapper -->


                    </main><!-- #main -->
                </div><!-- #primary -->


            </div><!-- .col-full -->
        </div><!-- .row -->
    </div>


</div>


<!--   desktop        ------>

<div class="single desktop_single_product">
    <div class="wrapper">
        <div class="container-fluid">
            <nav hidden class="woocommerce-breadcrumb"><a href="<?php echo base_url() ?>">Home</a>

                <span class="delimiter"><i class="fa fa-fw fa-angle-right"></i></span><a
                    href="<?php echo base_url() ?><?= $breadcumb_category_link ?>"> <?= $breadcumb_category ?></a>
                <span class="delimiter"><i class="fa fa-fw fa-angle-right"></i></span><a
                    href="#"><?= $prod_row->product_title ?></a>
            </nav>


            <br>

            <div class="row">


                <div id="desktop_picture" class="col-md-4 col-lg-4 col-12" style="">


                    <img class="img-fluid" id="zoom_09" style="z-index: 999999"
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
                <div id="desktop_product_section" class="col-md-5 col-lg-5 col-12"
                     style="border: 2px solid #29869B;padding-top: 14px;">


                    <h1 style="font-size: 20px;
font-weight: 200;
color:
#000;
margin: 0;
line-height: 24px;margin-left: 15px;"><?= $product_title ?></h1>

                    <p style="font-size: 15px;
font-weight: 200;
color:
#000;
line-height: 24px;
margin-left: 15px;
margin-bottom: -2px;">Product Code: <?= $sku ?></p>

                    <p style="margin-left: 15px;margin-bottom: -19px;"> Availability: <?= $product_availability ?></p>
                    <?php

                    $summeryy = trim($prod_row->product_summary);
                    if (strlen($summeryy) > 0) {
                        ?>
                        <div style="margin-top: 18px;

margin-bottom: -27px;

margin-left: 15px;">
                            <h4 style="font-size: 17px;
font-weight: 200;
color:
#000;
margin: 0;
line-height: 24px;">Quick Overview</h4>
                            <?php echo $summeryy; ?>

                        </div>
                    <?php } ?>
                    <br>



                        <span style="color:red;font-size: 18px;margin-left: 15px;">
                            <?php
                            if ($product_discount) {

                                echo 'Regular Price';

                                ?><?= formatted_price($product_price) ?><?php
                            }
                            ?>

                        </span>
                    <br/>
                    <span
                        style="color:green;font-size: 18px;margin-left: 15px;"> Discount Price:<?= formatted_price($sell_price) ?></span>

                    <div class="col-md-8 col-lg-8 col-12 singleproduct">


                        <form class="cart" method="post" enctype="multipart/form-data">
                            <div class="quantity">
                                <br>
                                <div id="Quantity">
                                    <span style="float: left;margin-top: 5px">Quantity</span>

                                    <div
                                        style="float: left; border: solid 1px #24b193; width: 171px; height: 36px;margin-left:5px">
                                        <div class="quantity-left-minus"
                                             style="margin-top: -5px;color:orangered;font-size: 25px;text-align: center; width: 50px; float: left; cursor: pointer;font-weight: bold;">
                                            -
                                        </div>
                                                <span
                                                    style="font-size: 23px;text-align: center;color: gray; width: 57px; float: left; cursor: pointer;border-right: 1px solid #24b193;border-left: 1px solid #24b193;font-weight: bold;"
                                                    id="product_qty_desk_top">1</span>

                                        <div class="quantity-right-plus" style="margin-top: -5px;font-weight: bold;color:orangered;font-size: 25px;text-align: center; width: 57px; float: left;
                                                             cursor: pointer;">
                                            +
                                        </div>
                                    </div>
                                </div>
                                <button type="button" data-product_id="<?= $prod_row->product_id ?>"
                                        data-product_price="<?= $sell_price ?>"
                                        data-product_title="<?= $prod_row->product_title ?>"
                                        class="button product_type_simple add_to_cart_button ajax_add_to_cart add_to_cart"
                                        style="margin-top: 15px;background-color: #138496;width:112px;;color:white">
                                    Add to
                                    Cart
                                </button>
                                <button type="button" data-product_id="<?= $prod_row->product_id ?>"
                                        data-product_price="<?= $sell_price ?>"
                                        data-product_title="<?= $prod_row->product_title ?>"
                                        class="button product_type_simple add_to_cart_button ajax_add_to_cart buy_now"
                                        style="margin-top: 32px;background-color: #138496;width:112px;color:white">
                                    Buy
                                    Now
                                </button>

                                <div class="share-btns" style="width:500px;">
                                    <br>

                                       <span class="sharebtns" style="display: inline-flex;">
                                           <span
                                               style="margin-top: 7px;font-size: 17px;margin-right: 5px;">Share: </span>
									<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fvillage-bd.com%2Fvillagenew%2F&t="
                                       target="_blank"
                                       onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(document.URL)+'&t='+encodeURIComponent(document.URL));return false;"
                                       title="FaceBook Share">
                                        <img src="https://www.village-bd.com/images/social-icons/fb.png" alt="FBShare">
                                    </a>
									<a style="margin-left: 8px;"
                                       href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fvillage-bd.com%2Fvillagenew%2F&text=:%20http%3A%2F%2Fvillage-bd.com%2Fvillagenew%2F"
                                       target="_blank"
                                       onclick="window.open('https://twitter.com/intent/tweet?text='+encodeURIComponent(document.title)+':%20'+encodeURIComponent(document.URL));return false;"
                                       title="Tweet">
                                        <img src="https://www.village-bd.com/images/social-icons/tw.png" alt="Tweet"/>
                                    </a>


									<a style="margin-left: 8px;"
                                       href="http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fvillage-bd.com%2Fvillagenew%2F&title=&summary=&source=http%3A%2F%2Fvillage-bd.com%2Fvillagenew%2F"
                                       target="_blank"
                                       onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(document.URL)+'&title='+encodeURIComponent(document.title));return false;"
                                       title="Linked In Share">
                                        <img src="https://www.village-bd.com/images/social-icons/in.png"
                                             alt="LinkedInShare">
                                    </a>


								</span>


                                </div>

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
                <div id="desktop_product_right_section" class="col-md-3  col-lg-3 col-12" style="margin-top: 50px;">


                    <div class="row">
                        <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 22px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-truck fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

                        </div>

                        <div class="col-lg-12" style="margin: -54px 60px;margin-bottom: -71px;">


                            <h6>Delivery Time & Charge </h6>
                            <p><?php echo get_option('delevery_timing') ?></p>


                        </div>


                    </div>


                    <div class="row">
                        <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 49px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-users fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

                        </div>

                        <div class="col-lg-12" style="margin: -21px 60px;margin-bottom: -71px;">


                            <h6>Payment method </h6>
                            <p><?php echo get_option('customer_service') ?></p>


                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-3">

	<span class="fa-stack fa-2x icon" style="margin-top: 16px;
position: relative;
top: 83px;
color:#219291
">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-reply fa-stack-1x fa-inverse" style="margin-top: 10px;"></i>
            </span>

                        </div>

                        <div class="col-lg-12" style="margin: -1px 60px;margin-bottom: -71px;">


                            <h6>Call us for order and service</h6>
                            <p><?php echo get_option('easy_return') ?></p>


                        </div>


                    </div>


                </div>


            </div>


            <br/>

            <br>
            <style>
                @media (max-width: 776px) {
                    .mobile_description_tab {
                        margin-left: -17px !important;
                    }

                    .mobile_description_content {
                        margin-left: -40px !important;
                    }
                }


            </style>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs mobile_description_tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Descriptions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Terms & Conditions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Reviews
                        (<?php if (isset($total_review)) {
                            echo $total_review;
                        } ?> )</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content mobile_description_content">
                <div id="home" class="container tab-pane active"><br>
                    <?= ($prod_row->product_description) ?>
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <?php

                    $term_name = $prod_row->product_terms;
                    if (empty($term_name)) {

                        echo get_option('default_product_terms');

                    } else {
                        echo $term_name;
                    }

                    ?>
                </div>
                <div id="menu2" class="container tab-pane fade"><br>


                    <style>

                        .total_rating .rating {
                            float: left;
                        }

                        /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t
                          follow these rules. Every browser that supports :checked also supports :not(), so
                          it doesn’t make the test unnecessarily selective */
                        .total_rating .rating:not(:checked) > input {
                            position: absolute;
                            top: -9999px;
                            clip: rect(0, 0, 0, 0);
                        }

                        .total_rating .rating:not(:checked) > label {
                            float: right;
                            width: 25px;

                            overflow: hidden;
                            white-space: nowrap;
                            cursor: pointer;
                            font-size: 25px;
                            line-height: 11px;
                            color: #ddd;
                        }

                        .total_rating .rating:not(:checked) > label:before {
                            content: '★';
                        }

                        .total_rating .rating > input:checked ~ label {
                            color: dodgerblue;

                        }

                        .total_rating .rating:not(:checked) > label:hover,
                        .total_rating .rating:not(:checked) > label:hover ~ label {
                            color: dodgerblue;

                        }

                        .total_rating .rating > input:checked + label:hover,
                        .total_rating .rating > input:checked + label:hover ~ label,
                        .total_rating .rating > input:checked ~ label:hover,
                        .total_rating .rating > input:checked ~ label:hover ~ label,
                        .total_rating .rating > label:hover ~ input:checked ~ label {
                            color: dodgerblue;

                        }

                        .total_rating .rating > label:active {
                            position: relative;
                            top: 2px;
                            left: 2px;
                        }
                    </style>

                    <div class="row total_rating">
                        <div class="rating" style="margin-left: 27px;">
                            <input type="radio" id="star5" name="rating" value="5"/><label for="star5"
                                                                                           title="Meh">5
                                stars</label>
                            <input type="radio" id="star4" name="rating" value="4"/><label for="star4"
                                                                                           title="Kinda bad">4
                                stars</label>
                            <input type="radio" id="star3" name="rating" value="3"/><label for="star3"
                                                                                           title="Kinda bad">3
                                stars</label>
                            <input type="radio" id="star2" name="rating" value="2"/><label for="star2"
                                                                                           title="Sucks big tim">2
                                stars</label>
                            <input type="radio" id="star1" name="rating" value="1"/><label for="star1"
                                                                                           title="Sucks big time">1
                                star</label>
                        </div>

                        <p class="error-rating text-danger"></p>
                    </div>


                    <div class="container">

                        <div class="row">

                            <div class="col-md-4 reviewform">

                                <div class="form-group">
                                    <?php

                                    $name = $this->session->userdata('user_f_name');
                                    $email = $this->session->userdata('user_email');
                                    ?>
                                    <input type="text" name="name" id="rating_name"
                                           class="form-control field field-name"
                                           placeholder="Name" value="<?php if (isset($name)) {
                                        echo $name;
                                    } ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" value="" id="rating_email" name="email"
                                           class="form-control field field-email"
                                           placeholder="Email" value="<?php if (isset($email)) {
                                        echo $email;
                                    } ?>">
                                </div>
                                <div class="form-group">
											<textarea rows="3" name="comment" class="form-control field field-comment"
                                                      placeholder="Comments"></textarea>
                                </div>

                                <input type="hidden" name="product_id"
                                       value="<?= $prod_row->product_id ?>">

                                <h4 class="text-success sucess-result"></h4>

                                <button style="background-color: green ;color:white" type="button"
                                        class="reviewbtn"
                                        class="btn btn-success form-control">
                                    Submit Review
                                </button>

                            </div>


                            <style>

                                .rating_description li {
                                    list-style: none
                                }

                                .rating_description li .rating {
                                    position: relative;
                                    display: inline-block;
                                    width: 90px;
                                    height: 17px;
                                    background: url(../images/stars.png) 0 0 repeat-x;
                                    float: left;
                                }
                            </style>


                            <div class="col-md-8">
                                <ul class="rating_description">
                                    <?php
                                    if (isset($reviews) > 0) {
                                        foreach ($reviews as $review) {
                                            $total_review = $review->rating;
                                            ?>

                                            <li class="comment even thread-even depth-1">
                                                <div class="review-user review-header">
                                                    <div class="rating">
                                                                        <span
                                                                            style="width:<?= $total_review * 20 ?>%"></span>
                                                    </div>
                                                    <br>
                                                    <h6 style="display: inline-flex;" itemprop="author">
                                                        By   <span
                                                            style=" margin-left: 5px"><b><?= $review->name ?></b></span><img
                                                            style="margin-left: 8px;
margin-right: 3px;
vertical-align: sub;width: 20px;" src="<?php echo base_url() ?>images/verified.png"> Verified
                                                        on
                                                        <?php echo date('d F Y', strtotime($review->created_time)); ?>
                                                    </h6>

                                                </div>
                                                <div class="review-body">
                                                    <div class="review-text" itemprop="description">
                                                        <p><?= $review->comment ?></p>
                                                    </div>
                                                </div>
                                            </li>

                                            <?php
                                        }
                                    } ?>


                                </ul>

                            </div>
                        </div>


                    </div>
                </div
            </div>


        </div>
    </div>


</div>
<!--  related product ---------------->
<div class="wrapper">
    <div class="single_product_shopno">
        <div id="content" class="site-content" tabindex="-1">
            <div class="col-full">
                <div class="row">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">


                            <h3 class="section-heading mobile_related_heading_title sh-t6 sh-s3 mtab-main-term-2 main-term-2 multi-tab bs-pretty-tabs bs-pretty-tabs-initialized">

                                <a href="javascript:void(0)" data-toggle="tab" aria-expanded="true"
                                   class="main-link main_carosel_category_link">
                                    <span class="h-text main-term-2">Related Product</span>
                                </a>

                            </h3>


                            <div class="tab-content">

                                <div id="grid-extended" class="tab-pane  active" role="tabpanel"
                                     aria-expanded="true">

                                    <div class="woocommerce columns-4">
                                        <div class="load_data"></div>
                                        <div class="load_data_message"></div>

                                    </div>


                        </main><!-- #main -->
                    </div><!-- #primary -->


                </div>
            </div>
        </div>

    </div>
</div>

<input type="hidden" name="related_category" value="<?php echo $product_cats; ?>">


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

        jQuery("#content-slider").lightSlider({
            loop: true,
            item: 2,
            auto: true,
            keyPress: true
        });


        var quantitiy = 0;
        jQuery('.quantity-right-plus').click(function (e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt(jQuery('#product_qty').text());


            // If is not undefined

            jQuery('#product_qty').text(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt(jQuery('#product_qty').text());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                jQuery('#product_qty').text(quantity - 1);
            }
        });


        jQuery('.quantity-right-plus').click(function (e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt(jQuery('#product_qty_desk_top').text());


            // If is not undefined

            jQuery('#product_qty_desk_top').text(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt(jQuery('#product_qty_desk_top').text());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                jQuery('#product_qty_desk_top').text(quantity - 1);
            }
        });

    });

    jQuery('body .mobile_click_image').click(function () {
        var thumb_imag = jQuery(this).attr('src');

        var thumb_imag = jQuery('#mobile_click_image').attr('src', thumb_imag);

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
        jQuery('#desktop_product_section').hide();
        jQuery('#desktop_product_right_section').hide();


    } else {
        jQuery('#mobile_picture').hide();
        jQuery('#desktop_picture').show();
        jQuery('#desktop_product_section').show();
        jQuery('#desktop_product_right_section').show();


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


<script>
    jQuery(document).ready(function () {

        var limit = 8;
        var start = 0;
        var action = 'inactive';
        var related_category = jQuery('input[name=related_category]').val();

        function load_data(limit, start) {


            $.ajax({
                url: "<?php echo base_url(); ?>Ajax/scroll_related_product",
                method: "POST",
                data: {limit: limit, start: start, category_id: related_category},
                cache: false,
                success: function (data) {

                    if (data == '') {
                        jQuery('.load_data_message').html('<h3>No More Result Found</h3>');
                        action = 'active';
                    } else {
                        jQuery('.load_data').append(data);
                        jQuery('.load_data_message').html("");
                        action = 'inactive';
                    }
                }
            })
        }

        if (action == 'inactive') {
            action = 'active';
            load_data(limit, start);
        }

        $(window).scroll(function () {
            if (action == 'inactive') {

                action = 'active';
                start = start + limit;
                setTimeout(function () {
                    // load_data(limit, start);
                }, 1);
            }
        });

    });
</script>

<script>
    jQuery('.reviewbtn').on('click', function () {


        var rating = jQuery('.total_rating input[name=rating]:checked').val();
        var name = jQuery('.reviewform input[name=name]').val();
        var email = jQuery('.reviewform input[name=email]').val();
        var comment = jQuery('.reviewform textarea[name=comment]').val();
        var product_id = jQuery('.reviewform input[name=product_id]').val();
        var base_url = '<?php echo base_url()?>';


        if (typeof (rating) == 'undefined') {
            jQuery('.total_rating .error-rating').text('Enter rating value');
            return false;
        }
        if (name == '') {
            jQuery('.reviewform input[name=name]').focus();
            jQuery('.reviewform .field-name').addClass('validation-error');
            return false;
        }
        if (email == '') {
            jQuery('.reviewform input[name=email]').focus();
            jQuery('.reviewform .field-name').addClass('validation-error');
            return false;
        }


        if (comment == '') {
            jQuery('.reviewform textarea[name=comment]').focus();
            jQuery('.reviewform .field-comment').addClass('validation-error');
            return false;
        }

        var ajax_url = base_url + 'ajax/add_to_review';

        jQuery.ajax({
            type: 'POST',
            data: {
                "rating": rating,
                "name": name,
                "email": email,
                "comment": comment,
                "product_id": product_id
            },
            url: ajax_url,

            success: function (result) {

                jQuery('.reviewform .sucess-result').text('Review added successfully with for admin approved...')
            }
        });
    });


</script>


