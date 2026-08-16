 <div class="container">

     <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
         <div class="card-body p-0">
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg">
                     <div class="p-5">
                         <div class="text-center">
                             <h1 class="h4 text-gray-900 mb-4">Buat Akun</h1>
                         </div>

                         <?php if ($this->session->flashdata('message')) : ?>
                             <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
                         <?php endif; ?>

                         <form class="user" method="post" action="<?= base_url('auth/register') ?>">
                             <div class="form-group">
                                 <input type="text" class="form-control form-control-user" id="fullname" name="fullname" value="<?= set_value('fullname'); ?>" placeholder="Nama Lengkap">
                             </div>
                             <small class="text-danger"><?= form_error('fullname'); ?></small>

                             <div class="form-group">
                                 <input type="text" class="form-control form-control-user" id="alamat" name="alamat" value="<?= set_value('alamat'); ?>" placeholder="Alamat">
                             </div>
                             <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>

                             <div class="form-group">
                                 <input type="text" class="form-control form-control-user" id="kontak" name="kontak" value="<?= set_value('kontak'); ?>" placeholder="Kontak yang bisa dihubungi">
                             </div>
                             <?= form_error('kontak', '<small class="text-danger">', '</small>'); ?>

                             <div class="form-group">
                                 <input type="text" class="form-control form-control-user" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Username">
                             </div>
                             <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                             <div class="form-group row">
                                 <div class="col-sm-6 mb-3 mb-sm-0">
                                     <input type="password" class="form-control form-control-user"
                                         id="password" name="password" placeholder="Password">
                                 </div>
                                 <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                 <div class="col-sm-6">
                                     <input type="password" class="form-control form-control-user"
                                         id="repeatPassword" name="repeatPassword" placeholder="Ulangi Password">
                                 </div>
                             </div>
                             <button type="submit" class="btn btn-primary btn-user btn-block">
                                 Registrasi Akun
                             </button>
                         </form>
                         <hr>
                         <div class="text-center">
                             <a class="small" href="<?= base_url('auth/forgot_password') ?>">Forgot Password?</a>
                         </div>
                         <div class="text-center">
                             <a class="small" href="<?= base_url('auth') ?>">Already have an account? Login!</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </div>