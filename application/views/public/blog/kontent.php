<section id="partner" class="page-section <?php if(empty($slider)) echo "paddingtop-100"; ?>">	
	
	<div class="container">
		<div class="row">
			
			<div class="col-md-8">
				<div id="content">
					<?php if(!empty($isi)) echo $isi ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<form>
					  <div class="input-group">
					    <input type="text" class="form-control input-sm" id="q" placeholder="Search">
					    <div class="input-group-btn">
					      <button class="btn btn-success" type="button" onclick="cari()">
					        <i class="fa fa-search"></i>
					      </button>
					    </div>
					  </div>
					</form> 
				</div>
				
				<div class="sidebar" style="margin-top: 20px;border:solid 1px #ccc;border-collapse:collapse;">
					<div class="sidebar-title" style="text-align: center;"><b>Artikel Terkait</b></div>
					<div class="sidebar-content">
						<?php 
						foreach ($terkait as $t ) {
							?>
							<div class="row-list">
								<div class="row">
									<div class="col-md-4" style="padding:0px;">
										<img src="<?= base_url() ."public/img/blog/thumb/THUMB_".$t->post_image; ?>" alt="" class="img img-responsive">
									</div>
									<div class="col-md-8">
										<a href="<?= base_url() .$t->post_link; ?>" class='linkjudul'><?= $t->post_judul ?></a>
									</div>
								</div>
								<div class="row"></div>
							</div>
							<?php
						}
						?>
					</div>
					<div class="sidebar-footer"></div>
				</div>

				<div class="sidebar" style="margin-top: 20px;border:solid 1px #ccc;border-collapse:collapse;">
					<div class="sidebar-title" style="text-align: center;"><b>Artikel Terbaru</b></div>
					<div class="sidebar-content">
					<?php 
						foreach ($terbaru as $t ) {
							?>
							<div class="row-list">
								<div class="row">
									<div class="col-md-4" style="padding:0px;">
										<img src="<?= base_url() ."public/img/blog/thumb/THUMB_".$t->post_image; ?>" alt="" class="img img-responsive">
									</div>
									<div class="col-md-8">
										<a href="<?= base_url() .$t->post_link; ?>" class='linkjudul'><?= $t->post_judul ?></a>
									</div>
								</div>
								<div class="row"></div>
							</div>
							<?php
						}
						?>
					</div>
					<div class="sidebar-footer"></div>
				</div>
				<?php 
				// $banner=$this->Welcome_model->getBanner();
				// foreach ($banner as $b) {
					?>
				 	<!-- <a href="<?php echo $b->banner_link; ?>" class="btn btn-default btn-lg btn-block" target="_blank"><img src="<?php echo base_url() ."public/img/logo/" .$b->banner_img; ?>" class="img img-responsive"> </a> -->
				 	<?php
				// }
				?>
				
			</div>
			
			<div class="row">&nbsp;-<div class="col-md-12"></div></div>
			
		</div>
    </div>
</section>	
<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url() ."js/app/blog.js"; ?>"></script>
