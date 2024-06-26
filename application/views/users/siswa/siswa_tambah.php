<!-- Main content -->
<div class="content-wrapper">
    <!-- Content area -->
    <div class="content">
        <!-- Dashboard content -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-left">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b>&nbsp; TAMBAH SISWA</b><br>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <?php echo $this->session->flashdata('msg'); ?>
                            <div class="msg"></div>
                            <form class="form-horizontal" action="" method="post">
                                <div class="form-group">
                                    <label class="control-label col-lg-2 text-right">Nomor Induk Sekolah</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-home"></i></span>
                                            <input type="text" name="nis" id="nis" class="form-control" placeholder="Masukkan Nomor Induk Sekolah (NIS)" required>
                                        </div>
                                    </div>
                                    <label class="control-label col-lg-2 text-right">NISN</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-bookmark"></i></span>
                                            <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukkan Nomor Induk Sekolah Nasional (NISN)" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2 text-right"> Nama Lengkap</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-list"></i></span>
                                            <input type="text" name="nm_siswa" id="nm_siswa" required class="form-control" placeholder="Masukkan Nama Lengkap">
                                        </div>
                                    </div>
                                    <label class="control-label col-lg-2 text-right">Tempat, Tanggal Lahir</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-spinner"></i></span>
                                            <input type="text" name="ttl" id="ttl" class="form-control" placeholder="Contoh: Situbondo, 10 Januari 1991" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2 text-right"> Kelas</label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-list"></i></span>
                                            <select class="form-control" name="kelas" id="kelas" required>
                                                <option value="">Pilih Kelas</option>
                                                <option value="X">X</option>
                                                <option value="XI">XI</option>
                                                <option value="XII">XII</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-spinner"></i></span>
                                            <select class="form-control" name="jurusan" id="jurusan" required>
                                                <option value="">Pilih Jurusan</option>
                                                <option value="IPA 1">IPA 1</option>
                                                <option value="IPA 2">IPA 2</option>
                                                <option value="IPA 3">IPA 3</option>
                                                <option value="IPA 4">IPA 4</option>
                                                <option value="IPS 1">IPS 1</option>
                                                <option value="IPS 2">IPS 2</option>
                                                <option value="IPS 3">IPS 3</option>
                                                <option value="IPS 4">IPS 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <label class="control-label col-lg-2 text-right"> Nama Orang Tua</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-list"></i></span>
                                            <input type="text" name="nm_ort" id="nm_ort" required class="form-control" placeholder="Masukkan Nama Orang Tua">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label class="control-label col-lg-2 text-right">Alamat</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-spinner"></i></span>
                                            <textarea type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat Lengkap" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <a href="users/siswa" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;<b>KEMBALI</b></a>
                                <button type="submit" name="btnsimpan" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;<b>SIMPAN DATA</b></button>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <!-- /dashboard content -->