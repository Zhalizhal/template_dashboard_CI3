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
                         Tambah Baru
                         </a>
                           <table class="table table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 1;
                                    foreach($menu as $m): ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><sup class="text-info">id.<?= $m['id']; ?></sup> <?= $m['menu']; ?></td>
                                        <td>
                                            <a class="badge badge-success" href="<?= base_url($m['id']) ?>" data-toggle="modal" data-target="#modalEditData<?= $m['id'] ?>">Edit</a>
                                            <a class="badge badge-danger" href="<?= base_url($m['id']) ?>" data-toggle="modal" data-target="#modalHapusData">Hapus</a>
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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Sub Menu</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="<?= base_url('menu') ?>" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Menu</label>
                                <input type="text" class="form-control" id="menu" placeholder="menu" name="menu">
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
             <?php foreach ($menu as $m) : ?>
        <div class="modal fade" id="modalEditData<?= $m['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="<?= base_url('menu/editmenu') ?>" method="post">
                        <div class="modal-body">
                        <div class="mb-3">
                                <input type="text" hidden class="form-control" id="id" placeholder="menu" name="id" value="<?= $m['id']; ?>">                           
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Menu</label>
                                <input type="text" class="form-control" id="menu" placeholder="menu" name="menu" value="<?= $m['menu']; ?>">                           
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
                               Yakin ingin hapus data ini!
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <a href="<?= base_url() ?>menu/hapusmenu/<?= $m['id']; ?>" class="btn btn-primary">Yakin</a>
                        </div>
                    </div>
                </div>
            </div>

         

