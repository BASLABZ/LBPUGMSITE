<?php 
        if (isset($_POST['simpan'])) {
            $querymenu = mysql_query("INSERT INTO ref_menu (menu_name,menu_url,menu_parent)
                                                VALUES ('".$_POST['menu_name']."', '".$_POST['menu_url']."', '".$_POST['menu_parent']."') ");   
            if ($querymenu) {
                    echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=menu/list' </script>";exit; 

            }else{
                echo "<script> alert('Data Gagal Disimpan'); location.href='index.php?hal=menu/add' </script>";exit; 
            }
        }
 ?>
        <div id="content">
            <div class="container" style="padding-top:30px; ">
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-primary" style="border-color:white; ">
                    <div class="panel-heading dim_about">
                        <span class="fa fa-pencil"></span> Tambah Master Data Menu 
                        <span class="fa fa-home pull-right"> <i>
                            Home / <span class="fa fa-list"></span> Master / <span class="fa fa-pencil">
                            </span>
                            Menu
                        </i></span>
                    </div>
                </div>
                <div class="panel panel-primary" style="border-color:white; ">
                        <div class="panel-body dim_about">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary" style="border-color:white;">
                        <div class="panel-heading">Tambah menu</div>
                        <div class="panel-body dim_about">

                            <div class="col-md-12">
                                <form  method="post" class="form-horizontal">
                                    <div class="form-group"> 
                                        <label class="control-label col-lg-4">Nama Menu</label>
                                        <div class="col-lg-8">
                                            <input type="text" placeholder="Nama Menu" class="form-control" name="menu_name" required />
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="control-label col-lg-4">Link Menu</label>
                                        
                                        <div class="col-lg-8">
                                            <input type="text" placeholder="Link Menu" class="form-control" name="menu_url" required/>
                                        </div>  
                                    </div>    
                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Menu Parent</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" name="menu_parent" required>
                                                <option>Tidak ada</option>
                                                   <?php     
                                                        $select = mysql_query("SELECT menu_id, menu_name, menu_url from ref_menu where menu_parent=0 order by menu_id ASC");
                                                        while ($rowmenuparent = mysql_fetch_array($select)) { ?>
                                                        <option value="<?php echo $rowmenuparent['menu_id'] ?>"><?php echo $rowmenuparent['menu_name']?></option>
                                                    <?php } ?>
                                                </select>
                                             </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <button type="submit" name="simpan" class="btn btn-success pull-right dim_about"> <span class="fa fa-save"></span> Simpan</button>
                                        
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
