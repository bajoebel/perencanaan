<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?= TITLE ?></title>
    
    <script type="text/javascript" src="<?= base_url() ."js/jquery.min.js"; ?>"></script>
    <script type="text/javascript" src="<?= base_url() ."js/bootstrap.min.js"; ?>"></script>

    <link href="<?= base_url() ."css/font-awesome.min.css"; ?>" rel="stylesheet">
	<!-- <link href="css/demo.css" rel="stylesheet"> -->

	<!-- jQuery & jQuery UI + theme (required) -->
	<link href="<?= base_url() ."css/jquery-ui.min.css"; ?>" rel="stylesheet">
	<!-- <script src="<?= base_url() ."js/jquery-latest-slim.min.js"; ?>"></script> -->
	<script src="<?= base_url() ."js/jquery-ui-custom.min.js"; ?>"></script>

	<!-- keyboard widget css & script (required) -->
	<link href="<?= base_url() ."css/keyboard.css"; ?>" rel="stylesheet">
	<script src="<?= base_url() ."js/jquery.keyboard.js"; ?>"></script>

	<!-- keyboard extensions (optional) -->
	<script src="<?= base_url() .""; ?>js/jquery.mousewheel.js"></script>
    <!-- <script src="js/jquery.keyboard.extension-scramble.js"></script> -->
    
    <link type="text/css" rel="stylesheet" href="<?= base_url() ."component/bootstrap-datepicker/dist/css/bootstrap-datepicker.css"; ?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url() ."css/bootstrap.min.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/style.css"?>"/>
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/profile.css"?>"/> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/loading.css"?>"/>
    <link async rel="stylesheet" type="text/css" href="<?php echo base_url() ."sweetalert/sweetalert.css" ?>">
    <script src="<?php echo base_url() ."sweetalert/sweetalert.min.js" ?>"></script>
    <script type='text/javascript'>
        var base_url="<?= base_url() ?>";
    </script>
    <style type="text/css">
        .tox .tox-notification--warn, .tox .tox-notification--warning {
            background-color: #fffaea;
            border-color: #ffe89d;
            color: #222f3e;
            bottom: -100px;
            position: fixed;
        }
        /* .tox-notifications-container {
            display:none;
        }
        .tox-tinymce-aux {
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
            z-index: 1300;
            display: none;
            }
            .tox .tox-notification--warn, .tox .tox-notification--warning {
            background-color: #fffaea;
            border-color: #ffe89d;
            color: #222f3e;
            display: none;
            } */
    </style>
</head>
<body style="background: #fff;">
<div id="loading">
<div class="loader2">Loading..</div>
</div>
<div class="template">
    <div id="green">
        <div class="left">
            <img src="<?= base_url() .LOGO?>" class="img-header" alt="">
        </div>
     </div>
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <div class="">
                    <div class="left">
                        <img src="<?= base_url() .LOGO; ?>" class="img-header" alt="">
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="<?php if($aktif==1) echo "active" ?>"><a href="<?= base_url()."admin/dasboard" ?>"><span class="fa fa-home"></span> Home</a></li>
                <li class="<?php if($aktif==2) echo "active" ?>"><a data-toggle="tab" href="#menu1"><span class="fa fa-cubes"></span> Master</a></li>
                <li class="<?php if($aktif==3) echo "active" ?>"><a data-toggle="tab" href="#menu2"><span class="fa fa-newspaper-o"></span> Blog</a></li>
                <li class="<?php if($aktif==5) echo "active" ?>"><a data-toggle="tab" href="#menu4"><span class='fa fa-users'></span> Pengguna</a></li>
                <li class="<?php if($aktif==6) echo "active" ?>"><a data-toggle="tab" href="#menu5"><span class='fa fa-gear'></span> Pengaturan</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade <?php if($aktif==1) echo "in active" ?>">
                    
                </div>
                <div id="menu1" class="tab-pane fade <?php if($aktif==2) echo "in active" ?>">
                    <div class="box-icon">
                    <a href="<?= base_url() ."admin/kategori" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/category.png" ?>" alt=""  class='img img-circle'><br>Kategori</a>
                    <a href="<?= base_url() ."admin/kategori_video" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/master/kategori_video.png" ?>" alt=""  class='img img-circle'><br>Kategori Video</a>
                    <a href="<?= base_url() ."admin/menu" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/menu.png" ?>" alt="" class='img img-circle'><br>Menu</a>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade <?php if($aktif==3) echo "in active" ?>">
                    <div class="box-icon">
                        <a href="<?= base_url() ."admin/berita" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/news.png" ?>" alt="" class='img img-circle'><br>Artikel</a>
                        <a href="<?= base_url() ."admin/halaman" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/pages.png" ?>" alt="" class='img img-circle'><br>Halaman</a>
                        <a href="<?= base_url() ."admin/slider" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/slider.png" ?>" alt="" class='img img-circle'><br>Slider</a>
                        <a href="<?= base_url() ."admin/partner" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/partner.png" ?>" alt="" class='img img-circle'><br>Rekan</a>
                        <a href="<?= base_url() ."admin/media" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/media.png" ?>" alt="" class='img img-circle'><br>Media</a>
                        <a href="<?= base_url() ."admin/embed" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/youtube.png" ?>" alt="" class='img img-circle'><br>Embed Youtube</a>
                        <a href="<?= base_url() ."admin/tamu" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/komentar.png" ?>" alt="" class='img img-circle'><br>Tamu</a>
                        <a href="<?= base_url() ."admin/kritik" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/kritik.png" ?>" alt="" class='img img-circle'><br>Kritik</a>
                    </div>
                </div>
                
                <div id="menu4" class="tab-pane fade <?php if($aktif==5) echo "in active" ?>">
                    <div class="box-icon">
                        <a href="<?= base_url() ."admin/user" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/pengguna/users.png" ?>" alt=""  class='img img-circle'><br>Users</a>
                    </div>
                </div>
                <div id="menu5" class="tab-pane fade <?php if($aktif==6) echo "in active" ?>">
                    <div class="box-icon">
                        <a href="<?= base_url() ."admin/hakakses" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/pengaturan/hakakses.png" ?>" alt="" class='img img-circle'><br>Pengaturan Hak Akses</a>
                        <a href="<?= base_url() ."admin/instansi" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/pengaturan/hakakses.png" ?>" alt="" class='img img-circle'><br>Instansi</a>
                        <a href="<?= base_url() ."welcome/logout" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/pengaturan/logout.png" ?>" alt="" class='img img-circle'><br>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(!empty($content)) echo $content; ?>
    <footer>
        <div class="ftl">&copy; Copyrights 2021 <a href="#" target="_blank">Team IT <?= TITLE ?></a></div>
    </footer>
    
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
<?php if (!empty($ajaxdata)) echo $ajaxdata; ?>
</script>
</body>
</html>
