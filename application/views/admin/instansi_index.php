<script src="<?= base_url() ."js/tinymce.min.js"?>" referrerpolicy="origin"></script>
<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="<?= base_url()."home"?>"><span class="fa fa-home"></span></a></li>
                <li class="active">Instansi</li>
            </ol>
            <div class="row">
                <form action="<?= base_url() ."admin/instansi/simpan" ?>" method="POST" id="form" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <form action="<?= base_url() ."admin/instansi/simpan"?>" class="form-horizontal" id="form">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Data Instansi</a></li>
                                    <li><a href="#tab_6" data-toggle="tab">Tentang</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Visi</a></li>
                                    <li><a href="#tab_3" data-toggle="tab">Misi</a></li>
                                    <li><a href="#tab_4" data-toggle="tab">Tujuan</a></li>
                                    <li><a href="#tab_7" data-toggle="tab">Sasaran</a></li>
                                    <li><a href="#tab_8" data-toggle="tab">Indikator Sasaran</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <p>&nbsp;</p>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Nama Instansi:</label>
                                                    <div class="col-sm-10">
                                                        <input type="hidden" name="idx" id="idx" value="<?php if(!empty($instansi)) echo $instansi->idx ?>">
                                                        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" placeholder="instansi Konten" value="<?php if(!empty($instansi)) echo $instansi->nama_instansi ?>">
                                                    </div>
                                                </div>
                                                <div class="row">&nbsp;</div>
                                                <br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Alamat:</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="alamat" id="alamat" class="form-control full-featured-non-premium" cols="30" rows="3"><?php if(!empty($instansi)) echo $instansi->alamat ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">&nbsp;</div>
                                                <br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Sekilas:</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="sekilas" id="sekilas" class="form-control full-featured-non-premium" cols="30" rows="3"><?php if(!empty($instansi)) echo $instansi->sekilas ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">&nbsp;</div>
                                                <br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Moto:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="moto" id="moto" class="form-control full-featured-non-premium" value="<?php if(!empty($instansi)) echo $instansi->moto ?>">
                                                    </div>
                                                </div>
                                                <div class="row">&nbsp;</div>
                                                <br>
                                                
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">No Telp:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="notelp" name="notelp" placeholder="No Telp" value="<?php if(!empty($instansi)) echo $instansi->notelp ?>">
                                                    </div>
                                                </div>
                                                <div class="row">&nbsp;</div>
                                                <br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Fax:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="fax" name="fax" placeholder="Fax" value="<?php if(!empty($instansi)) echo $instansi->fax ?>">
                                                    </div>
                                                </div>
                                                <div class="row">&nbsp;</div>
                                                <br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php if(!empty($instansi)) echo $instansi->email ?>">
                                                    </div>
                                                </div>
                                                <div class="row">&nbsp;</div>
                                                <br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Facebook:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" value="<?php if(!empty($instansi)) echo $instansi->facebook ?>">
                                                    </div>
                                                </div>
                                                <div class="row">&nbsp;</div>
                                                <br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Twitter:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="twitter" name="twitter" placeholder="twitter" value="<?php if(!empty($instansi)) echo $instansi->twitter ?>">
                                                    </div>
                                                </div>
                                                <div class="row">&nbsp;</div>
                                                <br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Instagram:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="instagram" value="<?php if(!empty($instansi)) echo $instansi->instagram ?>">
                                                    </div>
                                                </div>
                                                <div class="row">&nbsp;</div>
                                                <br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Youtube:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="youtube" name="youtube" placeholder="youtube" value="<?php if(!empty($instansi)) echo $instansi->youtube ?>">
                                                    </div>
                                                </div>
                                                <div class="row">&nbsp;</div>
                                                
                                                <br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Logo:</label>
                                                    <div class="col-sm-10">
                                                        <div class="row">
                                                        <?php if(!empty($instansi)) {
                                                            ?>
                                                            <div class="col-md-2">
                                                            <img src="<?= base_url() .$instansi->logo?>" class='img img-responsive' alt="">   
                                                            </div><div class="col-md-10"></div>
                                                            
                                                            <?php
                                                            //echo $instansi->logo;
                                                        } ?>
                                                        </div>
                                                        <input type="hidden" id="logo" name='logo' value="<?php if(!empty($instansi)) echo $instansi->logo ?>">
                                                        <input type="file" class="form-control" id="logo" name="logo[]" placeholder="logo" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <textarea name="visi" id="visi" cols="30" rows="10" class="form-control editor"><?php if(!empty($instansi)) echo $instansi->visi ?></textarea>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                    <textarea name="misi" id="misi" cols="30" rows="10"  class="form-control editor"><?php if(!empty($instansi)) echo $instansi->misi ?></textarea>
                                    </div>
                                    <div class="tab-pane" id="tab_4">
                                    <textarea name="tujuan" id="tujuan" cols="30" rows="10" class="form-control editor"><?php if(!empty($instansi)) echo $instansi->tujuan ?></textarea>
                                    </div>
                                    
                                    <div class="tab-pane" id="tab_6">
                                    <textarea name="tentang" id="tentang" cols="30" rows="10" class="form-control editor"><?php if(!empty($instansi)) echo $instansi->tentang ?></textarea>
                                    </div>
                                    <div class="tab-pane" id="tab_7">
                                    <textarea name="sasaran" id="sasaran" cols="30" rows="10" class="form-control editor"><?php if(!empty($instansi)) echo $instansi->sasaran ?></textarea>
                                    </div>
                                    <div class="tab-pane" id="tab_8">
                                    <textarea name="indikator_sasaran" id="indikator_sasaran" cols="30" rows="10" class="form-control editor"><?php if(!empty($instansi)) echo $instansi->indikator_sasaran ?></textarea>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <br>
                                    <hr>
                                    <div class="row">
                                        <div class="col-offset-2 col-md-10">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div>
                        </form>
                        
                        
                    </div>  
                    
                </form>
                
            </div>
        </div>
    </div>
</div>
