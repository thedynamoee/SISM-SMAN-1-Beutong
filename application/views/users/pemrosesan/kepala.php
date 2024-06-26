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
                <div class="panel panel-default">
                    <div class="panel-heading text-left">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; DAFTAR SURAT MASUK</b><br><?php echo $skl->sekolah; ?>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="users/control/" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span><b>&nbsp; HISTORY SURAT</b></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body" style="margin-top: -20px;">
                        <table class="table table-xs table-hover table-striped table-bordered datatable-basic">
                            <thead>
                                <tr class="bg-info">
                                    <th>No.<br>Agenda</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                    <th>Tgl. Diterima</th>
                                    <th>Instansi Pengirim</th>
                                    <th width="40%">Perihal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($kepala->result() as $baris) {
                                ?>
                                    <tr>
                                        <td><?php echo $baris->no_sm; ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($baris->dibaca == 3) { ?>
                                                <button class="btn btn-sm btn-success"><i class="icon-checkmark4"></i>&nbsp; <b>Disposisi</b></button>
                                            <?php } elseif ($baris->dibaca == 2) { ?>
                                                <button class="btn btn-sm btn-primary"><i class="icon-bell3"></i>&nbsp; <b>Diajukan</b></button>
                                            <?php } else { ?>
                                                <button class="btn btn-sm btn-warning"><i class="icon-spinner"></i>&nbsp; <b>Menunggu</b></button>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="users/kepala/d/<?php echo $baris->id_sm; ?>" class="btn btn-info btn-sm"><i class="icon-eye"></i>&nbsp;&nbsp;<span class="small text-white">&nbsp;<b>DETAIL</b></span></a>
                                        </td>
                                        <td><?php echo $baris->tgl_sm; ?></td>
                                        <td><?php echo $baris->pengirim; ?></td>
                                        <td><?php echo $baris->perihal; ?></td>
                                    </tr>
                                <?php
                                    $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /basic datatable -->
            </div>
        </div>
        <!-- /dashboard content -->