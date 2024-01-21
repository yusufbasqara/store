<?php hakAkses(['admin']); $now = date('Y-m-d'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Beranda </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="float-left">Barang Masuk Hari Ini</h4>
            <a href="<?=base_url();?>process/cetak_barang_masuk_today.php" target="_blank"
                class="btn btn-info btn-icon-split btn-sm float-right">
                <span class="icon text-white-50">
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Cetak</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20">NO</th>
                            <th>TANGGAL</th>
                            <th>NAMA BARANG</th>
                            <th>PENULIS</th>
                            <th>KATEGORI</th>
							<th>HARGA BELI</th>
                            <th>HARGA JUAL</th>
                            <th>JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $n=1;
                        $query = mysqli_query($con,"SELECT x.*,x1.nama_barang,x2.nama_penulis,x3.nama_kategori FROM barang_masuk x JOIN barang x1 ON x1.idbarang=x.barang_id JOIN penulis x2 ON x2.idpenulis=x1.penulis_id JOIN kategori x3 ON x3.idkategori=x1.kategori_id WHERE x.tanggal='$now' ORDER BY x.idbarang_masuk DESC")or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($query)):
                        ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['nama_penulis']; ?></td>
                            <td><?= $row['nama_kategori']; ?></td>
							<td><?= $row['hargabeli']; ?></td>
                            <td><?= $row['hargajual']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="float-left">Barang Keluar Hari Ini</h4>
            <a href="<?=base_url();?>process/cetak_barang_keluar_today.php" target="_blank"
                class="btn btn-info btn-icon-split btn-sm float-right">
                <span class="icon text-white-50">
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Cetak</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20">NO</th>
                            <th>TANGGAL</th>
                            <th>NAMA BARANG</th>
                            <th>PENULIS</th>
                            <th>KATEGORI</th>
							<th>HARGA BELI</th>
                            <th>HARGA JUAL</th>
                            <th>JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $n=1;
                        $query = mysqli_query($con,"SELECT x.*,x1.nama_barang,x2.nama_penulis,x3.nama_kategori FROM barang_keluar x JOIN barang x1 ON x1.idbarang=x.barang_id JOIN penulis x2 ON x2.idpenulis=x1.penulis_id JOIN kategori x3 ON x3.idkategori=x1.kategori_id WHERE x.tanggal='$now' ORDER BY x.idbarang_keluar DESC")or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($query)):
                        ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['nama_penulis']; ?></td>
                            <td><?= $row['nama_kategori']; ?></td>
							<td><?= $row['hargabeli']; ?></td>
                            <td><?= $row['hargajual']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Calculate Laba Rugi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="float-left">Laba Rugi Hari Ini</h4>
			   <a href="<?=base_url();?>process/cetak_laba_rugi_today.php" target="_blank"
                class="btn btn-info btn-icon-split btn-sm float-right">
                <span class="icon text-white-50">
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Cetak</span>
            </a>
        </div>
        <div class="card-body">
            <?php 
            // Query to calculate total income (Barang Masuk)
            $query_masuk = mysqli_query($con, "SELECT SUM(hargabeli * jumlah) AS total_masuk FROM barang_masuk WHERE tanggal='$now'") or die(mysqli_error($con));
            $result_masuk = mysqli_fetch_assoc($query_masuk);
            $total_masuk = $result_masuk['total_masuk'];

            // Query to calculate total expenses (Barang Keluar)
            $query_keluar = mysqli_query($con, "SELECT SUM(hargajual * jumlah) AS total_keluar FROM barang_keluar WHERE tanggal='$now'") or die(mysqli_error($con));
            $result_keluar = mysqli_fetch_assoc($query_keluar);
            $total_keluar = $result_keluar['total_keluar'];

            // Calculate Laba Rugi
            $laba_rugi = $total_masuk - $total_keluar;
            ?>
            <p>Total Pendapatan (Barang Masuk): <?= number_format($total_masuk, 0, ',', '.'); ?></p>
            <p>Total Pengeluaran (Barang Keluar): <?= number_format($total_keluar, 0, ',', '.'); ?></p>
            <h5>Laba Rugi: <?= number_format($laba_rugi, 0, ',', '.'); ?></h5>
        </div>
    </div>

<!-- /.container-fluid -->