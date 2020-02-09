<?php
$uri_string = uri_string();
$site_title = get_option('site_title');
$page_title = isset($page_title) ? $page_title : $site_title;
$og_image = $logo = get_option('logo');
$favicon = get_option('icon');


if (isset($seo_title) && !empty($seo_title)) {
    $title = $seo_title;
} else {
    $title = $page_title . (!empty($uri_string) ? ' | ' . $site_title : NULL);
}


if (isset($prod_row)) {
    $og_image = get_product_meta($prod_row->product_id, 'featured_image');
    $og_image = get_media_path($og_image);
}


$cart_items = 0;
foreach ($this->cart->contents() as $key => $val) {
    if (!is_array($val) OR !isset($val['price']) OR !isset($val['qty'])) {
        continue;
    }
    $cart_items += $val['qty'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= $title ?></title>


    <meta name="viewport" content="width=device-width, user-scalable=no" />

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta charset="utf-8">

    <link rel="shortcut icon" href="<?= $favicon ?>">

    <meta name="description" content="<?= isset($seo_content) ? $seo_content : $page_title ?>"/>
    <meta name="keywords" content="<?= isset($seo_keywords) ? $seo_keywords : $page_title ?>"/>
    <meta name="robots" content="noodp"/>
    <link rel="canonical" href="<?= base_url() ?>"/>
    <meta property="og:locale" content="EN"/>
    <meta property="og:url" content="<?= current_url() ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?= $page_title ?>"/>
    <meta property="og:description" content="<?= $page_title ?>"/>
    <meta property="og:image" content="<?= $og_image ?>"/>
    <meta property="og:site_name" content="<?= $site_title ?>"/>

    <link rel="image_src" href="<?= $og_image ?>"/>
    <script type='text/javascript' src='<?= base_url() ?>assets/fontend/js/home/jquery.js?ver=1.12.4'></script>
    <script type='text/javascript'
            src='<?= base_url() ?>assets/fontend/js/home/jquery-migrate.min.js?ver=1.4.1'></script>


    <link rel="stylesheet" href="<?= base_url() ?>assets/fontend/css/home/home.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/fontend/css/home/cart.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/fontend/css/custom.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/fontend/css/woocommerce.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/fontend/css/style.min.css?ver=1.2.5" type="text/css">
    <!--    <link rel="stylesheet" href="-->
    <? //= base_url() ?><!--assets/fontend/css/home/font-awesome.min.css" type="text/css">-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fontend/css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fontend/css/mobile_menu.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fontend/css/dropdown_menu.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fontend/css/mobile_bottom_menu.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fontend/css/review.css"/>


    <link rel="stylesheet" href="<?= base_url() ?>themes/default/default.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?= base_url() ?>themes/light/light.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?= base_url() ?>themes/dark/dark.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?= base_url() ?>themes/bar/bar.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?= base_url() ?>themes/nivo-slider.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?= base_url() ?>themes/style.css" type="text/css" media="screen"/>


    <link rel="stylesheet" type="text/css"
          href="<?= base_url() ?>assets/fontend/css/bootstrap.min.css"/>
    <!--        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fontend/css/lightslider.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <script>
        if (typeof visitorId == 'undefined') {
            var visitorId = 'ff';
        }
        var ShoppingCartAPI = "https://bdeshishop.com/cart/"
    </script>
    <! ------------------------- product carousel titlebar style --------------- !>

    <style>

        .section-heading {
            margin: 0 0 15px;
            font-size: 16px;
            line-height: 20px;
            position: relative;
        }

        .section-heading .h-text, .section-heading:after {
            display: inline-block;
            -webkit-transition: .35s cubic-bezier(.39, .58, .57, 1) 0s;
            -moz-transition: .35s cubic-bezier(.39, .58, .57, 1) 0s;
            -o-transition: .35s cubic-bezier(.39, .58, .57, 1) 0s;
            transition: .35s cubic-bezier(.39, .58, .57, 1) 0s;
        }

        .section-heading .other-link {
            float: right;
            outline: 0;
        }

        .section-heading .other-link .h-text {
            margin-left: 0;
            color: #484848;
            font-weight: 400;
            text-transform: capitalize;
            font-size: 82%;
            padding: 4px 0 4px 14px;
        }

        .section-heading.sh-t6:before {
            content: '';
            display: inline-block;
            height: 3px;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .section-heading.sh-t6 > .main-link > .h-text {
            position: relative;
            padding: 0 11px;
            color: #fff;
        }

        .section-heading.sh-t6 .h-text {
            padding: 0;
            text-transform: uppercase;
            line-height: 32px;
        }

        .section-heading.sh-t6.sh-s3:before {
            top: inherit;
            bottom: 0;
            height: 3px;
            margin-top: 0;
        }

        .section-heading.sh-t6.sh-s3 > .main-link > .h-text:after, .section-heading.sh-t6.sh-s3 > .main-link > .h-text:before {
            content: '';
            display: inline-block;
            position: absolute;
            top: 0;
            width: 0;
            height: 0;
            border-bottom: 30px solid #000;
            border-right: 20px solid transparent;
            z-index: 1;
            right: -20px;
            background-color: transparent !important;
        }

        .mtab-main-term-2.mtab-main-term-2.section-heading.sh-t6:before, .main-term-2.section-heading.sh-t6:before, .mtab-main-term-2.mtab-main-term-2.section-heading.sh-t6 > .main-link > .main-term-2.h-text, .mtab-main-term-2.mtab-main-term-2.section-heading.sh-t6 > .main-link > .main-term-2.h-text:before {
            background-color: #24a3b5;
        }

        .mtab-main-term-2.mtab-main-term-2.section-heading.sh-t6.sh-s3 > .main-link > .main-term-2.h-text:before {
            border-bottom-color: #000000;
        }

        .swal-content__input, .swal-content__textarea {
            border: 1px solid rgba(0, 0, 0, .14) !important;
        }
    </style>

</head>
<body class="<?php if (isset($class)) {
    echo $class;
} ?>">

<!-- Google Tag Manager (noscript) -->

<!-- End Google Tag Manager (noscript) -->

<! ------------------------- Top Scroll ------------------------------------------------>


<! ------------------------- Header ------------------------------------------------>
<div class="sc_header">
    <div class="ffix_header removeAbc">
        <div class="wrapper">
            <div class="sc_logo" itemscope="" itemtype="http://schema.org/Organization">

                <a href="<?php echo base_url(); ?>" title="Edu online shopping in Bangladesh" itemprop="url">
                    <img itemprop="logo" src="<?php echo get_option('logo') ?>" alt="Edu online shopping in Bangladesh">
                </a>
            </div>


            <form id="home_page_search" method="get" action="<?php echo base_url() ?>search">
                <div class="sc_search">
            <span id="search">
                 <input type="text" id="autocomplete" value="" placeholder="What are you looking for?"
                        onkeyup="searchItemProduct(this.value)" autocorrect="off" autocapitalize="off"
                        autocomplete="off" spellcheck="false" name="q"/>


                <button type="submit" class="srch_action btn orange">Search</button>
            </form>
            <div class="search-area" style="display:block;">
                <ul class="dropdown-menu" style="display: block;">


                </ul>

            </div>
            </span>
        </div>
        <div style="float: right;margin: -40px 0 0 0; ">

            <input id="mobileNuberTotrack" type="text" placeholder="&#x1F50E; এখানে ফোন নাম্বার দিন"
                   style="text-indent: -3px; width: 200px; background-color: #e9f6f7; background-clip: padding-box; border: #dbf0f2 solid 1px; font-size: 15px; color: #353535; font-weight: 500; height: 39px;"/>
            <div class="sc_rlinks_btm orange"
                 style="font-size: 13px; cursor: pointer; margin: 0; padding: 10px 23px"
            >
                <div id="order_track">অর্ডার ট্র্যাক করুন</div>
            </div>
        </div>
    </div>

    <! ---------- !>

</div>
</div>
</div>
<div class="wrapper">

    <div class="<?php if (isset($mobile_single_page_menu_solve)) {
        echo 'mobile_single_page_menu_solve';
    } else {
        echo 'mobile_header_menu';
    } ?>">


        <a href="javascript:void(0);" class="off-canvas-toggle" style="margin-top: -67px;
position: relative;
top: 10px;
left: 6px;
z-index: 9999999;
font-size: 17px;">
            <i class="fa fa-bars" style="font-size:23px"></i>
        </a>


        <a href="<?php echo base_url(); ?>" title="Shopner online shopping in Bangladesh" itemprop="url">
            <img style="margin-top: -24px;

margin-left: 105px;

width: 68px;

height: 34px;

margin-bottom: 7px;" src="<?php echo get_option('logo') ?>" alt="Dhaka">
        </a>


        <a hidden class="mobile_phone_class"
           href="tel: <?php echo get_option('phone') ?>"> <?php echo get_option('phone') ?></a>


        <div class="col-2" style="text-align: center;position: relative;top: -54px;left: 255px;">


            <?php
            $cart_items = $cart_total = 0;
            /*echo '<pre>'; print_r($this->cart->contents()); echo '</pre>';*/

            foreach ($this->cart->contents() as $key => $val) {
                if (!is_array($val) OR !isset($val['price']) OR !isset($val['qty'])) {
                    continue;
                }

                $cart_items += $val['qty'];
                $cart_total += $val['subtotal'];

            }
            ?>
            <a href="<?php echo base_url() ?>cart">

                <i class="fa fa-fw fa-shopping-cart mobile_shoping_icon"></i>


                <span class="total_item_bag mobile_cart_icon"><?php echo $cart_items; ?></span>


            </a>

        </div>


        <form action="<?php echo base_url() ?>search">

            <div class="input-group mb-4 mobile_search_input">
                <input type="search" placeholder="What're you searching for?" aria-describedby="button-addon6"
                       autocorrect="off" autocapitalize="off"
                       autocomplete="off" spellcheck="false" name="q" oninput="searchItemProduct(this.value)"
                       class="form-control">
                <div class="input-group-append">
                    <button id="button-addon6" type="submit" style="background-color: #C31B21;border: none;"
                            class="btn btn-info">Search
                    </button>
                </div>
                <div class="search-area" style="display:block;">
                    <ul class="dropdown-menu" style="display: block;">


                    </ul>

                </div>
            </div>


        </form>


    </div>
</div>


<nav class="mobile-nav" id="mobile-nav" style="z-index: 9999991">
    <ul class="nav__item-container" style="margin-left: 72px;">
        <li class="nav__item off-canvas__container" data-off-canvas-direction="right">

            <a style="position: relative;

left: -59px;

font-size: 15px;

color:
black;

top: 0px;

padding: 8px 1px;" href="JavaScript:Void(0);"
               id="mobile_menu_close_cross_icon">All Categories &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;✕</a>


            <ul class="nav__item__content off-canvas__content">

                <?php
                $parentCategories = get_result("SELECT category_title,category_id,category_name FROM `category` where parent_id=0   ORDER BY rank_order ASC");
                foreach ($parentCategories as $parentCategory) {
                    if ($parentCategory->category_name == 'popular-product' or $parentCategory->category_name == 'tend-product') {
                        continue;
                    }

                    $parent_id = $parentCategory->category_id;
                    $link_parent = base_url() . 'category/' . $parentCategory->category_name;
                    $subCategories = get_result("SELECT * FROM `category` where  parent_id=$parent_id   ORDER BY rank_order ASC");

                    if ($subCategories) {
                        ?>

                        <li class="nav__item">
                        <span class="nav-click"><i class="fa fa-fw fa-angle-down"></i></span>
                        <a href="<?php echo $link_parent; ?>"
                           class="nav__item__title"><?php echo $parentCategory->category_title; ?></a>
                        <?php
                        $subCategories = get_result("SELECT category_title,category_id,category_name FROM `category` where  parent_id=$parent_id   ORDER BY rank_order ASC");
                        if (isset($subCategories)) {
                            foreach ($subCategories as $subCategory) {

                                $sub_parent = $subCategory->category_id;
                                $link_sub_parent = base_url() . 'category/' . $subCategory->category_name;


                                ?>
                                <ul class="nav__item__content">
                                    <?php $childenCategories = get_result("SELECT category_title,category_id,category_name FROM `category` where  parent_id=$sub_parent   ORDER BY rank_order ASC");
                                    if (isset($childenCategories)) {

                                        ?>

                                        <li class="nav__item">
                                            <span class="nav-click"><i class="fa fa-fw fa-angle-down"></i></span>
                                            <a href="#"
                                               class="nav__item__title"><?php echo $subCategory->category_title; ?></a>
                                            <ul class="nav__item__content">
                                                <?php foreach ($childenCategories as $childen) {

                                                    $sub_parent = $subCategory->category_id;
                                                    $link_sub_sub_parent = base_url() . 'category/' . $childen->category_name;

                                                    ?>

                                                    <li class="nav__item"><a
                                                            href="<?php echo $link_sub_sub_parent; ?>"
                                                            class="nav__item__title"><?php echo $childen->category_title; ?></a>
                                                    </li>

                                                <?php } ?>

                                            </ul>
                                        </li>
                                    <?php } else { ?>
                                        <li class="nav__item"><a href="<?php echo $link_sub_parent; ?>"
                                                                 class="nav__item__title"><?php echo $subCategory->category_title; ?></a>
                                        </li>

                                        </li>
                                    <?php } ?>


                                </ul>


                            <?php }
                        }
                    } else { ?>


                        <li class="nav__item"><a href="<?= $link_parent ?>"
                                                 class="nav__item__title"><?php echo $parentCategory->category_title; ?></a>
                        </li>

                    <?php }
                } ?>
                <input type="hidden" name="mobile-nav">
            </ul>

        </li>

    </ul>

</nav>

<! ----------------------- Main Navigation -------------------------------->

<div style="position: fixed;
width: 100%;
z-index: 1000;
background-color:
#29869B;
height: 30px;

padding-left: 21px;" class="desktop_menu_bar">


    <?php
    $parentCategories = get_result("SELECT  category_id,category_name,category_title FROM `category` where parent_id=0 ORDER BY rank_order ASC limit 12");
    $naveid = 0;
    $count = 0;
    foreach ($parentCategories as $parentCategory) {


        $count++;


        $parent_id = $parentCategory->category_id;
        $link_parent = base_url() . 'category/' . $parentCategory->category_name;

        ?>
        <div class="dropdown_sujon">
            <a class="<?php if ($count == 10) {
                echo 'dropbtn-content_right';
            } else {
                echo 'dropbtn';
            } ?>" href="<?php echo $link_parent; ?>"><?php echo $parentCategory->category_title ?></a>

            <div class="<?php if ($count == 10) {
                echo 'dropdown-content_right';
            } else {
                echo 'dropdown-content';
            } ?>">
                <?php
                $subCategories = get_result("SELECT category_id,category_name,category_title FROM `category` where  parent_id=$parent_id ORDER BY rank_order ASC");
                if (isset($subCategories)) {
                    foreach ($subCategories as $subCategory) {


                        $link_parent = base_url() . 'category/' . $subCategory->category_name;


                        ?>
                        <a href="<?php echo $link_parent; ?>"><?php echo $subCategory->category_title; ?></a>
                    <?php }
                } ?>
            </div>


        </div>

    <?php } ?>
</div>

