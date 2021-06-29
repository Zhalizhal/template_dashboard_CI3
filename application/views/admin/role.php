                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

                    <div class="row">
                        <div class="col-lg-12">
                     <?php if(validation_errors()): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <?= validation_errors('<i class="fas fa-exclamation-triangle"></i><strong>ERROR!, </strong>Form '); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <?php endif; ?>

                    <?= $this->session->flashdata('message'); ?>

                         <a class="btn btn-primary mb-3" href="#" data-toggle="modal" data-target="#modalTambahData">
                         Tambah role Baru
                         </a>
                           <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 1;
                                    foreach($role as $r): ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><sup class="text-info">id.<?= $r['id']; ?></sup> <?= $r['role']; ?></td>
                                        <td>
                                            <a class="badge badge-info" href="<?= base_url('admin/roleaccess/') . $r['id'] ?>">Detail Akses</a>
                                            <a class="badge badge-success" href="<?= base_url($r['id']) ?>" data-toggle="modal" data-target="#modalEditData<?= $r['id'] ?>">Edit</a>
                                            <a class="badge badge-danger" href="<?= base_url($r['id']) ?>" data-toggle="modal" data-target="#modalHapusData">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </table>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Modal Tambah Data-->
        <div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Role</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="<?= base_url('admin/role') ?>" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" placeholder="Isi role" name="role">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

             <!-- Modal Edit Data-->
             <?php foreach ($role as $r) : ?>
        <div class="modal fade" id="modalEditData<?= $r['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="<?= base_url('admin/editrole') ?>" method="post">
                        <div class="modal-body">
                        <div class="mb-3">
                                <input type="text" hidden class="form-control" id="id" placeholder="id" name="id" value="<?= $r['id']; ?>">                           
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" placeholder="Isi role" name="role" value="<?= $r['role']; ?>">                           
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

             <!-- Modal Hapus Data-->
        <div class="modal fade" id="modalHapusData" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                               Yakin ingin hapus data "<?= $r['role'] ?>"! 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <a href="<?= base_url('admin/hapusrole/') ?><?= $r['id']; ?>" class="btn btn-primary">Yakin</a>
                        </div>
                    </div>
                </div>
        </div>
            

         

