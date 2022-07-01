    <div class="judul">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h3 class="h-bold">Profile Baznas</h3>
							
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>	
	</div>
	<div class="isi">
		<fieldset>
			<legend>Tentang Baznas</legend>
			<?= $profile->tentang ?>
			<legend>Logo Baznas</legend>
			<img src="<?= base_url() ."files/profile/".$profile->logo; ?>" alt="" class="img img-responsive">
			<legend>Visi Baznas</legend>
			<?= $profile->visi ?>
			<legend>Misi Baznas</legend>
			<?= $profile->misi ?>
			<legend>Tujuan Baznas</legend>
			<?= $profile->tujuan ?>
			<legend>Sasaran</legend>
			<?= $profile->sasaran ?>
			<legend>Indikator Sasaran</legend>
			<?= $profile->indikator_sasaran ?>
		</fieldset>
	</div>