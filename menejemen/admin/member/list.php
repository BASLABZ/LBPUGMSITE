<?php 
        if (isset($_POST['ubahstatusterima'])) {
            $updatestatus = mysql_query("UPDATE tbl_member set member_status='Actived'
                WHERE member_id = '".$_POST['member_id']."'
             ");
             if ($updatestatus) {
             echo "<script> alert('Status Berhasil Diubah'); location.href='index.php?hal=member/list' </script>";exit;

             }
        }
 ?>
<div id="content">
            <div class="inner">
                <div class="row" style="padding-top: 10px; padding-right: 10px; padding-left: 10px;">
                <div class="panel panel-primary" style="border-color: #1ab394;">
                    <div class="panel-heading">
                       <div class="row">
                            <div class="col-md-4">
                             <span class="fa fa-users"></span> MASTER MEMBER
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Master Data / <span class="fa fa-users"> </span> Member</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class="fa fa-users"></span> Data Member
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA</th>
                                            <th>INSTANSI</th>
                                            <th>PRODI</th>
                                            <th>STATUS</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $no = 1;
                                        $query = mysql_query("SELECT * from tbl_member join ref_category on tbl_member.category_id_fk=ref_category.category_id");
                                        while ($row = mysql_fetch_array($query)) {
                                     ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['member_name']; ?></td>
                                            <td><?php echo $row['member_institution']; ?></td>
                                            <td><?php echo $row['member_faculty']; ?></td>
                                            <td>
                                                <form class="role" method="POST">
                                                    
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="hidden" value="<?php echo $row['member_id']; ?>" name='member_id'
                                                                > 
                                                            </div>
                                                        </div>                                               
                                                </form>
                                                <?php if ($row['member_status']=='Actived') {
                                                    echo "<span class='label label-success'>Actived</span>";
                                                } else {
                                                    echo "<span class='label label-danger'>Ignore</span>";
                                                    } ?>
                                                
                                            </td>
                                            <td align="center">
                                                <a  href="#detail_member" id='custId' data-toggle='modal' data-id='<?php echo $row['member_id']; ?>' class="btn btn-info btn-sm dim_about"> <span class="fa fa-eye"> Detail Member</span>    
                                            </td>
                                        </tr>
                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detail_member" role="dialog" >
        <div class="modal-dialog modal-lg" style="width: 800px" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Detail Member</h4>
                </div>
                <div class="modal-body" style="padding-top:10px; ">
                    <div class="detail_member-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>
<!-- show peminjaman modal -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#detail_member').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'member/detail_member.php',
                data :  'id='+ rowid,
                success : function(data){
                $('.detail_member-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
</script>