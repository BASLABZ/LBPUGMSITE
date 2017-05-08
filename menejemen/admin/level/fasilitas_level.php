<?php 
        $id = $_GET['id'];
        $row = mysql_fetch_array(mysql_query("SELECT * FROM ref_level where level_id = '".$id."'"));
        $idlevel = $row['level_id'];
        if (isset($_POST['simpan'])) {
            $jumlah = 0; // kondisi normal ketika blm memilih (nol), utk mengecek yg dicentang
                // record dibersihkan dulu agar tidak terjadi penyimpanan ganda ketika henda di-update
                $bersih = "DELETE FROM ref_level_menu WHERE level_id='".$idlevel."'";
                $runbersih = mysql_query($bersih);

                $sumMenu = "SELECT menu_id FROM ref_menu";
                $runsumMemu = mysql_query($sumMenu);
                $jumlahmenu = mysql_num_rows($runsumMemu);

                 for($i=1; $i<=$jumlahmenu; $i++){ // menampilkan menu
                    $menu = ($_POST['menu'.$i]); // menampilkan menu1, menu2, menu
                 if($menu!=''){ // jika $menu tidak kosong
                    $jumlah++; // maka $jumlah diincrementkan utk menampilkan menu1, menu2 dan menu3     
                        $save = "INSERT into ref_level_menu (level_id, menu_id) VALUES ('$idlevel','$menu')";
                        // var_dump($save); die();
                        $sql = mysql_query($save); 
                        ?>
                        <script type="text/javascript">alert('Data Berhasil Disimpan');
                        document.location="index.php?hal=level/list"</script><?php
                }
            }   
    if ($jumlah==0) { ?> 
    <script type="text/javascript">alert('Maaf, anda harus memilih fasilitas!');
    document.location="index.php?hal=level/fasilitas_level"</script> 
    <?php   
    } }
 ?>
 <div id="content">
            <div class="container" style="padding-top:30px; ">
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-primary" style="border-color:white; ">
                    <div class="panel-heading dim_about">
                        <span class="fa fa-pencil"></span> Tambah Master Data Level 
                        <span class="fa fa-home pull-right"> <i>
                            Home / <span class="fa fa-list"></span> Master / <span class="fa fa-pencil">
                            </span>
                            Level
                        </i></span>
                    </div>
                </div>
                <div class="panel panel-primary" style="border-color:white; ">
                        <div class="panel-body dim_about">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary" style="border-color:white;">
                        <div class="panel-heading"><span class="fa fa-plus"></span> Tambah Level - Fasilitas Hak Akses</div>
                        <div class="panel-body dim_about">
                            <div class="col-md-12">
                                <form method="post" class="form-horizontal">
                                    <?php 
                                            $tampil     = "SELECT level_name FROM ref_level WHERE level_id='".$id."'";
                                            $run1       = mysql_query($tampil);
                                            $var_data   = mysql_fetch_array($run1);

                                            $var_nama = $var_data['level_name'];

                                                echo $var_nama."</br>";?>
                                                <h5> Daftar Menu : </h5></br>
                                            
                                            <?php 
                                                $tampil      = "SELECT menu_id, menu_name, menu_url FROM ref_menu where menu_parent !=0";
                                                $run         = mysql_query($tampil);
                                                $a = 0; //start looping utk menu (menu1, menu2, menu3 dst)

                                                while ($fasilitas = mysql_fetch_array($run)) { // perulangan utk menampilkan SEMUA menu yg ada di database
                                                    $var_menuid = $fasilitas['menu_id']; // id menu di TABEL MENU
                                                    $var_menuname = $fasilitas['menu_name']; 
                                                    $a++;
                                                    // ==========================================================================
                                                    $checklistmenu = "SELECT menu_id FROM ref_level_menu WHERE level_id='".$id."'"; // ambil id menu pada operator yg dipilih
                                                    $runchecklistmenu = mysql_query($checklistmenu);
                                                    while ($datamenu=mysql_fetch_array($runchecklistmenu)) { // perulangan utk menampilkan yg checklist
                                                        $var_menuku = $datamenu['menu_id']; // daftar menu yg didapat ditampung dlm var $menuku 
                                                        if ($var_menuid==$var_menuku) { // membandingkan id_menu di TABEL MENU dan TABEL LEVEL_MENU ($id hanya satu dan dibandingkan dgn seluruh hasil $menuku)
                                                            $notice = 1; // jika cocok diberi nilai 1 (terisi/checklist)
                                                        if ($var_menuku==13) { //untuk menu logout jelas pasti terpilih ?> 
                                                        <div class="form-group"> 
                                                            <div class="checkbox">
                                                                <label>
                                                                <input type="checkbox" value=<?php echo $var_menuid ?> name=<?php echo "menu".$a ?> checked /> <?php echo $var_menuname ?> <br/>            
                                                                    <?php       $var_newid = $var_menuid; //agar tidak terulang yg sudah dicentang tdk di cetak lg" />
                                                                }
                                                            else {
                                                            ?>
                                                            <input type="checkbox" value=<?php echo $var_menuid ?> name=<?php echo "menu".$a ?> checked /> <?php echo $var_menuname ?> <br/>                
                                                            <?php           $var_newid = $var_menuid;
                                                                //peritah diatas perlakuan menu yg non logout dan sudah cocok dgn menuku maka ditampilkan dgn tanda checklist   
                                                            }// else
                                                        }// if menuid
                                                        $notice=0;  
                                                    }// while datamenu

                                                    if ($notice!=1 && $var_menuid!=$var_newid) { //perlakuan default (menu tdk terdaftar dlm menuku)  ?> 
                                                        <input type="checkbox" value=<?php echo $var_menuid ?> name=<?php echo "menu".$a ?> /> <?php echo $var_menuname ?> <br/>         
                                                    <?php
                                                    }//if
                                                }// while fasilitas (checkbox default)
                                            ?>
                        </label>
                    </div>
                </div>
                <div class="form-group row" style="padding-top:10px; ">
                    <center>
                        
                        <div class="col-md-12">
                            <button type="submit" name="simpan"  class="btn btn-success dim_about" value="SUBMIT" align="right">
                            <span class="fa fa-save"> SIMPAN</span>
                            </button>
                            <button type="refresh" class="btn btn-warning dim_about"> <span class="fa fa-refresh"> </span> REFRESH</button>
                            </div>
                        </div>
                    </center>
                    
                </div>   
            </form>
        </div>
    </div>
</div>
   
    </div>
            </div>
        </div>
    </div>
</div>

<!-- END COLOR PICKER -->


                        </div>
                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            </div>
        </div>
    </div>
</div>
</div>
