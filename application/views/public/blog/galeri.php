<?php if(!empty($media)) { ?>
	<div class="judul">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h4 class="h-bold">
						Galery
						</h4>
							
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>	
	</div>
	<div class="isi">
		
		<div id="media">
			<div class="row">
			<?php 
			foreach ($media as $med) {
                ?>
                    <div class="col-md-4" style="text-align: center;">
                        <a href="#" onclick="openDir('<?php echo $med->dir_id ?>')">
                            <img src="<?php echo base_url() ."media/".$med->dir_nama."/" .$med->media_namafile ?>" class="img img-responsive">
                            <?php echo $med->media_keterangan; ?>
                        </a>
                        
                    </div>
                    <?php
            }
			?>

			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><div class="col-md-12"><div id="halaman"></div></div></div>
		</div>
	</div>
<?php } else{ ?>
    <div class="judul">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h4 class="h-bold">
						404
						</h4>
							
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>	
	</div>
	<div class="isi">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h4 class="h-bold">
							<h1>Maaf Kontent Tidak Tersedia</h1>
						</h4>
						
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>
	</div>
<?php } ?>


