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
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($user as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td class="text-center"><?= $value['password'] ?></td>
                            <td class="text-center"><?php
                                if ($value['level'] == 1) { ?>
                                    <span class="badge bg-success">Admin</span>
                              <?php  } else { ?>
                                    <span class="badge bg-primary">Kasir</span>
                              <?php  } ?>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm " data-toggle="modal" data-target="#edit-data<?= $value['id_user'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-sm " data-toggle="modal" data-target="#hapus-data<?= $value['id_user'] ?>"><i class="fas fa-trash"></i></button>

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
            <?php echo  form_open('User/TambahData') ?>
            <div class="modal-body">

                <div class="form-grup">
                    <label for="">Nama User</label>
                    <input name="nama" class="form-control" placeholder="Nama User" required>
                </div>

                <div class="form-grup">
                    <label for="">Email</label>
                    <input name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="form-grup">
                    <label for="">Password</label>
                    <input name="password" class="form-control" placeholder="Password" required>
                </div>


                <div class="form-grup">
                    <label for="">Level</label>
                    <select name="level" class="form-control">
                        <option value="1">Admin</option>
                        <option value="2" selected>Kasir</option>
                    </select>
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
<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="edit-data<?= $value['id_user'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo  form_open('User/EditData/' . $value['id_user']) ?>
                <div class="modal-body">

                <div class="form-grup">
                    <label for="">Nama User</label>
                    <input name="nama"  value="<?= $value['nama'] ?>" class="form-control" placeholder="Nama User" required>
                </div>

                <div class="form-grup">
                    <label for="">Email</label>
                    <input name="email" value="<?= $value['email'] ?>" class="form-control" placeholder="Email" required>
                </div>

                <div class="form-grup">
                    <label for="">Password</label>
                    <input name="password" value="<?= $value['password'] ?>" class="form-control" placeholder="Password" readonly>
                </div>


                <div class="form-grup">
                    <label for="">Level</label>
                    <select name="level" class="form-control">
                        <option value="1" <?= $value['level'] == 1 ? 'Selected' : ''?>>Admin</option>
                        <option value="2" <?= $value['level'] == 2 ? 'Selected' : ''?>>Kasir</option>
                    </select>
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
<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="hapus-data<?= $value['id_user'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data <?= $subjudul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <p>Apkah Anda yakin ingin menghapus <?= $value['nama'] ?></p>

                </div>
                <div class="modal-footer justify-content-between">
                    <a href="<?= base_url('User/HapusData/' . $value['id_user']) ?>" class="btn btn-danger ">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>