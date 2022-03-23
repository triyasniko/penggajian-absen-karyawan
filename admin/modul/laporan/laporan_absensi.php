<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center">
            <h3>Laporan Absensi Karyawan</h3>
        </div>
        <div class="card-body">
            <form action="modul/laporan/cetak_absensi.php?absen=<?= $_GET['absen']; ?>" method="post" enctype="multipart/form-data" target="_blank">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal Awal</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="tgl_1" name="tgl_1" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="tgl_2" name="tgl_2" required>
                        </div>
                    </div>
                    <p style="color: red;">* Silahkan pilih tanggal untuk cetak periode</p>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info" name="btnCetakHadir" target="_blank" aria-expanded="false"><i class="fas fa-print"></i>
                        Hadir
                    </button>
                    <button type="submit" class="btn btn-warning" name="btnCetakTidakHadir" target="_blank" aria-expanded="false"><i class="fas fa-print"></i>
                        Tidak Hadir
                    </button>


                </div>

            </form>
        </div>
    </div>
</div>