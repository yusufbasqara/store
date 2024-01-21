<?php hakAkses(['admin']); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Barang Keluar</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#barang_keluar">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
            <a href="<?=base_url();?>process/cetak_barang_keluar.php" target="_blank"
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
                            <th>Penulis</th>
                            <th>KATEGORI</th>
							<th>HARGA BELI</th>
                            <th>HARGA JUAL</th>
                            <th>JUMLAH</th>
							<th width="50">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $n=1;
                        $query = mysqli_query($con,"SELECT x.*,x1.nama_barang,x2.nama_penulis,x3.nama_kategori FROM barang_keluar x JOIN barang x1 ON x1.idbarang=x.barang_id JOIN penulis x2 ON x2.idpenulis=x1.penulis_id JOIN kategori x3 ON x3.idkategori=x1.kategori_id ORDER BY x.idbarang_keluar DESC")or die(mysqli_error($con));
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
							 <td>
                                <a href="<?=base_url();?>/process/barang_keluar.php?act=<?=encrypt('delete');?>&id=<?=encrypt($row['idbarang_keluar']);?>"
                                    class="btn btn-sm btn-circle btn-danger btn-hapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Tambah barang -->
<div class="modal fade" id="barang_keluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?=base_url();?>process/barang_keluar.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Keluar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="tanggal">Tanggal<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    value="<?=date('Y-m-d');?>" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="barang_id">Nama Barang <span class="text-danger">*</span></label>
                                <select name="barang_id" id="barang_id" class="form-control select2" style="width:100%;"
                                    required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?= list_barang(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="jumlah">Jumlah<span class="text-danger">*</span></label>
                                <input type="text" class="form-control uang" id="jumlah" name="jumlah" required>
                            </div>
						</div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="hargabeli">Harga Beli <span class="text-danger">*</span></label>
                                <textarea name="hargabeli" id="hargabeli" cols="30" rows="5" class="form-control"
                                    required></textarea>
                            </div>	
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="hargajual">Harga Jual <span class="text-danger">*</span></label>
                                <textarea name="hargajual" id="hargajual" cols="30" rows="5" class="form-control"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="sidebar-divider">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i>
                        Batal</button>
                    <button class="btn btn-primary float-right" type="submit" name="tambah"><i class="fas fa-save"></i>
                        Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>