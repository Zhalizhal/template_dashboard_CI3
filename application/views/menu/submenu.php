                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


                    <div class="row">
                        <div class="col-lg-12">
                        <?php if(validation_errors()): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 <?= validation_errors('<i class="fas fa-exclamation-triangle"></i> <strong>ERROR!, </strong>Form '); ?>
                            </div>
                            <?php endif; ?>
                   

                    <?= $this->session->flashdata('message'); ?>

                         <a class="btn btn-primary mb-3" href="#" data-toggle="modal" data-target="#modalTambahData">
                         Tambah Sub Menu Baru
                         </a>
                           <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Sub Menu</th>
                                        <th scope="col">Menu ID</th>
                                        <th scope="col">URL</th>
                                        <th scope="col">icon</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 1;
                                    foreach($subMenu as $sm): ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><sup class="text-info">id.<?= $sm['id']; ?> </sup><?= $sm['title']; ?></td>
                                        <td><sup class="text-info">id.<?= $sm['menu_id']; ?> </sup><?= $sm['menu']; ?></td>
                                        <td><?= $sm['url']; ?></td>
                                        <td><?= $sm['icon']; ?></td>
                                        <td><?= $sm['is_active']; ?></td>
                                        <td>
                                            <a class="badge badge-success" href="<?= base_url($sm['id']) ?>" data-toggle="modal" data-target="#modalEditData<?= $sm['id'] ?>">Edit</a>
                                            <a class="badge badge-danger" href="<?= base_url($sm['id']) ?>" data-toggle="modal" data-target="#modalHapusData">Hapus</a>
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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="<?= base_url('menu/submenu') ?>" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Nama sub menu" name="title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilih Menu Id</label>
                                <select name="menu_id" id="menu_id" class="form-control">
                                    <option value="">Pilih Menu</option>
                                    <?php foreach ($menu as $m) : ?>
                                        <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <div class="mb-3">
                                <label class="form-label">Url</label>
                                <input type="text" class="form-control" id="url" placeholder="Url" name="url">
                                <sup class="text-danger">*</sup>
                                <small>Jika belum ada file untuk url sub menunya, maka defaultnya ke Menu Management, isi URL dengan "menu/submenu"</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Icon</label>
                                <input type="text" class="form-control" id="icon" placeholder="Nama icon" name="icon">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Menu Aktif?
                                    </label>
                                    </div>
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
             <?php foreach ($subMenu as $sm) : ?>
        <div class="modal fade" id="modalEditData<?= $sm['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="<?= base_url('menu/editSubmenu') ?>" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="id" placeholder="Nama sub menu" name="id" value="<?= $sm['id'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Nama sub menu" name="title" value="<?= $sm['title'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Menu Id</label>
                                <select name="menu_id" id="menu_id" class="form-control">
                                    <option value="<?= $sm['menu_id'] ?>"><?= $sm['menu'] ?></option>
                                    <?php foreach ($menu as $m) : ?>
                                        <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <div class="mb-3">
                                <label class="form-label">Url</label>
                                <input type="text" class="form-control" id="url" placeholder="Url" name="url" value="<?= $sm['url'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Icon</label>
                                <input type="text" class="form-control" id="icon" placeholder="Nama icon" name="icon" value="<?= $sm['icon'] ?>">
                                <small>Nama icon cek di : <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2&m=free">fontawesome.com</a></small>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Menu Aktif?
                                    </label>
                                    </div>
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
                            <a href="<?= base_url() ?>menu/hapusSubmenu/<?= $sm['id']; ?>" class="btn btn-primary">Yakin</a>
                        </div>
                    </div>
                </div>
            </div>

         

