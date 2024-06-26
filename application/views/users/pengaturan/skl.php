<!-- Main content -->
<div class="content-wrapper">
    <!-- Content area -->
    <div class="content">
        <?php
        echo $this->session->flashdata('msg');
        ?>
        <!-- Dashboard content -->
        <div class="row">
            <div class="col-md-12">
                <!-- Basic datatable -->
                <div class="panel panel-danger">
                    <div class="panel-heading text-left">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; PROFIL SEKOLAH</b><br><?php echo $skl->sekolah; ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <form class="form-horizontal" action="" method="post">
                                <div class="form-group">
                                    <label class="control-label col-lg-2 text-right">Nama Kepala Sekolah</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-user"></i></span>
                                            <input type="hidden" name="id" class="form-control" placeholder="Masukkan Nama Lengkap dan Gelar" value="<?php echo $skl->id; ?>">
                                            <input type="text" name="nm_kepala" class="form-control" placeholder="Masukkan Nama Lengkap dan Gelar" value="<?php echo $skl->nm_kepala; ?>">
                                        </div>
                                    </div>

                                    <label class="control-label col-lg-2 text-right">NIP</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-folder"></i></span>
                                            <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP" value="<?php echo $skl->nip; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2 text-right">Jabatan</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-list"></i></span>
                                            <input type="text" name="jabatan" class="form-control" placeholder="Masukkan Jabatan" value="<?php echo $skl->jabatan; ?>" required>
                                        </div>
                                    </div>
                                    <label class="control-label col-lg-2 text-right">Nama Sekolah</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-list"></i></span>
                                            <input type="text" name="sekolah" class="form-control" placeholder="Masukkan Nama Sekolah" value="<?php echo $skl->sekolah; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2 text-right">NPSN</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-list"></i></span>
                                            <input type="text" name="npsn" class="form-control" placeholder="Masukkan NPSN" value="<?php echo $skl->npsn; ?>" required>
                                        </div>
                                    </div>
                                    <label class="control-label col-lg-2 text-right">Tahun Pelajaran</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-list"></i></span>
                                            <input type="text" name="tapel" class="form-control" placeholder="Masukkan Tahun Pelajaran" value="<?php echo $skl->tapel; ?>" required>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="control-label col-lg-2 text-right">KOP PERTAMA</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-list"></i></span>
                                            <input type="text" name="kop_1" class="form-control" placeholder="Masukkan KOP Pertama" value="<?php echo $skl->kop_1; ?>" required>
                                        </div>
                                    </div>

                                    <label class="control-label col-lg-2 text-right">KOP KEDUA</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-list"></i></span>
                                            <input type="text" name="kop_2" class="form-control" placeholder="Masukkan KOP Kedua" value="<?php echo $skl->kop_2; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2 text-right">Telepon & Email</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-list"></i></span>
                                            <textarea name="telp" class="form-control" placeholder="Masukkan Telepon dan Email"><?php echo $skl->telp; ?></textarea>
                                        </div>
                                    </div>
                                    <label class="control-label col-lg-2 text-right">Alamat Sekolah</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-list"></i></span>
                                            <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat Lengkap"><?php echo $skl->alamat; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div style="float: right;">
                                    <a href="users/bagian" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;<b>KEMBALI</b></a>
                                    <button type="submit" name="btnupdate" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;<b>SIMPAN DATA</b></button>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
            <!-- /basic datatable -->
        </div>
        <!-- /dashboard content -->