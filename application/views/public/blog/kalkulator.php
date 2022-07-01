    <div class="judul">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h3 class="h-bold">Kalkulator Zakat</h3>
							
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>	
	</div>
	<div class="isi">
        <form class="form-horizontal" action="#">
            <div class="form-group">
                <label class="control-label col-sm-3" for="email">Jenis Zakat:</label>
                <div class="col-sm-9">
                <select name="jeniszakat" id="jeniszakat" class="form-control" onchange="bentukHarta()">
                    <option value="">Pilih Jenis Zakat</option>
                    <?php 
                    foreach ($jenis as $j ) {
                        ?>
                        <option value="<?= $j->idx ?>"><?= $j->jenis_zakat ?></option>
                        <?php
                    }
                    ?>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Bentuk Harta:</label>
                <div class="col-sm-9">
                <select name="jenisharta" id="jenisharta" class="form-control" onchange="SetBentukHarta()">
                    <option value="">Pilih Bentuk Harta</option>
                    <option value="0">Uang Tunai</option>
                </select>
                <input type="hidden" name="nisab" id="nisab">
                <input type="hidden" name="persentase" id="persentase">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="pwd" id="labelperkiraan">Perkiraan Harga (<span id="satuan">Rupiah</span>):</label>
                <div class="col-sm-9">
                
                <input type="text" class="form-control" name="perkiraan" id="perkiraan" readonly>
                </div>
            </div>
            <fieldset>
            <div id="penambah"></div>
            <div id="pengurang"></div>
            <input type="hidden" name="jmlpenambah" id="jmlpenambah">
            <input type="hidden" name="jmlpengurang" id="jmlpengurang">
            </fieldset>
            <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">&nbsp;</label>
                <div class="col-sm-9">
                <div id="hasil"></div>
                
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                <button type="button" class="btn btn-success" onclick="hitung()">Hitung</button>
                </div>
            </div>
        </form> 
	</div>