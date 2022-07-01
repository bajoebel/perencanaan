<style type="text/css">
    .namadokter{
        position:relative; z-index:1020;top:-70px;color:#eee7e7;font-weight:bold;background:#33990073;height:70px
    }
</style>
<section>
    <div id="wowslider-container1">
        <div class="ws_images">
            <ul>
                <?php 
                $i=0;
                foreach ($slider as $s ) {
                    ?>
                    <li><a href="#"><img src="<?= base_url() ."public/img/slider/original/".$s->slider_img ?>" alt="<?= $s->slider_caption?>" title="<?= $s->slider_caption?>" id="wows1_<?= $i?>"/></a></li>
                    <?php
                    $i++;
                }
                ?>
                
            </ul>
        </div>
        <div class="ws_shadow"></div>
    </div>
</section>
<section class="blog">
    <div class="container">
        <div class='section-judul text-white'> Sekapur Sirih </div>
        <div class="row text-white text-center"><h2>
            <?php 
                echo $profile->sekilas
            ?></h2>
        </div>
    <div>
</section>

<section class="partner">
    <div class="container">
        <?php 
        foreach ($kategori as $k ) {
            $art=$this->Welcome_model->getPostByKategori($k->kategori_id);
            // $tgl=explode(' ',$b->post_tanggal);
            // $exp=explode('-',$tgl[0]);
            ?>
            <div class='section-judul'> <?= $k->kategori_nama ?> </div>
                <div class="row">
                <?php 
                $i=0;
                foreach ($art as $b ) {
                    $tag=array('tag-teal','tag-purple','tag-pink','tag-teal');
                    $tanggal=explode(' ',$b->post_tanggal);
                    $tgl=explode('-',$tanggal[0]);
                    ?>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <img src="<?= base_url() ."public/img/blog/thumb/THUMB_" .$b->post_image; ?>" alt="rover" />
                            </div>
                            <div class="card-body">
                                <span class="tag <?= $tag[$i] ?>"><?= $b->kategori_nama ?></span>
                                <h4><a href="<?= base_url() .$tgl[2]."/".$tgl[1]."/".$tgl[0]."/" .$b->post_link ?>"><?= $b->post_judul ?></a></h4>
                                <p>
                                <?= substr(strip_tags($b->post_isi),0,250)?> <a href="<?= base_url() .$b->post_link ?>">Selanjutnya ...</a>
                                </p>
                                <div class="user">
                                    <div class="user-info">
                                        <h5><?= tglindo($b->post_tglpublish) ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                    if($i==5)$i=0;
                }
                ?>
                </div>
            <?php
        }
        ?>
        
    </div>
</section>