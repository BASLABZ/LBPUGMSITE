<?php
// include 'inc-db.php';
// session_start();
//--tampilkan menu 
$sqlmenu1="select menu_id, menu_name, menu_parent from ref_menu where menu_parent = 0"; 

$resultmenu1=mysql_query($sqlmenu1);
//$run=mysql_query($sqlmenu1);

while($datamenu1=mysql_fetch_array($resultmenu1)){
    $varMenuId=$datamenu1['menu_id'];
    $varMenuName=$datamenu1['menu_name'];
    $varMenuParent=$datamenu1['menu_parent'];?>

    <li class="panel" >
    <a href="#" data-toggle="collapse" data-target=".collapse-<?php echo $varMenuId; ?>" style="color: white;">
        <i class="icon-tasks"> </i>
        <?php echo $varMenuName ?>
         <?php 
             $queryPeringatan_pembayarans  = mysql_query("SELECT count(loan_status) as pembayaran from trx_loan_application where loan_status = 'MEMBAYAR TAGIHAN'");
            $queryPeringatans  = mysql_query("SELECT count(loan_status) as menunggu from trx_loan_application where loan_status = 'MENUNGGU'");
            $jumlahPeringatan_pembayaran = mysql_fetch_array($queryPeringatan_pembayarans);
            $rowPembayaran_peringatan = $jumlahPeringatan_pembayaran['pembayaran'];
             $jumlahPeringatan_pengajuan = mysql_fetch_array($queryPeringatans);
            $rowPengajuan_peringatan = $jumlahPeringatan_pengajuan['pembayaran'];
        ?>
        <?php 
            if ($varMenuId=='18') {
                if ($rowPengajuan_peringatan != 0 OR $rowPembayaran_peringatan != 0) {
                    $totalPeringatan  = $rowPengajuan_peringatan+$rowPembayaran_peringatan;
                    echo "<i class='fa fa-exclamation-circle'> ".$totalPeringatan."</i>";
                }
                
            }
         ?>
        <span class="pull-right">
            <i class="icon-angle-left"></i>
        </span>
    </a>
        <?php
        //--tonton menu_id berdasarkan levelnya apa
        $sqlmenu2="select menu_id from ref_level_menu where level_id='".$_SESSION['level_id']."'";
        
        $resultmenu2=mysql_query($sqlmenu2);
        ?>
        <ul class="collapse-<?php echo $varMenuId; ?> collapse">
        <?php
        while($datamenu2=mysql_fetch_array($resultmenu2)){
            $varMenuId2=$datamenu2['menu_id'];
            //--tampilan daftar menunya
            $sqlmenu3="select menu_id, menu_name, menu_url from ref_menu where menu_id='".$varMenuId2."'";
            $sqlmenu3=$sqlmenu3 . " and menu_parent='".$varMenuId."'";
        	?>
        	<?php
            $resultmenu3=mysql_query($sqlmenu3);
            while($datamenu3=mysql_fetch_array($resultmenu3)){
                $varMenuName3=$datamenu3['menu_name'];
                $submenu = $datamenu3['menu_id'];
                $varMenuUrl3=$datamenu3['menu_url'];?>
                
                <li class=""><a href="index.php?hal=<?php echo $varMenuUrl3?>" style="color: white;"><?php echo $varMenuName3 ?> 
                    <?php 
                        $queryPeringatan_pembayaran  = mysql_query("SELECT count(loan_status) as pembayaran from trx_loan_application where loan_status = 'MEMBAYAR TAGIHAN'");
                        $rowPeringatan_pembayaran  = mysql_fetch_array($queryPeringatan_pembayaran);
                        $peri_pembayaran = $rowPeringatan_pembayaran['pembayaran'];
                        if ($peri_pembayaran > 0) {
                            if ($submenu == 14) {
                                echo "<i class='fa fa-exclamation-circle' aria-hidden='true'>".$peri_pembayaran."</i>";
                            }
                        }
                        // peringatan pengajuan status menunggu
                        $queryPeringatan  = mysql_query("SELECT count(loan_status) as menunggu from trx_loan_application where loan_status = 'MENUNGGU'");
                        $rowPeringatan  = mysql_fetch_array($queryPeringatan);
                        $peri_menunggu = $rowPeringatan['menunggu'];
                        if ($peri_menunggu > 0) {
                            if ($submenu == 26) {
                                echo "<i class='fa fa-exclamation-circle' aria-hidden='true'>".$peri_menunggu."</i>";
                            }    
                        }
                        
                     ?> 
                    
                    
                </a> </li>
            <?php
            } // tutup while datamenu3
        } // tutup while datamenu 2
        ?>
        </ul>
    </li>
<?php
} // tutup while datamenu 1
?>