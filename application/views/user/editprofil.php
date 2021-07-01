 

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                    <!-- Conten -->

                    <div class="row">
                        <div class="col-lg-8">
                        <?= form_open_multipart('user/editprofil'); ?>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Email" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                                    </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama" value="<?= $user['nama'] ?>">
                                        <?= form_error('nama', '<small class="text-danger">','</small>'); ?>
                                    </div>
                            </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        Foto
                                    </div>

                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <img src="<?= base_url('assets/img/profil/').$user['foto'] ?>"  class="img-thumbnail">
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="foto" name="foto" aria-describedby="inputGroupFileAddon01">
                                                    <small class="text-danger">*</small><small>Ukuran Max : 2mb</small>
                                                    <label class="custom-file-label" name="foto" for="foto">Pilih file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>

                            </form>

                            </div>
                        </div>
                    </div>

                    <!-- akhir Conten -->
                </div>
                <!-- /.container-fluid -->

            
            <!-- End of Main Content -->