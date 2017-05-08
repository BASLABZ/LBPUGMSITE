<!-- <div class="col-md-6">
                        <div class="panel panel-primary">
                                <div class="panel-heading dim_about">
                                    <div class="form-group">
                                       
                                        <h2> Jumlah Alat  :<b>   <span id="total_sum_value"><?php echo $totaljumlah; ?></span> </b> Buah</h2><br>
                                        <h2> Jumlah Bayar : <b id="totalbayar">Rp. <?php echo $totalbayar; ?></b> </h2>
                                        
                                    </div>
                                    <div class="form-group row">
                                    <label class="control-label col-lg-4">Upload File</label>
                                        <div class="col-lg-8">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="input-group">

                                                        <span class="btn btn-file btn-info">
                                                            <span class="fileupload-new">Select file</span>
                                                            <span class="fileupload-exists"><span class="fa fa-refresh"></span> Change</span>

                                                            <input type="file" name="frm_file" accept="application/pdf" id="ifile" onchange="cekberkas()" />
                                                        </span>
                                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><span class="fa fa-times"></span> Remove</a>
                                                    <div class="col-lg-12">
                                                        <br>
                                                        <i class="fa fa-file fa-2x" ></i>
                                                        <span class="fileupload-preview" ></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>
                              <?php  
                                    $query_profilmember= mysql_query("SELECT * from tbl_member where member_id = '".$_SESSION['member_id']."'");
                                      $peringatan_lengkapi_identitas = mysql_fetch_array($query_profilmember);
                                         $member_birth_date_cek          = $peringatan_lengkapi_identitas['member_birth_date'];
                                         $member_gender_cek              = $peringatan_lengkapi_identitas['member_gender'];
                                         $member_phone_number_cek        = $peringatan_lengkapi_identitas['member_phone_number'];
                                         $member_address_cek             = $peringatan_lengkapi_identitas['member_address'];
                                   
                                      if ($member_birth_date_cek  != '' AND $member_gender_cek  != '' AND 
                                            $member_phone_number_cek !='' AND $member_address_cek  != '') {
                                              echo "
                                               <button type='submit' name='ajukanpeminjaman' class='btn btn-primary btn-sm dim_about' id='ibtn_bayar' disabled='> <span class='fa fa-check'></span> Ajukan Peminjaman</button>
                                            ";
                                           }else{
                                            echo "<div class='col-md-12'>
                                              <div class='alert alert-danger alert-dismissable dim_about red-bg' style='border-color: #f8ac59; color: white;'>
                                                  <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                                    <span class='fa fa-times'></span>
                                                   LENGKAPI DATA ANDA TERLEBIH DAHULU 
                                                   <a href='index.php?hal=akun/profil' style='border-color: #f8ac59; color: white;'><span class='fa fa-arrow-right'></span> DISINI</a>
                                                   <h5><i>* Anda Dapat Menyimpan Data Pengajuan Setelah Melengkapi Identitas Anda</i></h5>
                                                    </b>
                                                 </div>
                                            </div>";
                                           }     
                               ?>
                              </p>
                           
                      </div>  -->