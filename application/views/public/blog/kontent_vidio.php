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
				
				
				<?php 
				// $banner=$this->Welcome_model->getBanner();
				foreach ($dir as $b) {
					?>
				 	<a href="<?= base_url() ."video?kat=".$b->idx;  ?>" class="btn btn-default btn-lg btn-block" ><span class="fa fa-folder-open "></span> <?= $b->kategori_video ?> </a>
				 	<?php
				}
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
