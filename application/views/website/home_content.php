


<div class="ecod_strip">
    <div class="wrapper">
        <div class="eCOD_notification">
            <ul class="regular eCOD_slider" id="eCOD_block">
            </ul>
        </div>
    </div>
</div>
<style>
    
    @media (max-width: 776px) {
      .mobile_slider_responstive {
          margin-top: -49px;
          margin-left: -7px;
          margin-right: 24px;
          width: 275px;
      }
    }
    
</style>
<! -------------------------------------- Main Slider -------------------------------------- !>
<div class="bnnr_container">
    <div id="wrapper">
        <section id="owl_carousel_slider">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">

                        <div class="slider-wrapper theme-default mobile_slider_responstive">

                            <div id="slider" class="nivoSlider">
                                <?php

                                $sliders = get_homeslider();


                                if(isset($sliders))
                                {


                                    foreach($sliders as $slider) {
                                        $slider_banner = base_url($slider->homeslider_banner);
                                        ?>
                                        <a href="<?php echo $slider->target_url;?>"><img src="<?=$slider_banner?>" data-thumb="<?=$slider_banner?>"    alt="" title="This is an example of a caption" /></a>

                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="container-fluid add_class">
    <div class="row">
        <?php
       // $adds = get_adds();
        $adds = get_result("SELECT adds_link,media_path FROM `adds`
WHERE adds_type='home' limit 3");

        if(isset($adds))
        {

        foreach ($adds as $add){
        ?>
        <div class="col-md-4 col-12 col-lg-4">
            <a target="_blank" href="<?php echo $add->adds_link;?>">
                <img class="img-fluid" src="<?php echo $add->media_path;?>" alt="">
            </a>
         </div>
        <?php } }?>

        </div>

    </div>

<! --------------------------- Main Content Area ------------------------------------ !>

<div class="container-fluid  mobile_category_show"   style="background-color: white;margin-left: 0px;">

    <div class="row mobile_add_responsive_portion" >


        <?php

        $result = get_result("SELECT * FROM `category` where parent_id=0 ORDER BY rank_order ASC");
        if(isset($result))
        {

            $i=1;
            foreach($result as $row)
            {
                $category[$row->parent_id][]=$row;
            }

            foreach($result as $row)
            {

                if($row->parent_id==0)
                {

                    if($i<=8){
                        $media =get_media_path($row->medium_banner);
                        if($row->category_name=='popular-product' or $row->category_name=='tend-product' or $row->category_name=='buy-one' or $row->category_name=='big-discount' or $row->category_name=='menbership' or $row->category_name=='footwear'){
                            continue;
                        }


                        ?>
                        <div class="middle_mobile_category">
                            <a  href="<?php echo base_url();?>category/<?php echo  $row->category_name;?>">
                                <?php if($media) { ?>
                                <img class="img-responsive" src="<?php echo $media;?>">
                            <?php } else { ?>
                                    <img class="img-responsive" src="<?php echo base_url();?>uploads/footware.jpg">

                                <?php }?>
                           
                            <h4 style="font-size: 12px;
padding: 3px 4px;
text-align: center;" ><?php echo $row->category_title;?></h4>
 </a>
                        </div>
                        <?php
                    }
                    $i++;
                }


            }


        }
        ?>



    </div>
</div>

<! ------------------------------ Small Gap Before next carousel ----------------------------- !>

<div class="ecod_strip">
    <div class="wrapper">
        <div class="eCOD_notification">
            <ul class="regular eCOD_slider" id="eCOD_block">
            </ul>
        </div>
    </div>
</div>

<! ------------------------------ Small Gap Before next carousel ----------------------------- !>






<span class="home_cat_content"></span>

<script type="text/javascript">


    window.onload = function() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", '<?php echo base_url('ajax/home_cat_content'); ?>');
        xhr.send();
        xhr.onreadystatechange = function()
        {
            jQuery('.home_cat_content').html(xhr.responseText);
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
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    }

                ]


            });
        }
    }



</script>




<script>
  //  jQuery('.main_carosel_category_link').click(function () {
    jQuery(document).on('click','.main_carosel_category_link', function () {
       var href= this.href;
        window.location=href;

    });

    </script>
