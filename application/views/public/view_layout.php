<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?= $profile->nama_instansi ?></title>
    <script type="text/javascript" src="<?= base_url() ."js/jquery.min.js"; ?>"></script>
    <script type="text/javascript" src="<?= base_url() ."js/bootstrap.min.js"; ?>"></script>
    <link href="<?= base_url() ."css/font-awesome.min.css"; ?>" rel="stylesheet">
	<link href="<?= base_url() ."css/jquery-ui.min.css"; ?>" rel="stylesheet">
	<script src="<?= base_url() ."js/jquery-ui-custom.min.js"; ?>"></script>
	<link href="<?= base_url() ."css/keyboard.css"; ?>" rel="stylesheet">
	<script src="<?= base_url() ."js/jquery.keyboard.js"; ?>"></script>
	<script src="<?= base_url() .""; ?>js/jquery.mousewheel.js"></script>
    <link type="text/css" rel="stylesheet" href="<?= base_url() ."css/bootstrap.min.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/style.css"?>"/>
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/profile.css"?>"/> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/loading.css"?>"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."plugins/wow/style.css"?>"/>
    <link async rel="stylesheet" type="text/css" href="<?php echo base_url() ."sweetalert/sweetalert.css" ?>">
    <script src="<?php echo base_url() ."sweetalert/sweetalert.min.js" ?>"></script>
    <link
    rel="stylesheet"
    href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
    />

    <style>
      html,
      body {
        position: relative;
        height: 100%;
      }

      body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #000;
        margin: 0;
        padding: 0;
      }

      .swiper {
        width: 100%;
        height: 100%;
      }

      .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
        background-size:cover;
      }

      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      .title-slider{
          width:100%;
          padding:30px;
          margin:0px;
          position:fixed;
          height:auto;
          background:#00000047;
          color:#fff;
          font-size:24pt;
          z-index: 1050;
      }


      

      .swiper1 {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
      }

      .swiper-slide1 {
        background-position: center;
        background-size: cover;
        width: 250px;
        height: 250px;
      }

      .swiper-slide1 img {
        display: block;
        width: 100%;
      }
    </style>

    <script type='text/javascript'>
        var base_url="<?= base_url() ?>";
        <?php 
        if(empty($resource_url)){
          ?>
          var resource_url="";
          <?php
          
        }else{
          ?>
          var resource_url="<?= $resource_url ?>";
          <?php
        }
        ?>
        
    </script>
</head>
<body style="background: #fff;">
<div id="loading">
<div class="loader2">Loading..</div>
</div>

<div class="template">
    <div id="green">
        <!-- <div class="left">
            <img src="<?= base_url() .'files/profile/'.$profile->logo ?>" class="img-header" alt="">
        </div> -->
     </div>
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <div class="container">
                    <div class="left">
                      <a href="<?= base_url() ?>">
                        <img src="<?= base_url() .'files/profile/'.$profile->logo ?>" class="img-header" alt="">
                        </a>
                        <div style="font-size:14pt; color: #005331; float:left;padding-top:15px; font-weight:bold"><?= $profile->nama_instansi ?></div >
                    </div>
                    <div class="kanan-logo">
                      <ul class="info-klinik">
                        <li class="list-option"><span class="fa fa-home"></span> <?= $profile->alamat?></li>
                        
                        <li class="list-option"><span class="fa  fa-phone"></span> <?= $profile->notelp ?></li>
                        <!-- <li class="list-option"><span class="fa fa-envelope"></span> <?= $profile->email?></li> -->
                        <!-- <li class="list-option"><span class="fa fa-instagram"></span> #klinikku</li> -->
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    
    <?php if(!empty($content)) echo $content; ?>

    
    <script type="text/javascript" src="<?= base_url() ?>plugins/wow/wowslider.js"></script>
	  <script type="text/javascript" src="<?= base_url() ?>plugins/wow/script.js"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    
    
    
</div>
<?php 
if(!empty($libjs)){
    foreach ($libjs as $l ) {
        ?>
        <script type="text/javascript" src="<?= base_url() .$l ?>"></script>
        <?php
    }
}
?>
<script type="text/javascript">
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        effect: "creative",
        creativeEffect: {
          prev: {
            shadow: true,
            origin: "left center",
            translate: ["-5%", 0, -200],
            rotate: [0, 100, 0],
          },
          next: {
            origin: "right center",
            translate: ["5%", 0, -200],
            rotate: [0, -100, 0],
          },
        },
        spaceBetween: 5,
        centeredSlides: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination0",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

      var swiper1 = new Swiper(".mySwiper1", {
        loop: true,
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: true,
        },
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
        },
      });
    (function ($) {
        $(document).ready(function () {
            $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).parent().siblings().removeClass('open');
                $(this).parent().toggleClass('open');
            });
        });
    })(jQuery);
</script>
<footer>
        <div class="ftl">&copy; Copyrights 2021 <a href="#" target="_blank">Team IT <?= $profile->nama_instansi ?></a></div>
    </footer>
</body>
</html>
