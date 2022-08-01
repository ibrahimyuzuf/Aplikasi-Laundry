<!DOCTYPE html>
<html lang="en">
<?php
function buatrp($angka)
{
    $jadi = "Rp " . number_format($angka, 2, ',', '.');
    return $jadi;
}
function tgl($date)
{
    $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $tahun = substr($date, 0, 4);
    $bln = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $result = $tgl . " " . $bulan[(int) $bln - 1] . " " . $tahun;
    return ($result);
}
?>

<head>
    <?php $this->load->view('_partials/head.php'); ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('_partials/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('_partials/nav.php'); ?>
                <!-- End of Topbar -->
                <?php if ($this->session->flashdata('tolak')) : ?>
                    <script type="text/javascript">
                        swal({
                            title: "Terjadi Kesalahan",
                            text: "<?php echo $this->session->flashdata('tolak'); ?>",
                            icon: "error",
                            timer: 3000,
                        });
                    </script>
                <?php endif; ?>
                <?php if ($this->session->flashdata('success')) : ?>
                    <script type="text/javascript">
                        swal({
                            title: "Sukses",
                            text: "<?php echo $this->session->flashdata('success'); ?>",
                            icon: "success",
                            timer: 3000,
                        });
                    </script>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')) : ?>
                    <script type="text/javascript">
                        swal({
                            title: "Gagal",
                            text: "<?php echo $this->session->flashdata('error'); ?>",
                            icon: "error",
                            timer: 3000,
                        });
                    </script>
                <?php endif; ?>
                
                <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Ubah Member Laundry</h6>
                                </div>
                                <div class="card-body">
                                    <?php foreach($cari as $data): ?>
                                    <form action="<?= base_url('member/subah'); ?>" method="POST">
                                    <input type="hidden" name="kode" value="<?= $data->id_member; ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Member</label>
                                            <input type="text" name="nama" class="form-control" value="<?= $data->nama_member; ?>">
                                        </div>
                                        <div class="col-mb-3">
                                        <label for="form-label">Jenis Kelamin</label>
                                        <select name="kelamin" class="form-control">
                                            <option value="<?= $data->kelamin_member; ?>"><?= $data->kelamin_member; ?></option>
                                            <option value="">---Pilih---</option>
                                            <option value="Laki Laki">Laki Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Alamat Lengkap</label>
                                            <textarea name="alamat" class="form-control" cols="30" rows="10"><?= $data->alamat_member; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Handphone</label>
                                            <input type="text" name="hp" class="form-control" value="<?= $data->tlp_member; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Daftar</label>
                                            <input type="date" name="tanggal" class="form-control" value="<?=$data->tgl_daftar; ?>">
                                        </div>
                                        <?php endforeach; ?>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>

            </div>

         
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('_partials/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php $this->load->view('_partials/bottom.php'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable2').DataTable();
            $('#dataTable3').DataTable();
            $('#dataTable4').DataTable();
        });
    </script>
</body>

</html>