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
                                    <h6 class="m-0 font-weight-bold text-primary">Data Produk Laundry</h6>
                                </div>
                                <div class="card-body">
                                <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Proses</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 
                                        $no = 1;
                                        foreach($produk as $data): 
                                        ?>
                                            <tr>
                                                <th><?= $no; ?></th>
                                                <td><?= $data->nama_produk; ?></td>
                                                <td><?= buatrp($data->harga_produk); ?></td>
                                                <td>
                                                    <a href="<?= base_url('produk/ubah/' . $data->id_produk); ?>" class="btn btn-info">Ubah</a>
                                                    <a href="<?= base_url('produk/hapus/' . $data->id_produk); ?>" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php $no++; endforeach; ?>
                                        </tbody>
                                        </table>
                                        <a href="<?= base_url('produk/tambah'); ?>" class="btn btn-primary">Tambah</a>
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