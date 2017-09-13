<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=laporan_data_rekap_member.xls");
	include '../../inc/inc-db.php';
    session_start();		

?>
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
            <h2>LAPORAN REKAP DATE MEMBER</h2>
            <table border="1">
                    <thead>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>TANGGAL DAFTAR</th>
                        <th>INSTANSI</th>
                        <th>FAKULTAS / BIDANG</th>
                        <th>EMAIL</th>
                        <th>STATUS</th>
                    </thead>
                    <tbody>
                        <?php
                            $no =1;
                            $show = mysql_query("SELECT * from tbl_member A join ref_category B on A.category_id_fk = B.category_id");
                            while ($runshow = mysql_fetch_array($show)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $runshow['member_name']; ?></td>
                                <td><?php echo $runshow['member_register_date']; ?></td>
                                <td><?php echo $runshow['member_institution']; ?></td>
                                <td><?php echo $runshow['member_faculty']; ?></td>
                                <td><?php echo $runshow['member_email']; ?></td>
                                <td><?php echo $runshow['member_status']; ?></td>
                            </tr> 
                            <?php
                            }
                        ?>
                    </tbody>
            </table>  
        </center>