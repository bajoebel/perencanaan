<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Blog</a></li>
                <li class="active">Video</li>
            </ol>
            <div class="row">
                <div class="tombol" id="tombol">
                    <a href="#" onclick="add()" class="btn">
                    <span class="fa fa-plus"></span>
                    </a>
                </div>
                <div class='col-md-4' id="form_box" style="display:none">
                    <div class="form-box">
                        <div class="form-header">
                            Form Video
                        </div>
                        <div class="form-body">
                            <form action="#" class="form-horizontal" id="form" method="POST">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Kategori:</label>
                                    <div class="col-sm-8">
                                        <!-- <?php print_r($kategori)?> -->
                                        <input type="hidden" id="idx" name="idx" >
                                        <select name="video_katid" id="video_katid" class="form-control">
                                            <?php 
                                            foreach ($kategori as $k ) {
                                                ?>
                                                <option value="<?= $k->idx?>"><?= $k->kategori_video?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="text-error" id="err_video_katid"></div>
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Embed Code:</label>
                                    <div class="col-sm-8">
                                        <textarea name="video_embed" id="video_embed" cols="30" rows="10" class="form-control"></textarea>
                                        <div class="text-error" id="err_video_embed"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd"></label>
                                    <div class="col-sm-8">
                                        <input type="input" value="" class="form-control" name="video_judul" id="video_judul">
                                        <div class="text-error" id="err_video_judul"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" value="1" name="video_publish" id="video_publish"> Aktif
                                        <div class="text-error" id="err_video_publish"></div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                    <button type="button" class="btn btn-danger" onclick="resetApp()">Batal</button>
                                    <button type="button" class="btn btn-success" onclick="simpan()">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="col-md-12" id="tabel_box">
                    <div class="tabel-box">
                        <div class="filter-box">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="has-feedback">
                                        <input type="hidden" id="start" name="start" value="1">
                                        <input type="text" class="form-control input-sm" id="q" name="q" onkeyup="getData(1)" placeholder="Keyword">
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <select name="limit" id="limit" class="form-control input-sm" onchange="getData(1)">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row top10">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Embed</th>
                                            <th>Judul</th>
                                            <th>Status</th>
                                            <th style="width:150px">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>

