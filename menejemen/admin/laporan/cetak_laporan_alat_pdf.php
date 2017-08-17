<?php 
    include '../../inc/inc-db.php';
    session_start();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
     <title>LAPORAN DATA ALAT</title>
 </head>
 <body onload="window.print()"> 
       <center>
            <table width="100%">
            <th  ALIGN="RIGHT" WIDTH="20%">
                <img src="../assets/logo.png" style="width:50%;">
            </th >
                <th ALIGN="CENTER" WIDTH="60%">
                    <p align="left">
                        <center>
                            <h3>LABORATORIUM BIO & PALEONTROPOLOGI <br>FAKULTAS KEDOKTERAN UNIVERSITAS GADJAH MADA </h3>
                            <h3></h3>
                            <h5><i>Alamat : Jalan Medika Sekip , Yogyakarta , 55281, Indonesia</i><br>
                                Telp/ FAX: +62-274-552577; Email: lab-biopaleo.fk@ugm.ac.id<br> http://lab-biopaleoantropologi.fk.ugm.ac.id/
                            </h5>
                        </center>
                    </p>
                </th>
        </table>
       </center>
       <hr>
        <center>
            <h2>LAPORAN DATA ALAT</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA ALAT</th>
                        <th>MERK</th>  
                        <th>HARGA SEWA</th>
                        <th>JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    $query = mysql_query("SELECT * from ref_instrument order by instrument_id DESC");
                    while ($row = mysql_fetch_array($query)) {
                            $var_gambar     = "../image/".$row['instrument_picture'];
                 ?>
                    <tr class="odd gradeX">
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['instrument_name']; ?></td>
                        <td><?php echo $row['instrument_brand']; ?></td>
                        <td>Rp.<?php echo rupiah($row['instrument_fee']); ?></td>
                        <td><?php echo $row['instrument_quantity']; ?></td>
                        
                    </tr>
                   <?php } ?>
                </tbody>
            </table>
            
        </center>
        <!-- jumlah alat -->
        <?php 
            $total_alat = mysql_fetch_array(mysql_query("SELECT SUM(instrument_quantity) as jumlah_alat FROM ref_instrument"));
            $total_alat_pernama_alat = mysql_fetch_array(mysql_query("SELECT COUNT(instrument_quantity) as jumlah_alat_pernama FROM ref_instrument"));
         ?>
       <center>
       <hr>
       <br>
       <br>
       <h3>
            <table>
                <tr>
                    <td></td>
                    <td></td>
                    <td>TOTAL ALAT PERJENIS ALAT</td>
                    <td>:</td>
                    <td><?php echo $total_alat_pernama_alat['jumlah_alat_pernama']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>TOTAL ALAT</td>
                    <td>:</td>
                    <td><?php echo $total_alat['jumlah_alat']; ?></td>
                </tr>
            </table>
        </h3>
       </center>
 </body>
 </html>
