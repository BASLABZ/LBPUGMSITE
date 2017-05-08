<!-- modal pendaftaran member REGISTRASI -->
<div class="modal fade" id="modal_registrasi_member" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Registrasi</h4>
                </div>
                <div class="modal-body">
                    <div class="peminjaman-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>

<!-- modal pendaftaran member AKTIVASI AKUN -->
<div class="modal fade" id="modal_aktivasi_member" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Aktivasi Akun</h4>
                </div>
                <div class="modal-body">
                    <div class="peminjaman-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>

<!-- modal peminjamaman alat CARI ALAT -->
<div class="modal fade" id="modal_cari_alat" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Cari Alat</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data">
                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <center>
                                    <img src="img/cari-alat.JPG" class="dim_about img-responsive img-thumbnail" style="width: 50%">
                                </center>
                                </br>
                                <li>Menyiapkan surat permohonan pengajuan peminjaman alat yang berasal dari instansi yang menaungi Anda. Surat tersebut merupakan syarat yang wahib Anda penuhi untuk bisa melakukan peminjaman. Surat permohonan diupload pada halaman keranjang peminjaman. Contoh surat permohonan dapat anda lihat <a href="">disini</a></li>
                                <li>Silahkan mencari alat yang anda butuhkan pada halaman daftar ketersediaan alat</li>
                                <li>Jumlah alat yang Anda pinjam tidak dibatasi, artinya Anda bisa melakukan peminjaman jumlah peminjaman alat sesuai kebutuhan Anda</li>
                                <li>Pilih alat yang ingin anda pinjam dengan cara mencheklist pada checkbox yang tersedia  disetiap baris alat</li>
                                <li>Setelah menentukan alat yang akan dipinjam, silahkan klik tombol <b>Pinjmam Alat</b> yang akan mengarahkan Anda untuk melihat ringkasan pengajuan peminjaman alat.</li>
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>
<!-- modal peminjamaman alat PENGAJUAN ALAT -->
<div class="modal fade" id="modal_pengajuan" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Pengajuan Alat</h4>
                </div>
                <div class="modal-body">
                     <div class="fetched-data">
                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <center>
                                    <img src="img/pengajuan.JPG" class="dim_about img-responsive img-thumbnail" style="width: 50%">
                                </center>
                                </br>
                                <li>Alat-alat yang sudah Anda pilih pada halaman ketersediaan alat akan dimunculkan pada halaman keranjang peminjaman.</li>
                                <li>Anda dapat mengubah jumlah dan jenis alat, maupun membatalkan alat yang Anda sudah pilih sebelumnya.</li>
                                <li>Anda wajib mengisi tanggal pinjam dan tanggal kembali yang berguna untuk menentukan jumlah sewa yang harus Anda bayarkan pada proses pembayaran selanjutnya.</li>
                                <li>Pastikan Anda mengupload surat permohonan pengajuan peminjaman alat yang sudah Anda siapkan.</li>
                                <li>Langkah terakhir adalah klik button <b>Ajukan Peminjaman</b>, maka pengajuan Anda sudah masuk pada daftar pengajuan.</li>
                                <li>Tunggu sampai Admin memberikan konfirmasi.</li>
                                <li>Selama Anda belum mendapatkan konfirmasi dari Admin, Anda diperbolehkan melakukan perubahan atau pembatalan pengajuan</li>
                                <li>Pengajuan pinjaman dapat dilakukan pada hari dan jam kerja yaitu hari Senin - Jumat 08.00 - 16.00</li>
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>
<!-- modal prosedur peminjaman alat KONFIRMASI ADMIN -->
<div class="modal fade" id="modal_konfirm_alat" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Konfirmasi Admin</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data">
                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <center>
                                    <img src=".JPG" class="dim_about img-responsive img-thumbnail" style="width: 50%">
                                </center>
                                </br>
                                <li>Admin akan memberikan konfirmasi berupa persetujuan, penawaran atau penolakan sesuai dengan kondisi alat di Laboratorium</li>
                                <li>Apabila pengajuan Anda disetujui maka Anda akan diarahkan pada transaksi pembayaran.</li>
                                <li>Konfirmasi penawaran atau penolakan diberikan ketika adanya kerusakan alat atau alat yang sudah Anda ajukan sebelumnya akan digunakan oleh pihal Laboratorium</li>
                                <li>Konfirmasi hanya akan dilakukan pada hari dan jam kerja yaitu hari Senin - Jumat pukul 08.00 - 16.00</li>
                                <li>Pengajuan yang dilakukan diluar hari dan jam kerja kantor tidak akan dikonfirmasi, konfirmasi kembali dilakukan saat hari dan jam produktif kerja dimulai lagi. </li>
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>
<!-- modal prosedur peminjaman alat PEMBAYARAN -->
<div class="modal fade" id="modal_pembayaran" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Pembayaran</h4>
                </div>
                <div class="modal-body">
                   <div class="fetched-data">
                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <center>
                                    <img src=".JPG" class="dim_about img-responsive img-thumbnail" style="width: 50%">
                                </center>
                                </br>
                                <li>Pembayaran dilakukan setelah Anda mendapat konfirmasi persetujuan pengajuan</li>
                                <li>Butki transfer harap disimpan untuk memudahkan Anda dan Admin dalam memberikan konfirmasi pembayaran.</li>
                                <li>Waktu yang diberikan untuk Anda melakukan konfirmasi pembayaran adalah 3 jam setelah mendapat konfirmasi persetujuan.</li>
                                <li>Apabila dalam 3 jam Anda tidak melakukan konfirmasi pembayaran maka pengajuan peminjaman alat akan dibatalkan secara otomatis</li>
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>
<!-- modal prosedur peminjaman alat PENGAMBILAN ALAT -->
<div class="modal fade" id="modal_pengambilan" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Pengambilan Alat</h4>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>
<!-- modal prosedur peminjaman alat PENGEMBALIAN ALAT -->
<div class="modal fade" id="modal_pengembalian" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Pengembalian Alat</h4>
                </div>
                <div class="modal-body">
                    <div class="peminjaman-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>