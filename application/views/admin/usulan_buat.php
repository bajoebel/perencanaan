

<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Buat Usulan</a></li>
                <li><a href="#"><?= $periode->tahun_anggaran ?></a></li>
            </ol>
            <div class="row">
                <div class="col-md-4" >
                    <div style="border:solid 1 #ccc; border-collapse:collapse;">
                    <?php 
                    foreach ($jenis as $j) {
                        ?>
                        <h4><a href="#" onclick="openDir('<?= $j->kode ?>')"><span class="fa fa-folder"></span><?= $j->jenis_usulan ?></a></h4>
                        <div id="dir<?= $j->kode ?>" style="padding-left:15px"></div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-8"></div>
            </div>
        </div>
    </div>

    
</div>
