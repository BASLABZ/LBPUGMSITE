<?php 
		include 'menejemen/inc/inc-db.php';
		$id = $_POST['id'];
		$sqldetail = mysql_query("SELECT * FROM  ref_instrument where instrument_id = '$id'");
		while ($rowinstrument = mysql_fetch_array($sqldetail)) {
		$gambar  = $rowinstrument['instrument_picture']	;
		$jumlah_alat = $rowinstrument['instrument_quantity'];
		$jumlah_dipinjam = $rowinstrument['intrument_quantity_temp'];
		$jumlahKetersediaan_alat = $jumlah_alat - $jumlah_dipinjam;
 ?>
	<form  method="post"class="form-horizontal" enctype="multipart/form-data" >
		<div class="form-group">
			<center><img src="menejemen/image/<?php echo $gambar; ?>" class="dim_about img-responsive img-thumbnail" style="width: 50%;"></center>
		</div>
		
		<hr>
        <div class="form-group"> 
            <label class="control-label col-lg-4">Nama Alat</label>
            <div class="col-lg-8">
                <input type="text" placeholder="Nama Alat" class="form-control" name="instrument_name" required value="<?php echo $rowinstrument['instrument_name']; ?>"  readonly/>
            </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-4">Merk Alat</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" placeholder="Merk Alat" name="instrument_brand" value="<?php echo $rowinstrument['instrument_brand']; ?>" readonly>
          </div>
        </div>
	      <div class="form-group">
		    <label class="control-label col-sm-4" for="email">Biaya Sewa</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" value="Rp.<?php echo rupiah($rowinstrument['instrument_fee']); ?>" readonly>
		    </div>
		  </div>
        <div class="form-group row">
	        <div class="col-lg-2"></div>
		    	<label class="control-label col-sm-2">Panjang</label>
			    <div class="col-sm-3">
			     <input type="text" class="form-control" readonly value="<?php echo $rowinstrument['instrument_length']; ?>">
			    </div>
			    <label class="control-label col-sm-2">Berat</label>
			    <div class="col-sm-3">
			     <input type="text" class="form-control" readonly value="<?php echo $rowinstrument['instrument_weight']; ?>">
			 </div>
	  </div>
	  <div class="form-group row">
	        <div class="col-lg-2"></div>
		    	<label class="control-label col-sm-2">Jumlah</label>
			    <div class="col-sm-3">
			     <input type="text" class="form-control" readonly value="<?php echo $rowinstrument['instrument_quantity']; ?>">
			    </div>
			    <?php 
			    	if ($jumlahKetersediaan_alat < 1) {
			    		echo "<label class='label label-primary'>STOK HABIS</label>";
			    	}else{
			     ?>
			     <label class="control-label col-sm-2">Sisa</label>
			    <div class="col-sm-3">
			     <input type="text" class="form-control" readonly value="<?php echo $jumlahKetersediaan_alat; ?>">
			 	</div>
			     <?php } ?>
	  </div>  
      <div class="form-group">
          <label class="control-label col-lg-4">Deskripsi Alat</label>
          <div class="col-md-8">
            <textarea class="form-control" placeholder="Deskripsi Alat" readonly name="instrument_description">
            <?php echo $rowinstrument['instrument_description']; ?>
             </textarea>
          </div>
      </div>
    </form>
<?php } ?>
