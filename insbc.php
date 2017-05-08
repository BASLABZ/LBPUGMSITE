<?php 
                                    $no = 1;
                                    $query = mysql_query("SELECT * from ref_instrument order by instrument_id DESC");
                                    $querYs = "SELECT  * from trx_loan_application_detail t join trx_loan_application a ON t.loan_app_id_fk = a.loan_app_id join tbl_member m on a.member_id_fk = m.member_id JOIN ref_instrument r on t.instrument_id_fk = r.instrument_id";
                                    $array = array();
                                    while ($row = mysql_fetch_array($query)) {
                                            $id = $row['instrument_id'];
                                            $var_gambar     = "menejemen/image/".$row['instrument_picture'];
                                            $queryP = mysql_fetch_array(mysql_query($querYs)); 
                                            $kodeINS = $queryP['instrument_id_fk'];
                                            $sumKode = count($queryP['instrument_id']);
                                            $jumlahItem = count($queryP['loan_amount']);

                                            if ($id == $kodeINS) {
                                                echo "ins : ".$id."<br>";
                                                echo "pinjam : ".$kodeINS."<br>";
                                                
                                            }elseif($id != $kodeINS){
                                                echo "<br>kode instrument tidak dipinjam /<><br>";
                                                echo "ins : ".$id."";
                                                echo "pinjam : ".$kodeINS."<br>";
                                         ?>
                                    <tr>
                                        <td width="5%">
                                         <?php 
                                            if ($row['instrument_quantity']=0) {
                                                echo "<input type='checkbox' disabled 
                                                        value='".$row['instrument_id']."' name='cek[]' >";
                                            }else{
                                                echo "<input type='checkbox' value='".$row['instrument_id']."' name='cek[]'>";
                                            }
                                          ?>
                                       </td>
                                        <td width="5%"><?php //echo $rowAfter['instrument_name']; ?><?php echo $no++; ?></td>
                                        <td width="20%"><img style="width:130px; height:150px;" src="<?php echo $var_gambar; ?>" class="dim_about"></td>
                                        <td width="20%"><?php echo $row['instrument_name']; ?></td>
                                        <td width="8%">
                                                        <?php 
                                                                $jumlahSementara =  $row['instrument_quantity']; 
                                                                $jumlahTemp = $row['intrument_quantity_temp'];
                                                                echo $jumlahSementara; 
                                                        ?>
                                        </td>
                                        <td width="8%">
                                              <?php echo $row['loan_amount']; ?> 
                                              <?php 
                                                echo "<button type='button'  class='btn btn-info btn-xs' data-toggle='collapse' data-target='#".$no."'>
                                                <span class='fa fa-users'></span>
                                              </button>    
                                              <div id='".$no."' class='collapse'>
                                                    ".$queryP['member_institution']."
                                              </div>";
                                               ?>
                                        </td>
                                        <td width="8%"><?php 
                                         $jumlahTersedia = $jumlahSementara - $jumlahTemp;
                                            echo $jumlahTersedia;
                                          ?></td>
                                        <td width="10%"><?php echo $row['instrument_fee']; ?></td>
                                        <td width="10%">
                                         <a href='#myModal' class='btn btn-info btn-sm dim_about' id='custId' data-toggle='modal' data-id="<?php echo $row['instrument_id']; ?>"><span class='fa fa-eye'></span> Detail</a>
                                       </td>
                                    </tr>
                                   <?php 
                               }
                                    // }
                                   }?>