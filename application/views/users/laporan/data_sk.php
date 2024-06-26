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
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; DAFTAR SURAT KELUAR</b><br>Arsip Surat Digital
              </div>
              <div class="col-md-6 text-right">
                <?php
                if ($user->row()->level == 'admin') { ?>
                  <form action="" method="post" target="_blank">
                    <button type="submit" name="btncetak" class="btn btn-xs btn-success" style="margin-top: 7px;"><span class="glyphicon glyphicon-random" aria-hidden="true"></span><b>&nbsp; CETAK LAPORAN</b></button>
                  </form>
                <?php
                } ?>
              </div>
            </div>
          </div>
          <div class="panel-body" style="margin-top: -20px;">

            <table class="table table-xs table-hover table-striped table-bordered datatable-basic">
              <thead>
                <tr>
                  <th>No. Urut</th>
                  <th>Tanggal Surat</th>
                  <th>Tujuan/ Penerima</th>
                  <th>Perihal</th>
                  <th>Kode Klasifikasi</th>
                  <th>pelaksana</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($sql->result() as $baris) {
                ?>
                  <tr>
                    <td><?php echo $baris->id_surat; ?></td>
                    <td><?php echo $baris->tgl_sk; ?></td>
                    <td><?php echo $baris->tujuan; ?></td>
                    <td><?php echo $baris->perihal; ?></td>
                    <td><?php echo $baris->kode; ?></td>
                    <td><?php echo $baris->pelaksana; ?></td>
                  </tr>
                <?php
                  $no++;
                } ?>
              </tbody>
            </table>
          </div>
          <!-- /basic datatable -->
        </div>
      </div>
    </div>
    <!-- /dashboard content -->