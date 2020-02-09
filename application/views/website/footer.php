<! --------------------------- Footer Area ------------------------------------ !>
<style>
    #footer_class_id ul li {
        list-style: none;
        margin-left: 5px
    }

    #footer_class_id h5 {
        font-weight: 500;
    }

    #footer_class_id ul li a {
        text-decoration: none;
        color: #212529;
        display: inline-flex;
        width: 200px;
    }

    .social-link ul li a {
        text-decoration: none;
        color: #212529;
        display: inline-flex;

    }
</style>
<a id="button_move_to_top"> </a>
<style>
    #button_move_to_top {
        display: inline-block;
        background-color: red;
        width: 50px;
        height: 50px;
        text-align: center;
        border-radius: 4px;
        margin: 30px;
        position: fixed;
        bottom: 21px;
        right: -27px;
        transition: background-color .3s;
        z-index: 1000;
        opacity: 0.3;
    }

    #button_move_to_top::after {

        content: "\f077";
        font-family: FontAwesome;
        font-weight: normal;
        font-style: normal;
        font-size: 2em;
        line-height: 50px;
        color: #fff;

    }

    @media (max-width: 776px) {
        .about-footer {
        }

        .footer-image-botom{

            margin-top: -20px !important;
            margin-left: 197px !important;
            width: 100px;        }
        .address-footer {
            padding-left: 35px;
            margin-top: 10px;
        }

        .subscrive-footer {
            padding-left: 15px;
            margin-top: -30px;
            margin-bottom: -42px;

        }

        .subscrive-footer input {
            margin-left: 23px;
            margin-bottom: -17px;
            width: 50%;
        }

        .about-footer h5 {
        }

        .customer-footer {
        }

        #footer_class_id {
            padding: 0px 5px !important;
        }

        #footer_class_id .footer-ul {
            margin-left: 20px;

        }

        #footer_class_id h6 {
            margin-left: 24px !important;
        }

        #footer_class_id .footer-heading-5 {
            margin-left: 24px !important;
        }

        #footer_class_id .footer-heading-news {
            margin-left: 24px !important;
        }

        #footer_class_id .subscrive-booton {
            margin: -23px 19px;
            margin-top: -23px;
            margin-left: 19px;
            background-color: #138496;
            width: 152px !important;
            color: white;
            margin-left: 190px;
            margin-top: 4px;
            position: relative;
            top: -41px;
        }
   .last-footer {margin-left: 2px;margin-bottom: 32px;}
    }

    #footer_class_id {
        padding: 0px 30px
    }

    #footer_class_id .subscrive-booton {
        margin-top: 15px;
        background-color: #138496;
        width: 295px;
        color: white
    }

    #footer_class_id .footer-heading-5 {
        margin-left: 46px;
    }
    .footer-image-botom{

        margin-top: -27px;margin-left: 207px;
        width: 127px;
    }

</style>

<div id="footer_class_id" class="container-fluid">

    <div class="row">
        <div class="col-md-3 col-lg-3 col-12 address-footer">
            <h5>Got Question ? <br/>Call us 24/7
                <?= get_option('phone') ?>
            </h5>
            <address>

                Gazi Bhaban<br/>
                35, Senpara Porborata, Level-5<br/>
                Mirpur-10(Fall Potti), Mirpur, Dhaka-1216



            </address>
        </div>

        <div class="col-md-3 col-lg-3 col-6 about-footer">
            <h5 class="footer-heading-5">Follow Us
            </h5>

                <ul class="social-link footer-ul">
                    <li>
                        <a  target="_blank" href="<?php echo get_option('facebook'); ?>" class="round2">
                            <img style="width: 19px;" src="https://www.qurancampus.com/images/social/fb.png" class="fb-icon">
                            Facebook
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo get_option('twitter'); ?>" class="round1">
                            <img style="width: 19px;" src="https://www.qurancampus.com/images/social/tw.png" class="tweet-icon">
                           Twitter
                        </a>
                    </li>

                    <li>
                        <a target="_blank" href="<?php echo get_option('instagram'); ?>" class="round4">
                            <img style="width: 19px;" src="https://www.qurancampus.com/images/social/in.png" class="link-icon">
                           LinkedIn
                        </a>
                    </li>
                    <li>
                        <a  target="_blank" href="<?php echo get_option('youtube'); ?>" class="round5">
                            <img style="width: 19px;" src="https://www.qurancampus.com/images/social/yt.png" class="you-icon">
                           Youtube
                        </a>
                    </li>

                </ul>

        </div>
        <div class="col-md-3 col-lg-3 col-6 customer-footer">
            <h5 class="footer-heading-5">Important link
            </h5>
            <ul class="footer-ul">
                <li><a target="_blank" style="font-style: normal;
line-height: inherit;" href="<?php echo base_url() ?>pages/about">About US</a></li>
                <li><a target="_blank" style="font-style: normal;
line-height: inherit;" href="<?php echo base_url() ?>pages/contact">Contact US</a></li>
                <li><a target="_blank" style="font-style: normal;
line-height: inherit;" href="<?php echo base_url() ?>pages/about">Privacry Policy</a></li>

                <li><a target="_blank" style="font-style: normal;
line-height: inherit;" href="<?php echo base_url() ?>pages/terms">Terms and Conditions</a></li>
                <li><a target="_blank" style="font-style: normal;
line-height: inherit;" href="<?php echo base_url() ?>pages/return_policy">Return and
                        Refund Policy</a></li>
                <li><a target="_blank" style="font-style: normal;
line-height: inherit;" href="<?php echo base_url() ?>pages/page_track">Track Your
                        Order</a></li>



            </ul>
        </div>
        <div class="col-md-3 col-lg-3 col-12 subscrive-footer">
            <h5 class="footer-heading-news">
                Newsletter
            </h5>
            <h6 style="font-size: 15px;color:red"> Sign up for update product</h6>

            <form id="newsletter" method="post">
                <input type="text" class="form-control" name="footer_newsletter_email" id="footer_newsletter_email">
                <h5 id="message_email_sub"></h5>
                <button type="button" id="subscribe_id" class="button subscrive-booton ">Subscribe
                </button>
            </form>
        </div>
    </div>

</div>


<div class="wrapper">
    <footer>


        <div class="scfooter_bottom">
            <div class="wrapper">

                <ul class="last-footer">
                    <li>Edushop © 2020 || <a href="#">Developed by </a><a href="https://www.isolutionsbd.com/"><font
                                color="#6bc44d"><img  class="footer-image-botom"   src="https://www.isolutionsbd.com/wp-content/uploads/2019/01/logo.png" alt="Logo"></font></a>
                    </li>

                </ul>

            </div>
        </div>
    </footer>
</div>
<?php if (isset($mobile_bottom_menu_active)) { ?>

    <div data-spm="footer" id="footer-bar" class="mobile_bottom_class" data-aplus-ae="x2_7da33929"
         data-spm-anchor-id="a2g0n.home.0.footer.121e78c9Ilrh4R" data-spm-max-idx="4">
        <div class="footer-item">
            <a id="footer-home" href="<?php echo base_url() ?>" data-spm="d_home"
               data-spm-anchor-id="a2g0n.home.footer.d_home">
                <svg version="1.1" class="footer-icon footer-icon-active" viewBox="0 0 90 100"
                     xmlns="http://www.w3.org/2000/svg" data-spm-anchor-id="a2g0n.home.d_home.i0.121e78c9Ilrh4R">
                    <g fill="none" fill-rule="evenodd">
                        <g transform="translate(-187 -181)" stroke-width="6">
                            <path
                                d="m242.07 232.86h-20c-2.7614 0-5 2.2386-5 5v29.145c0 2.7614-2.2386 5-5 5h-17.072c-2.7614 0-5-2.2386-5-5v-41.639c0-5.6178 2.3627-10.977 6.5103-14.766l26.745-24.433c3.8196-3.4895 9.6701-3.4895 13.49 0l26.745 24.433c4.1476 3.7891 6.5103 9.148 6.5103 14.766v41.639c0 2.7614-2.2386 5-5 5h-22.928"></path>
                        </g>
                    </g>
                </svg>
                <span class="footer-text footer-active">Home</span>
            </a>
        </div>
        <div class="footer-item">
            <a id="footer-category" class="off-canvas-toggle" href="JavaScript:Void(0)" data-spm="d_category"
               data-spm-anchor-id="a2g0n.home.footer.d_category">
                <svg class="footer-icon" version="1.1" viewBox="0 0 83 61" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" fill-rule="evenodd">
                        <g transform="translate(1.08 2)" stroke-width="6">
                            <path d="m0.92995 0.91935h3.7198" stroke-linecap="round"></path>
                            <path d="m25.109 0.91935h52.077" fill="#262626" fill-rule="nonzero"
                                  stroke-linecap="square"></path>
                            <path d="m1.8599 28.5h3.7198" stroke-linecap="round"></path>
                            <path d="m26.038 28.5h52.077" fill="#262626" fill-rule="nonzero"
                                  stroke-linecap="square"></path>
                            <path d="m1.8599 56.081h3.7198" stroke-linecap="round"></path>
                            <path d="m26.038 56.081h52.077" fill="#262626" fill-rule="nonzero"
                                  stroke-linecap="square"></path>
                        </g>
                    </g>
                </svg>
                <span class="footer-text">Categories</span>
            </a>
        </div>
        <div class="footer-item">
            <a id="footer-cart" href="<?php echo base_url() ?>cart" data-spm="d_shopcart"
               data-spm-anchor-id="a2g0n.home.footer.d_shopcart">
                <svg class="footer-icon" version="1.1" viewBox="0 0 92 87" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" fill-rule="evenodd">
                        <g transform="translate(-184 -145)" stroke-width="6">
                            <g transform="translate(184.18 155.15)">
                                <path
                                    d="m1.4211e-14 -3.5527e-15 13.78-2.1316e-14c1.7737-3.2582e-16 3.5395 0.23594 5.2509 0.70162l69.117 18.806c-2.2723 13.843-11.261 25.659-23.996 31.543l-0.67465 0.31172h-41.023c-1.1046 0-2-0.89543-2-2v-22.01"></path>
                                <circle cx="22.321" cy="73.352" r="7.5"></circle>
                                <circle cx="77.321" cy="73.352" r="7.5"></circle>
                            </g>
                        </g>
                    </g>
                </svg>
                <span class="footer-text">Cart</span>
            </a>
        </div>
        <div class="footer-item">
            <a id="footer-account" href="<?php echo base_url() ?>affiliate/login_signup" data-spm="d_account"
               data-spm-anchor-id="a2g0n.home.footer.d_account">
                <svg class="footer-icon" version="1.1" viewBox="0 0 85 95" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" fill-rule="evenodd">
                        <g transform="translate(-192 -145)" stroke-width="6">
                            <g transform="translate(194.78 156)">
                                <path
                                    d="m0.22342 79.862-0.196-10.336c-0.17765-9.3678 6.1719-17.603 15.277-19.814l12.786-3.1049c4.6698-1.134 9.5437-1.1296 14.211 0.012799l12.848 3.1444c8.9501 2.1905 15.245 10.212 15.245 19.427v8.4245h-51.18"></path>
                                <path
                                    d="m34.223 31c8.2843 0 15-6.9396 15-15.5 0-5.001-2.292-9.4488-5.8497-12.283-2.5322-2.0172-5.7056-3.217-9.1503-3.217-8.2843 0-15 6.9396-15 15.5 0 8.5604 6.7157 15.5 15 15.5z"></path>
                            </g>
                        </g>
                    </g>
                </svg>
                <span class="footer-text">Account</span>
            </a>
        </div>
    </div>
<?php } ?>
<div class="cart_money_icon ">
    <?php
    $cart_items = $cart_total = 0;

    foreach ($this->cart->contents() as $key => $val) {
        if (!is_array($val) OR !isset($val['price']) OR !isset($val['qty'])) {
            continue;
        }

        $cart_items += $val['qty'];
        $cart_total += $val['subtotal'];

    }
    ?>
    <a href="<?php echo base_url() ?>cart" style="text-decoration: none">

        <div style="background-color: #29869B;height: 44px;text-align: right;color: white;width: 70px;">
            <img style="margin-left: 17px;
width: 33px;
height: 37px;" src="<?php echo base_url() ?>images/bag.gif">
            <br>

            <div class="text-center">
                <span id="total_item_bag"><?php echo $cart_items; ?> </span>

            </div>
        </div>
        <h6 style="z-index: 9999999;
text-align: center;
font-size: 15px;
color: black;"><span id="total_amount_bag"><?php echo $cart_total; ?></span> <span>Tk.</span></h6>
    </a>
</div>


<script src="<?= base_url() ?>assets/fontend/js/home/common_header.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/fontend/js/slick.min.js"></script>
<script type='text/javascript' src='<?= base_url() ?>assets/fontend/js/home/pixelyoursite.js'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/fontend/js/mobile_menu.js'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/fontend/js/home/sweetalert.min.js?ver=4.9.5'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/fontend/js/home/custom.js?ver=4.9.7'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/fontend/js/bootstrap.min.js'></script>
<script src="<?= base_url() ?>assets/fontend/js/lightslider.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/fontend/js/elevatezoom.js"></script>
<script src="<?= base_url() ?>assets/fontend/js/popper.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/fontend/js/jquery.nivo.slider.js"></script>


<script type="text/javascript">
    jQuery(window).load(function () {
        jQuery('#slider').nivoSlider();
    });
</script>
<script type="text/javascript">

    jQuery(document).on('ready', function () {
        jQuery('.boka').slick({
            autoplay: true,
        });

        jQuery(".boka1").slick({
            dots: false,
            infinite: true,
            slidesToShow: 6,
            slidesToScroll: 6,
            autoplay: true,
            autoplaySpeed: 2000,

            pauseOnHover: true,

            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                }

            ]


        });
    });
    jQuery('body').click(function () {
        // $("#table_click_hide").hide();
        jQuery(".search-area").toggle();
        var body_click_hide_menu = jQuery('input[name=mobile-nav]').val();
        if (body_click_hide_menu === "active") {

            jQuery(".mobile-nav").fadeIn();
            jQuery('input[name=mobile-nav]').val("Inactive");
        } else {


            jQuery(".mobile-nav").fadeOut(99);
            jQuery('input[name=mobile-nav]').val("active");
        }


    });

</script>

<script>

    jQuery('#mobile_menu_close_cross_icon').click(function () {
        jQuery('.mobile-nav').hide();
        jQuery(this).hide();
    });
    jQuery('.sc_rlinks_btm #order_track').click(function () {

        var mobile = jQuery('.ffix_header #mobileNuberTotrack').val();
        if (!/^01\d{9}$/.test(mobile)) {
            alert('Enter Valid Mobile Number');
        } else {

            var base = "<?php echo base_url()?>";
            var str2 = "trackorder/";
            var final_one = base.concat(str2);
            var final_link = final_one.concat(mobile);
            window.location.href = final_link;
        }

    });
    function searchItemProduct(id) {

        var search_query = id;


        jQuery(".search-area").show();

        if (search_query.length >= 1) {


            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: '<?php echo base_url(); ?>Home/ajax_search_items',
                data: {
                    search_query: search_query
                },

                success: function (response) {


                    if (response.status == "success") {
                        jQuery(".dropdown-menu").html(response.return_value);
                    }
                }
            })
        } else {
            jQuery(".dropdown-menu").html('');

        }


    }
    jQuery('#lightSlider').lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        slideMargin: 0,
        thumbItem: 9
    });

    jQuery("#zoom_09").elevateZoom({
        gallery: "gallery_09",
        galleryActiveClass: "active"
    });

</script>

<script>


    jQuery('body').on('click', '.xs-item-count', function () {
        var location = '<?php echo base_url() ?>chechout';
        //window.location('')
        window.location.href = location;
    });

    jQuery('body').on('click', '.add_to_cart , .add_to_cart_mobile', function () {
        var product_id = jQuery(this).attr('data-product_id');
        var product_price = jQuery(this).attr('data-product_price');
        //var product_size = jQuery('#product_size').val();
        var product_title = jQuery(this).attr('data-product_title');

        var product_qty = 1;
        if (jQuery("#product_qty").length > 0) {
            product_qty = jQuery("#product_qty").text();

        }


        jQuery.ajax({
            type: 'POST',
            data: {
                "product_id": product_id,
                "product_qty": product_qty,
                "product_price": product_price,
                "product_title": product_title

            },
            url: '<?php echo base_url()?>ajax/add_to_cart',
            success: function (result) {
                var total_result = JSON.parse(result);

                jQuery('.xs-item-count').text(total_result.cart_items);
                jQuery('#total_item_bag').text(total_result.cart_items);
                jQuery('.total_item_bag').text(total_result.cart_items);
                jQuery('#total_amount_bag').text(total_result.cart_total);


            }

        });

        return false;
    });

</script>


<script>
    jQuery('body').on('click', '.buy_now , .buy_to_cart_mobile', function () {
        var product_id = jQuery(this).attr('data-product_id');
        var product_price = jQuery(this).attr('data-product_price');
        var product_title = jQuery(this).attr('data-product_title');

        var product_qty = 1;
        if (jQuery("#product_qty").length > 0) {
            product_qty = jQuery("#product_qty").text();

        }

        jQuery.ajax({
            type: 'POST',
            data: {
                "product_id": product_id,
                "product_qty": product_qty,
                "product_price": product_price,
                "product_title": product_title
            },
            url: '<?php echo base_url()?>ajax/add_to_cart',
            success: function (result) {

                var total_result = JSON.parse(result);

                jQuery('#shoping_bag .itemno').text(total_result);
                var location = '<?php echo base_url() ?>chechout';
                //window.location('')
                window.location.href = location;
            }
        });

        return false;
    });
</script>
<script>

    jQuery(document).ready(function () {

        var btn = jQuery('#button_move_to_top');

        var width = jQuery(window).width();
        if (width < 768) {
            jQuery('.mobile_bottom_class').show();
        } else {
            jQuery('.mobile_bottom_class').hide();
        }


        jQuery(window).scroll(function () {


            // OR  jQuery(window).scroll(function() {
            var scroll = jQuery(window).scrollTop();
            if (scroll > 30) {
                // alert('ok');
                btn.show();
            } else {
                //  alert('no');

                btn.hide();
            }
        });

        btn.on('click', function (e) {
            e.preventDefault();
            jQuery('html, body').animate({scrollTop: 0}, '300');
        });


        $('#subscribe_id').click(function () {

            var email = $('#footer_newsletter_email').val();

            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (regex.test(email)) {
                $.ajax({
                    url: '<?php echo base_url()?>home/subscribe',
                    data: {email: email},
                    type: "POST",
                    success: function (result) {

                        $('#message_email_sub').html('<span class="text-success">Thank you for subscribe</span>');
                    }

                })
            } else {
                $('#message_email_sub').html('<span class="text-danger">Enter valid email</span>');
            }
        });

    });


</script>


</body>
</html>