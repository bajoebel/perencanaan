    <div class="judul">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h3 class="h-bold">Mitra Baznas</h3>
							
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>	
	</div>
	<div class="isi ">
        <div class="row">
        <?php 
        $no=0;
        foreach ($partner as $p ) {
            $no++;
            ?>
            <div class="col-md-3">
                <a href="<?= $p->partner_link ?>" target="_blank">
                <img src="<?= base_url() ."public/img/partner/".$p->partner_logo ?>" alt="<?= $p->partner_nama ?>" class="img img-responsive">
                </a>
                
                <br><?= $p->partner_nama ?>
            </div>
            <?php
            if($no%4==0) echo "</div><hr><div class='row'>";
        }
        ?>
        </div>
		
	</div>