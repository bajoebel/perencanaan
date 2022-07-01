

<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Dashboard</a></li>
            </ol>
            <marquee behavior="" direction="">Selamat Datang Di halaman admin <?= TITLE ?></marquee>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori usulan</th>
                        <th>Tahun Anggaran</th>
                        <th>Deskripsi</th>
                        <th>Buka</th>
                        <th>Tutup</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=0;
                    foreach ($periode as $p) {
                        $no++;
                        ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $p->kategori_usulan ?></td>
                            <td><?= $p->tahun_anggaran ?></td>
                            <td><?= $p->deskripsi ?></td>
                            <td><?= $p->tglbuka ?></td>
                            <td><?= $p->tgltutup ?></td>
                            <td><a href="<?= base_url() ."admin/usulan/buat/".$p->kode_periode ?>" class="btn btn-default"><span class="fa fa-plus"></span> Buat Usulan</a></td>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
