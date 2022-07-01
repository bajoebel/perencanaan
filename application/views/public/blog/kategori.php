<?php if(!empty($kategori)) { ?>
	<div class="judul">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h4 class="h-bold">
						<?php 
						echo $kategori->kategori_nama;
						?>
						</h4>
							
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>	
	</div>
	<div class="isi">
    <?php 
                $i=0;
                foreach ($post as $b ) {
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
<?php } else{ ?>
	<div class="judul">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h4 class="h-bold">
							<h1>404</h1>
						</h4>
						
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>
	</div>
	<div class="isi text-center">Maaf Kontent Tidak Tersedia</div>
<?php } ?>