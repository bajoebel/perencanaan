<section id="partner" class="home-section paddingbot-60">	
	<div class="container ">
		<div class="row">
		<div class="col-md-12 my_text">
				<div id="content">
					<div class="judul text-center">
						<h1 class="h-bold">
							Buku Tamu
						</h1>
					</div>
				</div>
				<div class="isi">
					<div class="row">
						<div class="col-md-12">
							<form role="form" class="lead" id="form" method="POST" action="#">
								<h3>Buku Tamu</h3>
								<hr>
								<div class="col-sm-12">
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12 col-sm-4 col-md-4">
												<label>Email</label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-8">
												<div class="form-group">
												<input type="text" name="tamu_email" id="tamu_email" class="form-control">
												
												</div>
												
												
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12 col-sm-4 col-md-4">
												<label>No telp</label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-8">
												<div class="form-group">
												<input type="text" name="tamu_telp" id="tamu_telp" class="form-control">
												
												</div>
												
												
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>Nama</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<input type="text" name="tamu_nama" id="tamu_nama" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>Isi Komentar</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<textarea class="form-control" name="tamu_komentar" id="tamu_komentar" row='5'></textarea>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<button class="btn btn-skin btn-lg" type="button" onclick="kirimPengaduan()">Simpan</button>
											</div>
										</div>
									</div>
								</div>
								
							</form>
						</div>
						
					</div>
					
				</div>
			</div>
			
		</div>
	</div>

	
</section>	
<script type="text/javascript">
	function kirimPengaduan(){
		var url;
        url = "<?php echo base_url() ."welcome/kirimpengaduan" ?>";
        
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: 'JSON',
            success: function(data)
            {
            	alert(data["message"]);
            	if(data["status"]==true){
            		location.reload(); 
            	}
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert(url);
                show_notif('Error','Error Saat Penyimpanan Data','danger');
            }
        });
        return true;
	}
</script>