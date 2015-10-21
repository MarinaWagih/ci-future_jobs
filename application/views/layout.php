<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>::FUTURE JOBS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>

    <?php
    if (!isset($_SESSION['lang']))
        $_SESSION['lang'] = "en";
    ?>

    <?php
    if ($_SESSION['lang'] == "en") {

        $this->lang->load("msg", "english");
        ?>
        <link href="<?php echo base_url();?>css/en/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url();?>css/en/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>css/en/theme.css" rel="stylesheet">
        <link href="<?php echo base_url();?>css/en/prettyPhoto.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>css/en/zocial.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>css/en/nerveslider.css" rel="stylesheet">
    <?php
    }
    else {
        $this->lang->load("msg", "arabic");
        ?>
        <link href="<?php echo base_url();?>css/ar/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url();?>css/ar/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>css/ar/theme.css" rel="stylesheet">
        <link href="<?php echo base_url();?>css/ar/prettyPhoto.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>css/ar/zocial.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>css/ar/nerveslider.css" rel="stylesheet">
    <?php
    }
    ?>

</head>
<body>
<div class="header">
    <div id="slider_header">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="navbar">
                        <button type="button" class="btn btn-navbar"
                                data-toggle="collapse" data-target=".nav-collapse">
                            <i class="icon-align-justify icon-2x"></i>
                        </button>
                        <!--logo-->
                        <div class="logo">
                            <a href="index.html">
                                <img src="<?php echo base_url(); ?>css/img/logo.png" alt=""
                                     class="animated bounceInDown"/>
                            </a>
                        </div>
                        <div class="top_menu">
                            <ul class="nav pull-right">
                                <?php if(isset($this->session->userdata('logged_in')['id'])){?>
                                <li class="dropdown profile">
                                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                       data-delay="1000" data-close-others="true" href="javascript:{}">
                                        <?php echo $this->lang->line('profile'); ?>
                                        <span class="caret menu-caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?php echo site_url('user/show').'?id='.($this->session->userdata('logged_in')['id']); ?>">
                                                <?php echo $this->lang->line('profile'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('logout'); ?>">
                                                <?php echo $this->lang->line('logout'); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <?php }else{?>
                                <li class="profile">

                                    <a href="<?php echo site_url('login'); ?>">
                                        <?php echo $this->lang->line('sign in'); ?>
                                    </a>
                                </li>
                                <?php }?>
                                <li class="country">
                                    <select name="country" id="country_link">
                                        <option><?php echo $this->lang->line('search_in_country')?></option>
                                        <?php
                                        for ($i = 0; $i < count($this->countries); ++$i)
                                        {
                                            $name=$_SESSION['lang']=='ar'?$this->countries[$i]['name_ar']:
                                                                             $this->countries[$i]['name'];
                                            echo "<option value='".$this->countries[$i]['id']."'>".
                                                $name."</option>";
                                        }
                                        ?>
                                    </select>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('change_lang') ?>" class="arabic_link">
                                        <?php echo $this->lang->line('lang'); ?>

                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="nav-collapse collapse">
                            <ul class="nav pull-right">
                                <li class="active">
                                    <a href="<?php echo site_url('/') ?>">
                                        <?php echo $this->lang->line('home'); ?>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="<?php echo site_url('about') ?>">
                                        <?php echo $this->lang->line('about'); ?>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                       data-delay="1000" data-close-others="true" href="javascript:{}">
                                        <?php echo $this->lang->line('services'); ?> <span
                                            class="caret menu-caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?php echo site_url('foreign_labor/add') ?>"><?php echo $this->lang->line('foreign_labor'); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('professional_consulting_services') ?>"><?php echo $this->lang->line('professional_consulting_services'); ?></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                       data-delay="1000" data-close-others="true" href="javascript:{}">
                                        <?php echo $this->lang->line('jobs'); ?> <span class="caret menu-caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo site_url('job/search') ?>"><?php echo $this->lang->line('search'); ?></a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                       data-delay="1000" data-close-others="true" href="javascript:{}">
                                        <?php echo $this->lang->line('companies'); ?> <span
                                            class="caret menu-caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo site_url('companies_contract') ?>"><?php echo $this->lang->line('companies_contract'); ?></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('adv_with_us') ?>"> <?php echo $this->lang->line('adv_with_us'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('contact_us') ?>"><?php echo $this->lang->line('contact_us'); ?></a>
                                </li>
                            </ul
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="myslider">
        <img src="<?php echo base_url(); ?>css/img/large/big_slider1.jpg" alt="">
        <img src="<?php echo base_url(); ?>css/img/large/big_slider2.jpg" alt="">
        <img src="<?php echo base_url(); ?>css/img/large/big_slider3.jpg" alt="">
    </div>
    <div class="container">
        <div class="inner_content">
            <div class="pad30"></div>
            <div class="span12">
                <div class="row">
                    <div class="row">
                        <div class="span3">
                            <div class="tile">
                                <?php
                                for ($i = 0; $i < count($this->left_adv); ++$i)
                                {
                                    $name=$this->left_adv[$i]['image'];
                                   ?>
                                    <a href="#">
                                        <img class="tile-image big-illustration"
                                             alt=""
                                             src="<?php echo base_url().'images/adv/'.$name; ?>"/>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>

                        </div>
                        <div class="span6">

                            <?php
                            if (isset($data)) {
                                $this->load->view($content, $data);
                            } else {
                                $this->load->view($content);
                            }

                            ?>
                        </div>
                        <div class="span3">
                            <div class="tile">
                                <?php
                                for ($i = 0; $i < count($this->right_adv); ++$i)
                                {
                                    $name=$this->right_adv[$i]['image'];
                                    ?>
                                    <a href="#">
                                        <img class="tile-image big-illustration"
                                             alt=""
                                             src="<?php echo base_url().'images/adv/'.$name; ?>"/>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!--col 1-->
                <div class="span12">
                    <div class="row">
                        <div class="pad30 hidden-phone"></div>
                        <!--column 2 circle slider-->
                        <div class="span8 pad25">
                            <!--circle slider-->
                            <div class="content_slider_wrapper" id="slider1"></div>
                            <div class="pad45"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--strip-->
    <div class="strip">
        <h1 class="center">Get A Free Quote</h1>

        <h3 class="center about_strip">
            Ecilisis venenatis risus, suspendisse ac nec et. Nulla sed mauris, congue duis
            proin nonummy.
            Elementum phasellus mauris sed nulla sed, egestas feugiat a dictum libero vivamus purus arcu, commodo cursus
            egestas et.
        </h3>

        <div class="pad25"></div>
        <a href="<?php echo site_url('contact_us') ?>" class="btn big-button ">
            <i class="icon-envelope icon-space"></i>
            <?php echo $this->lang->line('contact_us'); ?>
        </a>

        <div class="pad25"></div>
        <div class="follow_us">
            <a href="#" class="zocial twitter"></a>
            <a href="#" class="zocial facebook"></a>
            <a href="#" class="zocial linkedin"></a>
            <a href="#" class="zocial googleplus"></a>
            <a href="#" class="zocial vimeo"></a>
        </div>
    </div>
    <!--/strip-->
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="copyright">

                        copyright &copy; 2015 — FUTURE JOBS — All Rights Reserved

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- up to top -->
    <a href="#"><i class="go-top hidden-phone hidden-tablet  icon-double-angle-up"></i></a>
    <!--//end-->
</div>
<!-- scripts -->
<script src="<?php echo base_url() ?>js/en/jquery.js"></script>
<script src="<?php echo base_url() ?>js/en/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>js/en/scripts.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/en/functions.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/en/jquery.content_slider.min.js" type="text/javascript"></script>

<!-- circle slider ADD YOUR IMAGES HERE -->
<script type="text/javascript">
    //<![CDATA[
    (function ($) {
        $(document).ready(function () {
            var image_array = new Array();
            image_array = [
                {
                    image: '<?php echo base_url()?>css/img/work_slide/1.jpg',
                    link_url: '<?php echo base_url()?>css/img/work_slide/1.jpg',
                    link_rel: 'prettyPhoto'
                },
                {
                    image: '<?php echo base_url()?>css/img/work_slide/2.jpg',
                    link_url: '<?php echo base_url()?>css/img/work_slide/2.jpg',
                    link_rel: 'prettyPhoto'
                },
                {
                    image: '<?php echo base_url()?>css/img/work_slide/3.jpg',
                    link_url: '<?php echo base_url()?>css/img/work_slide/3.jpg',
                    link_rel: 'prettyPhoto'
                },
                {
                    image: '<?php echo base_url()?>css/img/work_slide/4.jpg',
                    link_url: '<?php echo base_url()?>css/img/work_slide/4.jpg',
                    link_rel: 'prettyPhoto'
                },
                {
                    image: '<?php echo base_url()?>css/img/work_slide/5.jpg',
                    link_url: '<?php echo base_url()?>css/img/work_slide/5.jpg',
                    link_rel: 'prettyPhoto'
                },
                {
                    image: '<?php echo base_url()?>css/img/work_slide/6.jpg',
                    link_url: '<?php echo base_url()?>css/img/work_slide/6.jpg',
                    link_rel: 'prettyPhoto'
                },
                {
                    image: '<?php echo base_url()?>css/img/work_slide/7.jpg',
                    link_url: '<?php echo base_url()?>css/img/work_slide/7.jpg',
                    link_rel: 'prettyPhoto'
                }
            ];
            $('#slider1').content_slider({
                map: image_array,
                max_shown_items: 5,	// number of visible circles
                automatic_height_resize: 1,
                wrapper_text_max_height: 300,
                active_item: 0,
                border_on_off: 0,
                allow_shadow: 0,
                enable_mousewheel: 0
            });
            $("a[rel^='prettyPhoto']").prettyPhoto();
            jQuery("a[rel^='prettyPhoto'], a[rel^='lightbox']").prettyPhoto({
                overlay_gallery: false, social_tools: false, deeplinking: false
            });
        });
    })(jQuery);
    //]]>
</script>

<!-- nerve slider -->
<script src="<?php echo base_url() ?>js/en/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>js/en/jquery.nerveSlider.min.js" type="text/javascript"></script>
<script>
    //<![CDATA[
    $(document).ready(function () {
        $(".myslider").show();
        $(".myslider").startslider({
            slideTransitionSpeed: 500,
            slideTransitionEasing: "easeOutExpo",
            slidesDraggable: true,
            sliderResizable: true,
            showDots: true
        });
    });
    //]]>
</script>
<script>
    $(document).ready(function () {
        $('#country_link').change(function(){

            var loc ="<?php echo site_url('job/country')?>"+"?id="+$(this).val();
            window.location.href = loc;
        });


    });
</script>
</body>
</html>