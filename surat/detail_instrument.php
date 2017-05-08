<section class="features dim_about" style="background-color:#1ab394;">
    <div class="container" style="padding-top: 18px;">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1 style="color:white; "><span class="fa fa-gear"></span> Peralatan BIO-PALEONTROPOLOGI</h1>

                <p style="color: white;">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
            </div>
        </div>
    </div>
</section>
<section  class="container features">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h1>INSTRUMENT DI SEWA</h1>
            <p>Informasi Data Instrument yang anda sewa, sebelum melakukan transaksi silahkan baca terlebih dahulu prosedur penyewaan alat/instrument </p>
        </div>

    </div>
    <div class="row">
          <div class="well">
                  <h1>DAFTAR PERTANYAAN</h1>
                  <ol>
                      <li>TABLE YANG DIGUNAKAN SETELAH KLIK SEWA APA AJA YANG DISIMPAN ? </li>
                      <li>KAPAN UPLOAD FILE SURAT</li>
                      <li>loan_invoice ini untuk apa?</li>
                      <li>Kode loan_invoice <b>0040/INV/16<b> ini otomatis atau manual?</li>
                      <li>buat detail kayak yang didepan</li>
                      <li>transaksi pembayaran kacau</li>
                      <li>konversi rupiah</li>
                  </ol>
            </div>
    </div>
    <div class="row features-block">
        <div class="col-lg-12 features-text wow fadeInLeft">
            <h2><span class="fa fa-shopping-cart"></span> Daftar Penyewaan </h2>
            <table class="table table-responsive table-bordered table-striped table-hover table-alat">
            	<thead>
            		<th width="1%">No</th>
            		<th>Image</th>
            		<th>Instrument Name</th>
            		<th>Description</th>
            		<th width="1%">Stcok</th>
            		<th width="1%">Quantity</th>
            		<th>Action</th>
            	</thead>
            	<tbody>
            		<?php  for ($i=1; $i <= 3 ; $i++) {  ?>
            		<tr>
            			<td><?php echo $i; ?></td>
            			<td>1</td>
            			<td>1</td>
            			<td>1</td>
            			<td>1</td>
            			<td width="1%"><input type="number" class="form-control"></td>
            			<td align="center"><a href="#" class="btn btn-danger btn-sm dim_about"><span class="fa fa-trash"></span> Batal</a></td>
            		</tr>
            		<?php } ?>
            	</tbody>
            </table>
            
        </div>
    </div>
</section>
