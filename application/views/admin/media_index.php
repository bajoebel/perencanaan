<style>
    .custom-menu {
        display: none;
        z-index: 1000;
        position: absolute;
        overflow: hidden;
        border: 1px solid #CCC;
        white-space: nowrap;
        font-family: sans-serif;
        background: #FFF;
        color: #333;
        border-radius: 5px;
    }

    .custom-menu li {
        padding: 8px 12px;
        cursor: pointer;
    }

    .custom-menu li:hover {
        background-color: #DEF;
    }
</style>
<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Blog</a></li>
                <li class="active">Media</li>
            </ol>
            <div class="row">
                <div class="tombol" id="tombol">
                    <a href="#" class="btn"  onclick="create()">
                    <span class="fa fa-plus"></span> Buat Folder
                    </a>
                </div>
                <div class='col-md-4' id="form_box" style="display:none">
                    <div class="form-box">
                        <div class="form-header">
                            Form Update Direktori
                        </div>
                        <div class="form-body">
                            <form action="#" class="form-horizontal" id="formupdate" method="POST">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Direktori:</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" id="xdir_id" name="dir_id" >
                                        <input type="hidden" name="curent_dir" id="xcurent_dir" value="./media">
                                        <input type="hidden" name="old_dir" id="xold_dir" value="">
                                        <input type="text" class="form-control" id="xdir_nama" name="dir_nama" placeholder="EnterNama Kategori">
                                        <div class="text-error" id="err_dir_nama"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox"  id="dir_status" name="dir_status" value="1">Aktif <br>
                                        <input type="checkbox"  id="dir_galery" name="dir_galery" value="1">Galery <br>
                                        <input type="checkbox"  id="dir_download" name="dir_download" value="1">Download <br>
                                        <input type="checkbox"  id="dir_ppid" name="dir_ppid" value="1">PPID <br>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                    <button type="button" class="btn btn-danger" onclick="resetApp()">Batal</button>
                                    <button type="button" class="btn btn-success" onclick="updateDir()">Simpan</button>
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
                            <div class="col-md-1">
                                    <!-- <input type="file" name="files" id="files" class='btn btn-default'> -->
                                    <button class="btn btn-default btn-block" onclick="getData(1)" id="btnKembali"><span class="fa fa-arrow-left" ></span> Kembali</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="has-feedback">
                                        <input type="hidden" id="root" name="root" value="./media">
                                        <input type="hidden" name="start" id="start" value="1">
                                        <input type="hidden" name="limit" id="limit" value="36">
                                        <input type="hidden" name="filepath" id="filepath">
                                        <input type="text" class="form-control input-sm" id="q" name="q" onkeyup="getData(1)" placeholder="Keyword">
                                        <span class="glyphicon glyphicon-folder-open form-control-feedback"></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row top10">
                            <div class="col-md-12">
                            <div id="data"></div>
                            </div>
                            
                        </div>
                    </div>
                    <div id="pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="newfolder" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Folder</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="form" name="form" method="POST" enctype="multipart/form-data">
                    <div class="input-group"><input type="checkbox" name="dir_galery" id="dir_galery" value="1"> Publish Dihalaman Galery</div>
                    <div class="input-group"><input type="checkbox" name="dir_download" id="dir_download"  value="1"> Publish Dihalaman Download</div>
                    <div class="input-group"><input type="checkbox" name="dir_ppid" id="dir_pid"  value="1"> Publish Dihalaman PPID</div>
                    <div class="input-group">
                        <input type="hidden" name="curent_dir" id="curent_dir">
                        <input type="text" class="form-control" id="newfolder" name="newfolder" placeholder="Nama Folder">
                        <div class="input-group-btn">
                            <button class="btn btn-success" type="button" onclick="createFolder()">
                                <i class="glyphicon glyphicon-plus"></i> Create
                            </button>
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>
<div id="uploadfile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload File</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="form1" name="form1" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" name="media_dirid" id="media_dirid">
                    <input type="hidden" name="gelery" id="galery">
                    <input type="hidden" name="download" id="download">
                    <input type="hidden" name="ppid" id="ppid">
                    <div class="form-group">
                        <label for="Keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="media_keterangan" name="media_keterangan" placeholder="Keterangan">
                        
                    </div>
                    <div class="input-group">
                        <label for="">File</label>
                        <div class="input-group">
                            <input type="hidden" name="curent_dir1" id="curent_dir1">
                            <input type="file" class="form-control" id="userfile" name="userfile[]" placeholder="Nama Folder">
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="uploadFile()">
                                    <i class="glyphicon glyphicon-plus"></i> Upload
                                </button>
                            </div>
                        </div>
                    </div>
                    
                </form>
                
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>
<div id="priview" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Priview File</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="form2" name="form2" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" name="media_id" id="media_id">
                    <input type="hidden" name="media_dirid" id="pmedia_dirid">
                    <input type="hidden" name="gelery" id="galery">
                    <input type="hidden" name="download" id="download">
                    <input type="hidden" name="ppid" id="ppid">
                    <div class="form-group">
                        <label for="Keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="pmedia_keterangan" name="media_keterangan" placeholder="Keterangan">
                        
                    </div>
                    <div id="priview_images"></div>
                    <div class="form-group">
                        
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
            <button class="btn btn-warning" type="button" onclick="simpan()">Update</button>
                        <button class="btn btn-danger" type="button" onclick="hapusFile()">Hapus</button>
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>