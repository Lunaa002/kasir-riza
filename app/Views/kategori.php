<div class="col-md-24">
    <div class="card card-primary ">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"> Tambah</i>
                    </btton>
            </div>

        </div>

        <div class="card-body">
            <?php
            if (session()->getFlashData('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashData('pesan');
                echo '</h5></div>';
            }
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Kategori</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kategori as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_kategori'] ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm " data-toggle="modal" data-target="#edit-data<?= $value['id_kategori'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-sm " data-toggle="modal" data-target="#hapus-data<?= $value['id_kategori'] ?>"><i class="fas fa-trash"></i></button>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</div>

<!--Modal Tambah -->
<div class="modal fade" id="tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data <?= $subjudul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo  form_open('Kategori/TambahData') ?>
            <div class="modal-body">

                <div class="form-grup">
                    <label for="">Nama Kategori</label>
                    <input name="nama_kategori" class="form-control" placeholder="Kategori" required>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary ">Simpan</button>
            </div>
            <?php echo  form_close() ?>
        </div>

    </div>

</div>

<!--Modal Edit -->
<?php foreach ($kategori as $key => $value) { ?>
    <!--Modal Edit -->
    <div class="modal fade" id="edit-data<?= $value['id_kategori'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo  form_open('Kategori/EditData/' . $value['id_kategori']) ?>
                <div class="modal-body">

                    <div class="form-grup">
                        <label for="">Nama Kategori</label>
                        <input name="nama_kategori" value="<?= $value['nama_kategori'] ?>" class="form-control" placeholder="Kategori" required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-warning ">Simpan</button>
                </div>
                <?php echo  form_close() ?>
            </div>

        </div>

    </div>
<?php } ?>

<!--Modal Hapus -->
<?php foreach ($kategori as $key => $value) { ?>
    <!--Modal Edit -->
    <div class="modal fade" id="hapus-data<?= $value['id_kategori'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data <?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <p>Apkah Anda yakin ingin menghapus <?= $value['nama_kategori'] ?></p>

                </div>
                <div class="modal-footer justify-content-between">
                    <a href="<?= base_url('Kategori/HapusData/' . $value['id_kategori']) ?>" class="btn btn-danger ">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>