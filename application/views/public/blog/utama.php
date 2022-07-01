<section class="">
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