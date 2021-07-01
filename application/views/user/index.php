 

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

                    <div class="col-sm-8">
                     <?= $this->session->flashdata('message'); ?>
                    </div>

                    <div class="card mb-3 col-lg-8">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="<?= base_url('assets/img/profil/').$user['foto'] ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $user['nama'] ?></h5>
                                <p class="card-text"><?= $user['email'] ?></p>
                                <p class="card-text">Role : 
                                <?php
                                if($this->session->userdata('role_id') == 1){
                                    echo "<strong>Admin</strong>";
                                }else{
                                    echo "<strong>Member</strong>";

                                }
                                ?></p>
                                <p class="card-text"><small class="text-muted">Member sejak <?= date('d F Y', $user['date_created']) ?></small></p>
                            </div>
                            </div>
                        </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->