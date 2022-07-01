<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Blog</a></li>
                <li class="active">Tamu</li>
            </ol>
            <div class="row">
                <!-- <div class="tombol" id="tombol">
                    <a href="#" onclick="add()" class="btn">
                    <span class="fa fa-plus"></span>
                    </a>
                </div> -->
                <div class='col-md-4' id="form_box" style="display:none">
                    <div class="form-box">
                        <div class="form-header">
                            Form tamu
                        </div>
                        <div class="form-body">
                            <form action="#" class="form-horizontal" id="form" method="POST">
                            <input type="hidden" id="idx" name="idx" >
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td id="tamu_tgl"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td id="tamu_nama"></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td id="tamu_email"></td>
                                        </tr>
                                        <tr>
                                            <td>Telp</td>
                                            <td id="tamu_telp"></td>
                                        </tr>
                                        <tr>
                                            <td>Komentar</td>
                                            <td id="tamu_komentar"></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td><input type="checkbox" name="tamu_status" value="1" id="tamu_status"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                
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
                                            <th>Tgl</th>
                                            <th>Nama</th>
                                            <th>Telp</th>
                                            <th>Email</th>
                                            <th>Komentar</th>
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

