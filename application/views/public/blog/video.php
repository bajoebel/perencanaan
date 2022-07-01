<?php if(!empty($media)) { ?>
	<div class="judul">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h4 class="h-bold">
						video
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
                    <div class="col-md-12" style="text-align: center;">
                        <?=  $med->video_embed; ?>
                        <a href="#" onclick="openVideo('<?php echo $med->idx ?>')">
                            <br>
                            <h3><?php echo $med->video_judul; ?></h3>
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


